@extends('layouts.app')
@section('title')
    ruSound
@endsection

@section('content')
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
            <div class="col-span-4 sm:col-span-9">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Новинки</h2>

                    <div class="grid grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                        {{-- Карточки --}}
                        @foreach ($new_tracks as $track)
                            @component('components.Card', [
                                'track' => $track,
                                'artist' => $track->user,
                            ])
                            @endcomponent
                        @endforeach
                        {{-- Карточки --}}
                    </div>

                    <h2 class="text-xl font-bold mb-4 mt-4">Альбомы</h2>

                    <div class="grid grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                        {{-- Карточки --}}
                        {{-- @component('components.Card', [
    'title' => 'Название',
    'artist' => 'Артист',
    'imageSrc' => asset('img/avatar_default.png'),
])
                        @endcomponent --}}
                        {{-- Карточки --}}
                    </div>
                </div>
            </div>
            <div class="col-span-4 sm:col-span-3">
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex flex-col items-center">
                        <img src={{ asset('img/avatar_default.png') }}
                            class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">
                        </img>
                        {{-- <h1 class="text-xl font-bold">{{ $user->name }}</h1>
                        <p class="text-sm font-semibold leading-6 text-gray-900">Регистрация: {{ $user->created_at }}</p> --}}
                    </div>
                    <div class="mt-6 flex flex-wrap gap-4 justify-center">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a href="#"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">Выход</a>
                    </div>
                    <hr class="my-6 border-t border-gray-300">
                    <div class="flex flex-col">
                        <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">Избранное</span>
                        <ul>
                            @if ($liked)
                            @foreach ($liked as $like)
                                <li
                                    class="mb-2 flex items-center gap-3 text-sm font-semibold leading-6 text-gray-900 border rounded p-1">
                                    <img class="w-10 h-10 rounded" src={{ asset('storage/' . $like->track->cover_file) }}
                                        alt="Default avatar">
                                    <div class="flex flex-col">
                                        <p>{{ $like->track->name }}</p>
                                        <a
                                            href={{ route('profile', [
                                                'user_id' => $like->user->id,
                                            ]) }}>{{ $like->user->name }}</a>
                                    </div>
                                </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="w-9/12 border p-4 mb-4 rounded">
        <div class="ml-5 mt-5">
            <div class="flex flex-wrap gap-5 mt-5">
                @foreach ($random_traks as $treak)
                    <div class="flex flex-col md:flex-row gap-2 justify-center">
                        <a href="{{ route('ShawTrack', ['id' => $treak->id]) }}"><img
                                src="{{ asset('storage/' . $treak->cover_file) }}" class="w-32 h-32"></a>
                        <a href="{{ route('ShawTrack', ['id' => $treak->id]) }}"
                            class="text-lg text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out"
                            style="opacity: 0.6;">{{ $treak->name }}</a>
                        <a class="text-base text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out"
                            href="{{ route('home', ['user_id' => $treak->user->id]) }}"
                            style="opacity: 0.6;">{{ $treak->user->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if ($likes)
        <div class="w-3/12">
            <div class="flex justify-start">
                <div class="w-full">
                    <div class="bg-white p-3 mb-3">
                        <h5 class="text-lg font-bold">Понравившиеся треки</h5>
                        @foreach ($likes as $like)
                            <div class="flex flex-row gap-2 mb-2">
                                <div class="mr-2">
                                    <a href="{{ route('ShawTrack', ['id' => $like->track->id]) }}"><img
                                            src="{{ asset('storage/' . $like->track->cover_file) }}" class="w-12 h-12"></a>
                                </div>
                                <div>
                                    <a href="{{ route('ShawTrack', ['id' => $like->track->id]) }}"
                                        class="text-base text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out"
                                        style="opacity: 0.6;">{{ $like->track->name }}</a>
                                    <div class="text-sm text-gray-600" style="opacity: 0.6;">
                                        <a href="{{ route('home', ['user_id' => $like->user->id]) }}">
                                            {{ $like->user->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif --}}
@endsection
