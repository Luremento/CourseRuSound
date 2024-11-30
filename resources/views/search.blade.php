@extends('layouts.app')

@section('title')
    ruSound
@endsection

@section('content')
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
            @if (Auth::check())
                <div class="col-span-4 sm:col-span-9">
                    <div class="bg-white shadow rounded-lg p-6">
                        <form class="w-full" action="{{ route('search') }}" method="POST">
                            @csrf
                            <label for="default-search"
                                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" id="default-search" name="word"
                                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Название треки или плейлиста" required />
                                <button type="submit"
                                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Поиск</button>
                            </div>
                        </form>

                        <!-- Если есть результаты поиска -->
                        @if (isset($tracks) && $tracks->isNotEmpty())
                            <h2 class="text-xl font-bold mb-4 pt-2">Результаты поиска - Треки</h2>
                            <div class="grid grid-cols-4 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                                @foreach ($tracks as $track)
                                    @component('components.Card', [
                                        'track' => $track,
                                        'artist' => $track->user,
                                        'myPlaylists' => $myPlaylists ?? null,
                                        'type' => 'track',
                                    ])
                                    @endcomponent
                                @endforeach
                            </div>
                        @endif

                        @if (isset($alboms) && $alboms->isNotEmpty())
                            <h2 class="text-xl font-bold mb-4 mt-4">Результаты поиска - Альбомы</h2>
                            <div class="grid grid-cols-4 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                                @foreach ($alboms as $albom)
                                    @component('components.Card', [
                                        'track' => $albom,
                                        'artist' => $albom->user,
                                        'type' => 'albom',
                                    ])
                                    @endcomponent
                                @endforeach
                            </div>
                        @endif

                        <!-- Если нет результатов -->
                        @if ((!isset($tracks) || $tracks->isEmpty()) && (!isset($alboms) || $alboms->isEmpty()))
                            <p class="mt-4 text-gray-500">По вашему запросу ничего не найдено.</p>
                        @endif
                    </div>
                </div>
            @else
                <div class="col-span-4 sm:col-span-12">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-4">Новинки</h2>
                        <div class="grid grid-cols-4 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                            @if (!empty($new_tracks) && $new_tracks->isNotEmpty())
                                @foreach ($new_tracks as $track)
                                    @component('components.Card', [
                                        'track' => $track,
                                        'artist' => $track->user,
                                        'type' => 'track',
                                    ])
                                    @endcomponent
                                @endforeach
                            @endif
                        </div>

                        <h2 class="text-xl font-bold mb-4 mt-4">Альбомы</h2>
                        <div class="grid grid-cols-4 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                            @foreach ($alboms as $albom)
                                @component('components.Card', [
                                    'track' => $albom,
                                    'artist' => $albom->user,
                                    'type' => 'albom',
                                ])
                                @endcomponent
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
