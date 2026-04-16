<?php declare(strict_types=1);

namespace Meubleo\Screen\Fields;

use Meubleo\Screen\Field;

/**
 * Select field.
 *
 * Usage: Select::make('category_id')->fromModel(Category::class, 'name')->title('Category')
 */
class Select extends Field
{
    protected $view = 'meubleo::fields.select';

    protected array $attributes = [
        'class'   => 'form-select',
        'options' => [],
    ];

    protected array $inlineAttributes = [
        'name', 'required', 'disabled', 'multiple',
    ];

    public function options(array $options): static
    {
        return $this->set('options', $options);
    }

    public function fromModel(string $model, string $titleColumn, string $keyColumn = 'id'): static
    {
        $options = $model::all()->pluck($titleColumn, $keyColumn)->toArray();
        return $this->options($options);
    }

    public function empty(string $label = '— Select —', mixed $value = null): static
    {
        $this->addBeforeRender(function () use ($label, $value) {
            $options   = $this->get('options', []);
            $this->set('options', [$value => $label] + $options);
        });
        return $this;
    }

    public function multiple(bool $multiple = true): static
    {
        return $this->set('multiple', $multiple);
    }
}
