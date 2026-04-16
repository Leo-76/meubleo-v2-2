<?php declare(strict_types=1);

namespace Meubleo\Screen\Fields;

use Meubleo\Screen\Field;

class Password extends Field
{
    protected $view = 'meubleo::fields.password';
    protected array $attributes = ['class' => 'form-control', 'type' => 'password'];
    protected array $inlineAttributes = ['name', 'required', 'disabled', 'placeholder', 'autocomplete'];
}
