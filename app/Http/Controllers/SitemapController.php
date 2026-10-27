<?php

namespace Azuriom\Http\Controllers;

use Azuriom\Models\Page;
use Azuriom\Models\Post;
use Closure;
use DateTimeInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Throwable;

class SitemapController extends Controller
{
    /**
     * The cache key of the generated sitemap.
     */
    public const CACHE_KEY = 'sitemap.xml';

    /**
     * Display the sitemap of the public pages of the website.
     */
    public function __invoke()
    {
        $xml = Cache::remember(self::CACHE_KEY, now()->addHour(), fn () => $this->render());

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
            'X-Robots-Tag' => 'noindex',
        ]);
    }

    protected function render(): string
    {
        $urls = collect([['loc' => route('home'), 'lastmod' => null]]);

        foreach ($this->sections() as $section) {
            try {
                $urls = $urls->merge($section());
            } catch (Throwable $e) {
                // A broken plugin must not break the whole sitemap
                report($e);
            }
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls->unique('loc') as $url) {
            $xml .= '  <url><loc>'.htmlspecialchars($url['loc'], ENT_XML1 | ENT_QUOTES, 'UTF-8').'</loc>';

            if ($url['lastmod'] instanceof DateTimeInterface) {
                $xml .= '<lastmod>'.$url['lastmod']->format('Y-m-d\TH:i:sP').'</lastmod>';
            }

            $xml .= '</url>'."\n";
        }

        return $xml.'</urlset>'."\n";
    }

    /**
     * Get the sections of the sitemap, each one returning a list of urls.
     *
     * @return array<int, Closure(): iterable<int, array{loc: string, lastmod: ?DateTimeInterface}>>
     */
    protected function sections(): array
    {
        return [
            fn () => Page::enabled()
                ->whereDoesntHave('roles')
                ->get()
                ->map(fn (Page $page) => $this->url(route('pages.show', $page->slug), $page->updated_at)),

            fn () => Post::published()
                ->get()
                ->map(fn (Post $post) => $this->url(route('posts.show', $post), $post->updated_at)),

            fn () => $this->wiki(),
            fn () => $this->shop(),
            fn () => $this->changelog(),

            fn () => collect(['vote.home', 'staff.index'])
                ->filter(fn (string $name) => $this->pluginRoute($name))
                ->map(fn (string $name) => $this->url(route($name))),
        ];
    }

    protected function wiki(): iterable
    {
        $categoryClass = 'Azuriom\Plugin\Wiki\Models\Category';

        if (! $this->pluginRoute('wiki.pages.show') || ! class_exists($categoryClass)) {
            return [];
        }

        $categories = $categoryClass::with(['pages', 'parent'])
            ->where('is_enabled', true)
            ->get()
            ->filter(fn ($category) => $this->isPublicWikiCategory($category));

        $urls = [$this->url(route('wiki.index'))];

        foreach ($categories as $category) {
            foreach ($category->pages as $page) {
                $urls[] = $this->url(route('wiki.pages.show', [$category, $page]), $page->updated_at);
            }
        }

        return $urls;
    }

    protected function isPublicWikiCategory($category): bool
    {
        if (! $category->is_enabled || $category->roles !== null) {
            return false;
        }

        return $category->parent === null || $this->isPublicWikiCategory($category->parent);
    }

    protected function shop(): iterable
    {
        $categoryClass = 'Azuriom\Plugin\Shop\Models\Category';

        if (! $this->pluginRoute('shop.categories.show') || ! class_exists($categoryClass)) {
            return [];
        }

        // Categories without packages redirect to their first sub-category
        return $categoryClass::scopes('enabled')
            ->whereHas('packages', fn ($query) => $query->scopes('enabled'))
            ->get()
            ->map(fn ($category) => $this->url(route('shop.categories.show', $category), $category->updated_at));
    }

    protected function changelog(): iterable
    {
        $categoryClass = 'Azuriom\Plugin\Changelog\Models\Category';

        if (! $this->pluginRoute('changelog.index') || ! class_exists($categoryClass)) {
            return [];
        }

        $urls = [$this->url(route('changelog.index'))];

        $categoryClass::scopes('enabled')
            ->withMax('updates', 'updated_at')
            ->get()
            ->each(function ($category) use (&$urls) {
                $lastUpdate = $category->updates_max_updated_at !== null
                    ? Carbon::parse($category->updates_max_updated_at)
                    : null;

                $urls[] = $this->url(route('changelog.categories.show', $category), $lastUpdate);
            });

        return $urls;
    }

    protected function pluginRoute(string $name): bool
    {
        $plugin = strtok($name, '.');

        return plugins()->isEnabled($plugin) && Route::has($name);
    }

    /**
     * @return array{loc: string, lastmod: ?DateTimeInterface}
     */
    protected function url(string $loc, ?DateTimeInterface $lastmod = null): array
    {
        return ['loc' => $loc, 'lastmod' => $lastmod];
    }
}
