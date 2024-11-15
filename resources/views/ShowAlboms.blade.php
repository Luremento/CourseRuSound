@extends('layouts.app')
@section('title')
    ruSound - Альбомы
@endsection

@section('content')
    <div class="container py-8">
        <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
            <div class="col-span-4 sm:col-span-9">
                <div class="bg-white shadow rounded-lg p-6">

                    {{-- <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        type="button">
                        Добавить альбом
                    </button> --}}
                    <x-primary-button data-modal-target="authentication-modal"
                        data-modal-toggle="authentication-modal">Добавить плейлист</x-primary-button>

                    <!-- Main modal -->
                    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        Создание плейлиста
                                    </h3>
                                    <button type="button"
                                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="authentication-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5">
                                    <form class="space-y-4" enctype="multipart/form-data" action={{ route('NewAlbom') }}
                                        method="POST">
                                        @csrf
                                        <div>
                                            <div class="mb-4">
                                                <label for="cover"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Название
                                                    плейлиста</label>
                                                <input type="text" name="name" id="name"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    required />
                                            </div>
                                            <div class="mb-4">
                                                <div class="flex items-center justify-center w-full">
                                                    <label for="cover"
                                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 20 16">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                            </svg>
                                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                                    class="font-semibold" id="file-name">Нажмите, чтобы
                                                                    выбрать обложку</span></p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG,
                                                                JPEG, WEBP</p>
                                                        </div>
                                                        <input id="cover" name="cover" type="file" class="hidden"
                                                            onchange="displayFileName(this)" />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Создать</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
            @if (Auth::check())
                <div class="col-span-4 sm:col-span-9">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-4">Ваши Плейлисты</h2>

                        <div class="grid grid-cols-3 max-md:grid-cols-2 max-sm:grid-cols-1 gap-5">
                            @if (count($alboms) > 0)
                                @foreach ($alboms as $albom)
                                    @component('components.Card', [
                                        'track' => $albom,
                                        'artist' => $albom->user,
                                        'type' => 'albom',
                                    ])
                                    @endcomponent
                                @endforeach
                            @else
                                <p>Вы не добавили ни один плейлист</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function displayFileName(input) {
            const fileNameElement = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileNameElement.textContent = input.files[0].name;
            } else {
                fileNameElement.textContent = 'Нажмите, чтобы выбрать обложку';
            }
        }
    </script>
@endsection
