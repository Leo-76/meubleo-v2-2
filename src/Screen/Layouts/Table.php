<?php

declare(strict_types=1);

namespace Meubleo\Screen\Layouts;

use Illuminate\Contracts\View\View;
use Meubleo\Screen\Layout;
use Meubleo\Screen\Repository;
use Meubleo\Screen\TD;

abstract class Table extends Layout
{
    protected string $template = 'meubleo::layouts.table';

    /** Key in the Repository pointing to the data collection / paginator. */
    protected string $target;

    protected ?string $title = null;

    public function build(Repository $repository): View|null
    {
        if (!$this->isSee()) {
            return null;
        }

        $this->query = $repository;

        $columns = collect($this->columns())
            ->filter(fn (TD $col) => $col->isSee());

        $rows = $repository->getContent($this->target);

        return view($this->template, [
            'repository' => $repository,
            'columns'    => $columns,
            'rows'       => $rows,
            'title'      => $this->title,
            'slug'       => $this->getSlug(),
            'striped'    => $this->striped(),
            'hoverable'  => $this->hoverable(),
            'compact'    => $this->compact(),
        ]);
    }

    /** Define the table columns. */
    abstract protected function columns(): iterable;

    protected function striped(): bool   { return false; }
    protected function hoverable(): bool { return true; }
    protected function compact(): bool   { return false; }
}
