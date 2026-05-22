<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('parent_id')
                  ->label(__('category.parent_id'))
                  ->options(function (?Model $record) {
                    $query = Category::where('is_active', true)->with('translation');
        
                    // Исключаем текущую категорию при редактировании
                    if($record?->id) {
                        $query->where('id', '!=', $record->id)
                        ->where(function ($q) use ($record) {
                            $q->whereNull('parent_id')
                              ->orWhere('parent_id', '!=', $record->id);
                        });
                    }
                    return $query->get()
                    ->mapWithKeys(fn ($category) => [
                        $category->id => $category->translation?->name ?? $category->slug
                    ]);
                  }
                  )
                  ->searchable()
                  ->nullable()
                  ->placeholder(__('category.parent')),
                TextInput::make('slug')
                    ->label(__('category.slug'))
                    ->required()
                    ->rules(['regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'])
                    ->helperText('Только строчные буквы, цифры и дефис'),
                Repeater::make('translations')
                    ->label('Переводы')
                    ->relationship('translations')
                    ->schema([
                        Select::make('lang_code')
                        ->label('Язык')
                        ->options(config('app.languages'))
                        ->required()
                        ->distinct()
                        ->disableOptionsWhenSelectedInSiblingRepeaterItems(),

                        TextInput::make('name')
                            ->label('Название')
                            ->required(),

                        Textarea::make('description')
                            ->label('Описание')
                            ->rows(3),

                        FileUpload::make('image')
                            ->label('Изображение')
                            ->image()
                            ->directory('categories')
                            ->disk('public'),
                    ])
                    ->addActionLabel('Добавить перевод')
                    ->collapsible()
                    ->itemLabel(fn (array $state) => $state['lang_code'] ?? 'Новый перевод'),
            ])->columns(1);
    }
}
