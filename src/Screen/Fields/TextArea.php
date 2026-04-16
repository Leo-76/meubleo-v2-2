<?php declare(strict_types=1);

namespace Meubleo\Screen\Fields;

use Meubleo\Screen\Field;

// ─── TextArea ─────────────────────────────────────────────────────────────────

class TextArea extends Field
{
    protected $view = 'meubleo::fields.textarea';

    protected array $attributes = [
        'class' => 'form-control',
        'rows'  => 5,
    ];

    protected array $inlineAttributes = [
        'name', 'rows', 'cols', 'placeholder', 'required',
        'disabled', 'readonly', 'maxlength',
    ];
}
