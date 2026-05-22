@if($embedId)
    <div class="aspect-video my-4">
        <iframe
            src="https://www.youtube.com/embed/{{ $embedId }}"
            frameborder="0"
            allowfullscreen
            class="w-full h-full rounded-lg">
        </iframe>
    </div>
@elseif($videoFile)
    <video controls class="w-full rounded-lg my-4">
        <source src="{{ Storage::url($videoFile) }}">
    </video>
@endif