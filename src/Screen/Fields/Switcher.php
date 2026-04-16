<?php declare(strict_types=1);

namespace Meubleo\Screen\Fields;

use Meubleo\Screen\Field;

class Switcher extends Field
{
    protected $view = 'meubleo::fields.switch';
    protected array $attributes = ['class' => 'form-check-input', 'type' => 'checkbox'];
    protected array $inlineAttributes = ['name', 'disabled', 'value'];

    public function sendTrueOrFalse(bool $mode = true): static
    {
        return $this->set('sendTrueOrFalse', $mode);
    }
}
