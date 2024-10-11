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
                {{-- @if (Auth::user() && ($albom->user_id == Auth::user()->id or Auth::user()->is_admin == 1))
                    <a href="{{ route('deleteTrack', ['track_id' => $albom->id]) }}"
                        class="btn-delete"><x-primary-button>Удалить</x-primary-button></a>
                @endif --}}
            </div>
        </div>

        <ul class="w-full divide-y divide-gray-200 px-6 border py-2 rounded-xl">
            @foreach ($tracks as $track)
                <li class="pb-3 sm:pb-4">
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                        <div class="flex-shrink-0">
                            <img class="w-8 h-8 rounded" src={{ asset('storage/' . $track->cover_file) }} alt="Neil image">
                        </div>
                        <div class="flex-1 min-w-0 flex flex-col">
                            <a href={{ route('ShawTrack', ['id' => $track->id]) }}
                                class="text-sm font-medium text-gray-900 truncate">
                                {{ $track->name }}
                            </a>
                            <a href={{ route('profile', ['id' => $track->user->id]) }}
                                class="text-sm text-gray-500 truncate">
                                {{ $track->user->name }}
                            </a>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900">
                            <x-primary-button>Удалить</x-primary-buttin>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

<form id="add-track-to-playlist-form" action="{{ route('addTrackToPlaylist') }}" method="POST"
    style="position: absolute; left: -1000px; top: -1000px;">
    <input type="hidden" name="track_id" id="track_id_for_playlist">
    <input type="hidden" name="albom_id" id="playlist_id_for_track">
    @csrf
</form>
