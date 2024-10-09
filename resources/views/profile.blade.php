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
                            ])
                            @endcomponent
                        @endforeach
                        {{-- Карточки --}}
                    </div>

                    <h2 class="text-xl font-bold mb-4 mt-4">Альбомы</h2>

                    <div class="grid grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                        {{-- Карточки --}}
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                            <a href="#">
                                <img class="rounded-t-lg" src={{ asset('img/avatar_default.png') }} />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                        Название</h5>
                                </a>
                                <a href="#"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Слушать
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                            <a href="#">
                                <img class="rounded-t-lg" src={{ asset('img/avatar_default.png') }} alt="" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                        Название</h5>
                                </a>
                                <a href="#"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Слушать
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                            <a href="#">
                                <img class="rounded-t-lg" src={{ asset('img/avatar_default.png') }} alt="" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                        Название</h5>
                                </a>
                                <a href="#"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Слушать
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                            <a href="#">
                                <img class="rounded-t-lg" src={{ asset('img/avatar_default.png') }} alt="" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                        Название</h5>
                                </a>

                                <a href="#"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Слушать
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        {{-- Карточки --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
