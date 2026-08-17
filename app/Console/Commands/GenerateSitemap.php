<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate public/sitemap.xml for all published, indexable content across both locales';

    private const STATIC_ROUTES = [
        ['name' => 'home', 'priority' => 1.0],
        ['name' => 'news.index', 'priority' => 0.5],
        ['name' => 'interviews.index', 'priority' => 0.5],
        ['name' => 'gallery.index', 'priority' => 0.5],
        ['name' => 'tournaments.index', 'priority' => 0.5],
        ['name' => 'ongoing-tournaments.index', 'priority' => 0.5],
        ['name' => 'matches.index', 'priority' => 0.5],
        ['name' => 'bbi-wbbi', 'priority' => 0.5],
    ];

    public function handle(): int
    {
        $sitemap = Sitemap::create();
        $locales = config('app.available_locales');

        foreach (self::STATIC_ROUTES as $entry) {
            foreach ($locales as $locale) {
                $sitemap->add(
                    Url::create(route($entry['name'], ['locale' => $locale]))
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setPriority($entry['priority'])
                );
            }
        }

        Article::query()
            ->where('status', 'published')
            ->with('category:id,name,slug')
            ->chunk(500, function ($articles) use ($sitemap, $locales) {
                foreach ($articles as $article) {
                    $route = $this->resolveArticleRoute($article);

                    // Categories with no dedicated detail page (e.g. gallery, bbi-wbbi)
                    // are intentionally excluded rather than defaulted to news.show.
                    if ($route === null) {
                        continue;
                    }

                    foreach ($locales as $locale) {
                        $sitemap->add(
                            Url::create(route($route, ['locale' => $locale, 'slug' => $article->slug]))
                                ->setLastModificationDate($article->updated_at)
                                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                                ->setPriority(0.8)
                        );
                    }
                }
            });

        // TODO: include OngoingTournament rows once ongoing-tournaments.show has a slug
        // and a real view (currently OngoingTournamentController::show() references a
        // missing Blade file, and the route is ID-based rather than locale-shareable content).

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated at ' . public_path('sitemap.xml'));

        return self::SUCCESS;
    }

    private function resolveArticleRoute(Article $article): ?string
    {
        $slug = strtolower($article->category->slug ?? '');
        $id = $article->category->id ?? null;

        return match (true) {
            $id === 6 || $slug === 'interviews' => 'interviews.show',
            $id === 2 || in_array($slug, ['tournament', 'tournaments']) => 'tournaments.show',
            $id === 5 || $slug === 'matches' => 'matches.show',
            in_array($slug, ['gallery', 'bbi-wbbi']) => null,
            default => 'news.show',
        };
    }
}
