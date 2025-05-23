<?php

namespace App\Forms\Components;

use App\Forms\Concerns\HasExtraFieldWrapperAttributes;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Concerns\CanBeAutofocused;
use Filament\Forms\Components\Concerns\CanBeMarkedAsRequired;
use Filament\Forms\Components\Concerns\CanBeValidated;

// use Filament\Forms\Components\Concerns\HasExtraFieldWrapperAttributes;
use Filament\Forms\Components\Concerns\HasHelperText;
use Filament\Forms\Components\Concerns\HasHint;
use Filament\Forms\Components\Concerns\HasName;
use Filament\Forms\Components\Field;
use Illuminate\Support\Arr;
class GroupedFields extends Component
{
    protected string $view = 'forms.components.grouped-fields';
    use CanBeAutofocused;
    use CanBeMarkedAsRequired;
    use CanBeValidated;
    use HasExtraFieldWrapperAttributes;
    use HasHelperText;
    use HasHint;
    use HasName;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    protected string $viewIdentifier = 'field';


    public function getResponsiveClasses(): array
    {
        $columns = $this->getColumnsConfig();

        return [
            'vertical' => data_get($columns, 'default', 1) === 1,
            'horizontal' => data_get($columns, 'default', 1) > 1,
            'sm:vertical' => data_get($columns, 'sm') === 1,
            'sm:horizontal' => data_get($columns, 'sm') > 1,
            'md:vertical' => data_get($columns, 'md') === 1,
            'md:horizontal' => data_get($columns, 'md') > 1,
            'lg:vertical' => data_get($columns, 'lg') === 1,
            'lg:horizontal' => data_get($columns, 'lg') > 1,
            'xl:vertical' => data_get($columns, 'xl') === 1,
            'xl:horizontal' => data_get($columns, 'xl') > 1,
            '2xl:vertical' => data_get($columns, '2xl') === 1,
            '2xl:horizontal' => data_get($columns, '2xl') > 1,
        ];
    }

    public function getChildComponents(): array
    {
        return Arr::map(
            parent::getChildComponents(),
            function (Component $component) {
                return $component
                    ->fieldWrapperView('field-wrapper')
                ;
            }
        );
    }

    public static function make(array $schema = []): static
    {
        $component = app(static::class, [
            'name' => 'grouped-fields',
        ])
            ->when(
                ! empty($schema),
                fn (Component $component) => $component->schema($schema)
            )
            ->required(
                fn (GroupedFields $component) => Arr::first(
                    $component->getChildComponents(),
                    fn (Component $component) => $component instanceof Field && $component->isRequired()
                ) !== null
            )
        ;

        return $component
            ->columns(count($component->getChildComponents()))
            ->configure()
        ;
    }
}
