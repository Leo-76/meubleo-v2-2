<?php

declare(strict_types=1);

namespace Meubleo\Screen\Fields;

use Meubleo\Screen\Field;

/**
 * Input field.
 *
 * @method $this type(string $value)
 * @method $this min(int $value)
 * @method $this max(int $value)
 * @method $this minlength(int $value)
 * @method $this maxlength(int $value)
 * @method $this step($value)
 * @method $this pattern(string $value)
 * @method $this autocomplete(string $value)
 * @method $this autofocus(bool $value = true)
 * @method $this mask(string|array $value)
 */
class Input extends Field
{
    protected $view = 'meubleo::fields.input';

    protected array $attributes = [
        'class' => 'form-control',
        'type'  => 'text',
    ];

    protected array $inlineAttributes = [
        'type', 'name', 'placeholder', 'required', 'disabled',
        'readonly', 'min', 'max', 'minlength', 'maxlength',
        'step', 'pattern', 'autocomplete', 'autofocus', 'mask',
    ];
}
