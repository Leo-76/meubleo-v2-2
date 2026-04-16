<?php

declare(strict_types=1);

namespace Meubleo\Screen\Layouts;

use Illuminate\Contracts\View\View;
use Meubleo\Screen\Field;
use Meubleo\Screen\Layout;
use Meubleo\Screen\Repository;

abstract class Rows extends Layout
{
    protected string $template = 'meubleo::layouts.rows';

    public function build(Repository $repository): View|null
    {
        if (!$this->isSee()) {
            return null;
        }

        $fields = collect($this->fields())
            ->filter(fn (Field $field) => $field->isSee());

        return view($this->template, [
            'repository' => $repository,
            'fields'     => $fields,
            'slug'       => $this->getSlug(),
        ]);
    }

    /** Define the form fields. */
    abstract protected function fields(): iterable;
}
