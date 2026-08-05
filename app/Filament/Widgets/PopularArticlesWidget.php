<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Spatie\Analytics\OrderBy;
use Illuminate\Support\Str;

class PopularArticlesWidget extends BaseWidget
{
    protected static ?int $sort = 10;

    protected static ?string $heading = 'Berita & Artikel Terpopuler (GA4)';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => null)
            ->records(function () {
                try {
                    // Query GA4 for top visited pages in the last 30 days
                    $analyticsData = Analytics::get(
                        Period::days(30),
                        ['screenPageViews'],
                        ['pageTitle', 'hostName', 'pagePath'],
                        30,
                        [OrderBy::metric('screenPageViews', true)]
                    );

                    return collect($analyticsData)
                        ->filter(function (array $row) {
                            // Filter paths to only include news / article URLs
                            return Str::contains($row['pagePath'] ?? '', ['/news/', '/news']);
                        })
                        ->each(function (array $row) {
                            // Sync GA4 views count into the database 'views_count' column
                            $path = $row['pagePath'] ?? '';
                            if (preg_match('#/news/([^/?#]+)#', $path, $matches)) {
                                $slug = $matches[1];
                                $views = (int) ($row['screenPageViews'] ?? 0);
                                \App\Models\Article::where('slug', $slug)->update(['views_count' => $views]);
                            }
                        })
                        ->take(10)
                        ->mapWithKeys(fn (array $item) => [
                            Str::uuid()->toString() => [
                                'title' => $item['pageTitle'] ?? 'Tanpa Judul',
                                'path' => $item['pagePath'] ?? '/',
                                'hostname' => $item['hostName'] ?? '',
                                'views' => (int) ($item['screenPageViews'] ?? 0),
                            ]
                        ])
                        ->toArray();
                } catch (\Throwable $e) {
                    return [];
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Artikel / Berita')
                    ->weight('bold')
                    ->wrap()
                    ->url(fn (array $record): string => 'https://' . $record['hostname'] . $record['path'])
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('path')
                    ->label('URL Path')
                    ->color('gray')
                    ->wrap(),
                Tables\Columns\TextColumn::make('views')
                    ->label('Jumlah Pembaca (30 Hari Terakhir)')
                    ->numeric()
                    ->badge()
                    ->color('success')
                    ->alignEnd(),
            ])
            ->paginated(false);
    }
}
