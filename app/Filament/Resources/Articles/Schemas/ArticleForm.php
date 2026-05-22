<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\VideoEmbedBlock;
use App\Models\Category;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                  ->required()
                  ->label(__('article.category_id'))
                  ->options(
                      Category::with('translation')->get()
                          ->mapWithKeys(fn ($category) => [
                              $category->id => $category->translation?->name ?? $category->slug
                          ])
                  )
                  ->searchable()
                  ->placeholder(__('article.category_id')),
                TextInput::make('slug')
                    ->label(__('article.slug'))
                    ->required(),
                Toggle::make('is_active')
                    ->label(__('article.is_active'))
                    ->default(true)
                    ->required(),
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

                        TextInput::make('title')
                            ->label('Тема')
                            ->required(),
                        RichEditor::make('content')
                          ->label('Контент')
                          ->fileAttachmentsVisibility('public')
                          ->fileAttachmentsDirectory('articles')
                          ->customBlocks([
                                'Media' => [
                                    VideoEmbedBlock::class,
                                ],
                            ])
                    ])
                    ->addActionLabel('Добавить перевод')
                    ->collapsible()
                    ->itemLabel(fn (array $state) => $state['lang_code'] ?? 'Новый перевод'),
            ])->columns(1);
    }
}
