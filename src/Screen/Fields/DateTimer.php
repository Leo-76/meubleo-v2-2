<?php declare(strict_types=1);

namespace Meubleo\Screen\Fields;

use Meubleo\Screen\Field;

class DateTimer extends Field
{
    protected $view = 'meubleo::fields.datetime';
    protected array $attributes = ['class' => 'form-control', 'type' => 'datetime-local'];
    protected array $inlineAttributes = ['name', 'required', 'disabled', 'readonly', 'min', 'max', 'format'];

    public function format(string $format): static
    {
        return $this->set('format', $format);
    }

    public function enableTime(bool $enable = true): static
    {
        return $this->set('enableTime', $enable);
    }

    public function noCalendar(bool $noCalendar = true): static
    {
        return $this->set('noCalendar', $noCalendar);
    }
}
