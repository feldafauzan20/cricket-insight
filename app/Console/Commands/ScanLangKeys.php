<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class ScanLangKeys extends Command
{
    protected $signature = 'lang:scan
        {--path=resources/views : Folder yang mau di-scan, relatif ke base_path}
        {--include-app : Ikut scan folder app/ juga (View Components, dll)}';

    protected $description = 'Scan __() / trans() / @lang() di blade & php files, lalu auto-generate key yang belum ada di lang files';

    public function handle(): int
    {
        $locales = config('app.available_locales', ['id', 'en']);

        $paths = [base_path($this->option('path'))];

        if ($this->option('include-app')) {
            $paths[] = app_path();
        }

        // Nangkep: __('domain.key'), trans('domain.key'), trans_choice('domain.key')
        $funcPattern = '/\b(?:__|trans|trans_choice)\(\s*[\'"]([a-zA-Z0-9_\-]+\.[a-zA-Z0-9_\.\-]+)[\'"]/';
        // Nangkep: @lang('domain.key')
        $bladePattern = '/@lang\(\s*[\'"]([a-zA-Z0-9_\-]+\.[a-zA-Z0-9_\.\-]+)[\'"]/';

        $found = []; // domain => [keyPath => true]

        foreach ($paths as $path) {
            if (! is_dir($path)) {
                continue;
            }

            foreach (File::allFiles($path) as $file) {
                if ($file->getExtension() !== 'php') {
                    continue;
                }

                $content = file_get_contents($file->getPathname());

                preg_match_all($funcPattern, $content, $m1);
                preg_match_all($bladePattern, $content, $m2);

                $allMatches = array_merge($m1[1] ?? [], $m2[1] ?? []);

                foreach ($allMatches as $fullKey) {
                    [$domain, $keyPath] = explode('.', $fullKey, 2);
                    $found[$domain][$keyPath] = true;
                }
            }
        }

        if (empty($found)) {
            $this->warn('Gak ada key __() / trans() / @lang() yang ketemu di path yang di-scan.');

            return self::SUCCESS;
        }

        $totalNew = 0;

        foreach ($found as $domain => $keys) {
            foreach ($locales as $locale) {
                $dir = lang_path($locale);
                $filePath = $dir.DIRECTORY_SEPARATOR.$domain.'.php';

                if (! is_dir($dir)) {
                    File::makeDirectory($dir, 0755, true);
                }

                $existing = File::exists($filePath) ? (include $filePath) : [];
                if (! is_array($existing)) {
                    $existing = [];
                }

                $newKeysForFile = [];

                foreach (array_keys($keys) as $keyPath) {
                    if (! Arr::has($existing, $keyPath)) {
                        Arr::set($existing, $keyPath, '');
                        $newKeysForFile[] = $keyPath;
                    }
                }

                if (! empty($newKeysForFile)) {
                    File::put($filePath, "<?php\n\nreturn ".$this->exportArray($existing).";\n");
                    $totalNew += count($newKeysForFile);

                    $this->info("[{$locale}/{$domain}.php] +".count($newKeysForFile).' key baru: '.implode(', ', $newKeysForFile));
                }
            }
        }

        $this->newLine();
        $this->info("Selesai. Total {$totalNew} key baru ditambahkan (masih kosong, tinggal diisi manual).");

        return self::SUCCESS;
    }

    protected function exportArray(array $array, int $indent = 1): string
    {
        $lines = "[\n";
        $pad = str_repeat('    ', $indent);

        foreach ($array as $key => $value) {
            $exportedKey = "'".addslashes((string) $key)."'";

            if (is_array($value)) {
                $lines .= "{$pad}{$exportedKey} => ".$this->exportArray($value, $indent + 1).",\n";
            } else {
                $exportedValue = "'".addslashes((string) $value)."'";
                $lines .= "{$pad}{$exportedKey} => {$exportedValue},\n";
            }
        }

        $lines .= str_repeat('    ', $indent - 1).']';

        return $lines;
    }
}
