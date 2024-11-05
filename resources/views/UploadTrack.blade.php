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
                        <div class="grid grid-cols-2 gap-3">
                            <div class="mb-4">
                                <div class="flex items-center justify-center w-full">
                                    <label for="track" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Выберите трек</span></p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400"></p>
                                        </div>
                                        <input id="track" name="track" type="file" class="hidden" />
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="flex items-center justify-center w-full">
                                    <label for="cover" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Выберите обложку</span></p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG, WEBP</p>
                                        </div>
                                        <input id="cover" name="cover" type="file" class="hidden" />
                                    </label>
                                </div>
                            </div>
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
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Загрузить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
