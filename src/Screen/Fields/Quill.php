<?php declare(strict_types=1);

namespace Meubleo\Screen\Fields;

use Meubleo\Screen\Field;

class Quill extends Field
{
    protected $view = 'meubleo::fields.quill';
    protected array $attributes = ['class' => 'quill-editor'];
    protected array $inlineAttributes = ['name', 'required', 'disabled'];

    public function toolbar(array $items): static
    {
        return $this->set('toolbar', $items);
    }
}
