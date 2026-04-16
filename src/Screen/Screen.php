<?php

declare(strict_types=1);

namespace Meubleo\Screen;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Meubleo\Platform\Http\Controllers\Controller;

/**
 * Screen
 *
 * A Screen is a full admin page. It declares its own data (query),
 * its command buttons (commandBar) and its layout (layout).
 */
abstract class Screen extends Controller
{
    use Commander;

    // ─── Abstract interface ───────────────────────────────────────────────────

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array<string, mixed>
     */
    abstract public function query(): iterable;

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->name ?? null;
    }

    /**
     * A short description shown below the name.
     */
    public function description(): ?string
    {
        return $this->description ?? null;
    }

    /**
     * The action buttons displayed in the header.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return Layout[]|string[]
     */
    abstract public function layout(): iterable;

    // ─── HTTP handler ─────────────────────────────────────────────────────────

    public function __invoke(Request $request, ...$arguments): mixed
    {
        return $this->handle($request, ...$arguments);
    }

    protected function handle(Request $request, ...$arguments): mixed
    {
        $method = $request->route('method') ?? '__index';

        if ($method !== '__index' && method_exists($this, $method)) {
            return $this->{$method}($request, ...$arguments);
        }

        $query      = $this->query(...$arguments);
        $repository = new Repository($query);

        return view('meubleo::layouts.base', [
            'screen'     => $this,
            'repository' => $repository,
            'layouts'    => collect($this->layout()),
        ]);
    }

    // ─── Route helper ─────────────────────────────────────────────────────────

    public static function getAvailableMethods(): Collection
    {
        return collect(get_class_methods(static::class))
            ->filter(fn (string $m) => ! in_array($m, [
                '__construct', '__invoke', 'handle', 'query',
                'name', 'description', 'commandBar', 'layout',
                'middleware', 'getMiddleware',
            ]))
            ->values();
    }
}
