@extends('layouts.app')

@section('content')
    <div class="w-9/12 border p-4 mb-4 rounded">
        <div class="bg-white rounded p-5 flex flex-wrap justify-start gap-4 w-full">
            <img src="{{ asset('storage/' . $albom->cover_file) }}" alt="" class="rounded w-48 h-48" width="200"
                 height="200">
            <div class="flex flex-col">
                <div class="flex items-start h-min flex-col">
                    <p class="text-sm font-bold">Плейлист</p>
                    <h3 class="text-xl font-bold mb-0">{{ $albom->name }}</h3>
                </div>
                <a href="{{ route('profile', ['user_id' => $albom->user->id]) }}"
                   class="text-md font-bold underline">{{ $albom->user->name }}</a>
                <p class="font-medium">Треков: {{ count($tracks) }}</p>
                <a href="#" id="play-all-button"
                   class="btn-delete pb-2"><x-primary-button>Слушать</x-primary-button></a>
                @if (Auth::user() && ($albom->user_id == Auth::user()->id or Auth::user()->is_admin == 1))
                    <a href="{{ route('deleteAlbom', ['albom_id' => $albom->id]) }}"
                       class="btn-delete"><x-primary-button>Удалить</x-primary-button></a>
                @endif
            </div>
        </div>

        @if(count($tracks) > 0)
            <ul class="w-full divide-y divide-gray-200 px-4 border py-2 rounded-xl">
                @foreach ($tracks as $track)
                    <li class="py-2 sm:py-4">
                        <div class="flex items-center space-x-4 rtl:space-x-reverse">
                            <div class="flex-shrink-0">
                                <img class="w-12 h-12 rounded" src={{ asset('storage/' . $track->cover_file) }} alt="Neil_image">
                            </div>
                            <div class="flex-1 min-w-0 flex flex-col">
                                <a href="{{ route('ShawTrack', ['id' => $track->id]) }}"
                                   class="text-base font-medium text-gray-900 truncate">
                                    {{ $track->name }}
                                </a>
                                <a href="{{ route('profile', ['id' => $track->user->id]) }}"
                                   class="text-sm text-gray-500 truncate">
                                    {{ $track->user->name }}
                                </a>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                <form action="{{ route('albom.track.delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="track_id" value="{{ $track->id }}">
                                    <input type="hidden" name="albom_id" value="{{ $albom->id }}">
                                    <x-primary-button type="submit" class="flex items-center h-full">Удалить</x-primary-button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>В плейлисте не найдено ни одного трека</p>
        @endif
    </div>
@endsection

<form id="add-track-to-playlist-form" action="{{ route('addTrackToPlaylist') }}" method="POST"
      style="position: absolute; left: -1000px; top: -1000px;">
    <input type="hidden" name="track_id" id="track_id_for_playlist">
    <input type="hidden" name="albom_id" id="playlist_id_for_track">
    @csrf
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const playAllButton = document.getElementById('play-all-button');
        const audioElements = [];

        // Создаем аудиоэлементы для каждого трека
        @foreach ($tracks as $track)
        const audio{{ $track->id }} = new Audio("{{ asset('storage/' . $track->music_file) }}");
        audioElements.push(audio{{ $track->id }});
        @endforeach

        // Функция для проигрывания всех треков последовательно
        function playAllTracks() {
            let index = 0;

            function playNextTrack() {
                if (index < audioElements.length) {
                    const audio = audioElements[index];
                    audio.play();
                    audio.addEventListener('ended', function() {
                        index++;
                        playNextTrack();
                    });
                }
            }

            playNextTrack();
        }

        // Обработчик нажатия на кнопку "Слушать"
        playAllButton.addEventListener('click', function(event) {
            event.preventDefault();
            playAllTracks();
        });
    });
</script>
