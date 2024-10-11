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
                        <h2 class="text-xl font-bold mb-4">Новинки</h2>

                        <div class="grid grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                            @foreach ($new_tracks as $track)
                                @component('components.Card', [
                                    'track' => $track,
                                    'artist' => $track->user,
                                    'type' => 'track',
                                ])
                                @endcomponent
                            @endforeach
                        </div>

                        <h2 class="text-xl font-bold mb-4 mt-4">Альбомы</h2>

                        <div class="grid grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                        </div>
                    </div>
                </div>
                <div class="col-span-4 sm:col-span-3">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex flex-col items-center">
                            @if (Auth::user() && Auth::user()->photo)
                                <img src={{ asset(Auth::user()->photo) }}
                                    class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0"></img>
                            @else
                                <img src={{ asset('img/avatar_default.png') }}
                                    class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">
                                </img>
                            @endif
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
                        @if (count($liked) > 0)
                            <hr class="my-6 border-t border-gray-300">
                            <div class="flex flex-col">
                                <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">Избранное</span>
                                <ul>
                                    @foreach ($liked as $like)
                                        <a
                                            href={{ route('ShawTrack', [
                                                'id' => $like->track->id,
                                            ]) }}>
                                            <li
                                                class="mb-2 flex items-center gap-3 text-sm font-semibold leading-6 text-gray-900 border rounded p-1">
                                                <img class="w-10 h-10 rounded"
                                                    src={{ asset('storage/' . $like->track->cover_file) }}
                                                    alt="Default avatar">
                                                <div class="flex flex-col">
                                                    <p>{{ $like->track->name }}</p>
                                                    <a
                                                        href={{ route('profile', [
                                                            'user_id' => $like->user->id,
                                                        ]) }}>{{ $like->user->name }}</a>
                                                </div>
                                            </li>
                                        </a>
                                    @endforeach
                                    @if (count($liked) >= 5)
                                        <a href={{ route('login') }}
                                            class="flex justify-end text-sm font-semibold leading-6 text-gray-900">Ещё<span
                                                aria-hidden="true">&rarr;</span></a>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="col-span-4 sm:col-span-12">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-4">Новинки</h2>

                        <div class="grid grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                            @foreach ($new_tracks as $track)
                                @component('components.Card', [
                                    'track' => $track,
                                    'artist' => $track->user,
                                    'type' => 'albom',
                                ])
                                @endcomponent
                            @endforeach
                        </div>

                        <h2 class="text-xl font-bold mb-4 mt-4">Альбомы</h2>

                        <div class="grid grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
