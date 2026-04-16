<?php declare(strict_types=1);

namespace Meubleo\Screen\Fields;

use Meubleo\Screen\Field;

class Picture extends Field
{
    protected $view = 'meubleo::fields.picture';
    protected array $attributes = ['class' => 'form-control', 'type' => 'file', 'accept' => 'image/*'];
    protected array $inlineAttributes = ['name', 'required', 'disabled', 'accept', 'maxFileSize'];

    public function maxFileSize(int $sizeInMb): static
    {
        return $this->set('maxFileSize', $sizeInMb);
    }

    public function targetId(): static
    {
        return $this->set('targetId', true);
    }
}
