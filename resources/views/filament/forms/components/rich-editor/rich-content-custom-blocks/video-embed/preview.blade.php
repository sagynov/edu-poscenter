@if($embedId)
    <div class="flex items-center gap-2 p-2 bg-gray-100 rounded">
        <x-heroicon-o-play-circle class="w-6 h-6 text-red-500" />
        <span class="text-sm">YouTube: {{ $embedId }}</span>
    </div>
@elseif($videoFile)
    <div class="flex items-center gap-2 p-2 bg-gray-100 rounded">
        <x-heroicon-o-film class="w-6 h-6 text-blue-500" />
        <span class="text-sm">Видео файл</span>
    </div>
@else
    <div class="p-2 text-sm text-gray-400">Видео не выбрано</div>
@endif