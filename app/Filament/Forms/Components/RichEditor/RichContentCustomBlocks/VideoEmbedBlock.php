<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;

class VideoEmbedBlock extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'video_embed';
    }

    public static function getLabel(): string
    {
        return 'Видео (YouTube / файл)';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Вставьте ссылку YouTube или загрузите видео файл')
            ->schema([
                Tabs::make()->tabs([
                    Tabs\Tab::make('YouTube')->schema([
                        TextInput::make('youtube_url')
                            ->label('Ссылка YouTube')
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=...'),
                    ]),
                    Tabs\Tab::make('Файл')->schema([
                        FileUpload::make('video_file')
                            ->label('Видео файл')
                            ->acceptedFileTypes(['video/mp4', 'video/webm'])
                            ->directory('articles')
                            ->disk('public'),
                    ]),
                ]),
            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.video-embed.preview', [
            'youtubeUrl' => $config['youtube_url'] ?? null,
            'videoFile'  => $config['video_file'] ?? null,
            'embedId'    => static::extractYoutubeId($config['youtube_url'] ?? ''),
        ])->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.video-embed.index', [
            'youtubeUrl' => $config['youtube_url'] ?? null,
            'videoFile'  => $config['video_file'] ?? null,
            'embedId'    => static::extractYoutubeId($config['youtube_url'] ?? ''),
        ])->render();
    }

    protected static function extractYoutubeId(string $url): ?string
    {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
