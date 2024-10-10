@extends('layouts.app')
@section('title')
    ruSound - {{ $user->name }}
@endsection

@section('content')
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
            <div class="col-span-4 sm:col-span-3">
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex flex-col items-center">
                        <img src={{ asset('img/avatar_default.png') }}
                            class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">
                        </img>
                        <h1 class="text-xl font-bold">{{ $user->name }}</h1>
                        <p class="text-sm font-semibold leading-6 text-gray-900">Регистрация: {{ $user->created_at }}</p>
                    </div>
                    <div class="mt-6 flex flex-wrap gap-4 justify-center">
                        <a href={{ route('profile.edit') }}
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Изменить</a>
                        <a href="#"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">Выход</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <hr class="my-6 border-t border-gray-300">
                    <div class="flex flex-col">
                        <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">Популярные треки</span>
                        <ul>
                            <li
                                class="mb-2 flex items-center gap-3 text-sm font-semibold leading-6 text-gray-900 border rounded p-1">
                                <img class="w-10 h-10 rounded" src={{ asset('img/avatar_default.png') }}
                                    alt="Default avatar">Название
                            </li>
                            <li
                                class="mb-2 flex items-center gap-3 text-sm font-semibold leading-6 text-gray-900 border rounded p-1">
                                <img class="w-10 h-10 rounded" src={{ asset('img/avatar_default.png') }}
                                    alt="Default avatar">Название
                            </li>
                            <li
                                class="mb-2 flex items-center gap-3 text-sm font-semibold leading-6 text-gray-900 border rounded p-1">
                                <img class="w-10 h-10 rounded" src={{ asset('img/avatar_default.png') }}
                                    alt="Default avatar">Название
                            </li>
                            <li
                                class="mb-2 flex items-center gap-3 text-sm font-semibold leading-6 text-gray-900 border rounded p-1">
                                <img class="w-10 h-10 rounded" src={{ asset('img/avatar_default.png') }}
                                    alt="Default avatar">Название
                            </li>
                            <li
                                class="mb-2 flex items-center gap-3 text-sm font-semibold leading-6 text-gray-900 border rounded p-1">
                                <img class="w-10 h-10 rounded" src={{ asset('img/avatar_default.png') }}
                                    alt="Default avatar">Название
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-span-4 sm:col-span-9">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Треки</h2>

                    <div class="grid grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                        {{-- Карточки --}}
                        @foreach ($tracks as $track)
                            @component('components.Card', [
                                'track' => $track,
                                'artist' => $track->user,
                                'type' => 'track',
                            ])
                            @endcomponent
                        @endforeach
                        {{-- Карточки --}}
                    </div>

                    <h2 class="text-xl font-bold mb-4 mt-4">Альбомы</h2>

                    <div class="grid grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                        {{-- Карточки --}}
                        @foreach ($alboms as $albom)
                            @component('components.Card', [
                                'track' => $albom,
                                'artist' => $track->user,
                                'type' => 'albom',
                            ])
                            @endcomponent
                        @endforeach
                        {{-- Карточки --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
