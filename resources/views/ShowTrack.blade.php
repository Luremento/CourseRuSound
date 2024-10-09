@extends('layouts.app')

@section('content')
    <div class="w-9/12 border p-4 mb-4 rounded">
        <div class="bg-white rounded p-5 flex flex-wrap justify-start gap-4 w-full">
            <img src="{{ asset('storage/' . $track->cover_file) }}" alt="" class="rounded w-48 h-48" width="200"
                height="200">
            <div class="flex flex-col">
                <div class="flex items-center h-min">
                    <h3 class="text-xl font-bold mb-0">{{ $track->name }}</h3>
                    <button
                        onclick="event.preventDefault();
                                              document.getElementById('liked-form').submit();">
                        @if ($like)
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16"
                                class="ml-2">
                                <path fill="red"
                                    d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-heart ml-2" viewBox="0 0 16 16">
                                <path
                                    d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>
                        @endif
                    </button>
                </div>
                <a href="{{ route('profile', ['user_id' => $track->user->id]) }}"
                    class="text-md font-bold mb-4 underline">{{ $track->user->name }}</a>
                @if ($track->user_id == Auth::user()->id or Auth::user()->is_admin == 1)
                    <a href="{{ route('deleteTrack', ['track_id' => $track->id]) }}"
                        class="btn-delete"><x-primary-button>Удалить</x-primary-button></a>
                @endif
                <p class="text-lg font-bold mb-4">Жанр: {{ $track->genre }}</p>
            </div>
            <div class="flex justify-betweene gap-5 w-full">
                <audio controls class="w-full">
                    <source src="{{ asset('storage/' . $track->music_file) }}">
                </audio>
            </div>
            <div class="flex flex-col w-full">
                <h6 class="border-b pb-2 mb-0 pt-4">Комментарии</h6>
                <div class="py-3">
                    <form action="{{ route('NewComment', ['id' => $track->id]) }}" method="POST">
                        @csrf
                        <label for="comment">Ваш комментарий</label>
                        <textarea class="w-full p-2 border rounded" id="comment" name="comment" rows="3"></textarea>
                        <div class="py-1">
                            <x-primary-button type="submit">Опубликовать</x-primary-button>
                        </div>
                    </form>
                </div>
                @foreach ($track->comment as $item)
                    <div class="flex text-gray-600 pt-3 flex-col border-b w-full">
                        <p class="pb-3 mb-0 small lh-sm w-full flex items-center gap-2">
                            <img class="w-10 h-10 rounded" src={{ asset('img/avatar_default.png') }} alt="Default avatar" <a
                                href="{{ route('profile', ['user_id' => $track->user->id]) }}">
                            <strong class="d-block text-gray-900">{{ $item->user->name }}</strong>
                            </a>
                        </p>
                        <div class="flex justify-between items-center">
                            {{ $item->comment }}
                            @if (Auth::id() == $item->user->id || Auth::id() == $track->user->id)
                                <form action={{ route('DeleteComm') }} method="POST" class="hidden">
                                    <input type="text" name="comment_id" id="comment_id" class=""
                                        value={{ $item->id }} class="hidden">
                                    <x-primary-button type="submit" class="w-min ">Удалить</x-primary-button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection


<form id="liked-form" action="{{ route('like.add') }}" method="POST"
    style="position: absolute; left: -1000px; top: -1000px;">
    <input type="text" name="track_id" id="track_id" value={{ $track->id }}>
    @csrf
</form>
