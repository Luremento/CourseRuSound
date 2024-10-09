@extends('layouts.app')
@section('title')
    ruSound - Загрузка трека
@endsection

@section('content')
    <div class="w-9/12 border p-4 mb-4 rounded">
        <div class="flex justify-center">
            <div class="w-full md:w-2/3 lg:w-1/2 xl:w-1/3">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('NewMusic') }}">
                        @csrf
                        <h3 class="text-2xl font-bold mb-4">Загрузка трека</h3>
                        <div class="mb-4">
                            <label for="track" class="block text-gray-700 text-sm font-bold mb-2">Трек</label>
                            <input type="file"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="track" name="track">
                        </div>
                        <div class="mb-4">
                            <label for="track_name" class="block text-gray-700 text-sm font-bold mb-2">Название
                                трека:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="track_name" name="track_name">
                        </div>
                        <div class="mb-4">
                            <label for="genre_track" class="block text-gray-700 text-sm font-bold mb-2">Жанр
                                трека:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="genre_track" name="genre_track">
                        </div>
                        <div class="mb-4">
                            <label for="cover" class="block text-gray-700 text-sm font-bold mb-2">Обложка</label>
                            <input type="file"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="cover" name="cover">
                        </div>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Загрузить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
