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
                <p class="font-medium">550 треков</p>
                @if (Auth::user() && ($albom->user_id == Auth::user()->id or Auth::user()->is_admin == 1))
                    <a href="{{ route('deleteTrack', ['track_id' => $albom->id]) }}"
                        class="btn-delete"><x-primary-button>Удалить</x-primary-button></a>
                @endif
            </div>
        </div>
        <div data-hs-carousel='{
            "loadingClasses": "opacity-0",
            "dotsItemClasses": "hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500",
            "slidesQty": {
              "xs": 1,
              "lg": 3
            }
          }'
            class="relative">
            <div class="hs-carousel w-full overflow-hidden bg-white rounded-lg">
                <div class="relative min-h-72 -mx-1">
                    <!-- transition-transform duration-700 -->
                    <div
                        class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap opacity-0 transition-transform duration-700">
                        @foreach ($tracks as $track)
                            <div class="hs-carousel-slide px-1">
                                <div class="flex justify-center h-full bg-gray-100 p-6 dark:bg-neutral-900">
                                    <div class="flex flex-col items-center">
                                        <img src="{{ asset('storage/' . $track->cover_file) }}" alt=""
                                            class="rounded w-32 h-32" width="128" height="128">
                                        <span
                                            class="self-center text-sm text-gray-800 transition duration-700 dark:text-white">{{ $track->name }}</span>
                                        <span
                                            class="self-center text-xs text-gray-600 transition duration-700 dark:text-gray-400">{{ $track->artist }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <button type="button"
                class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                <span class="text-2xl" aria-hidden="true">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                </span>
                <span class="sr-only">Previous</span>
            </button>
            <button type="button"
                class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                <span class="sr-only">Next</span>
                <span class="text-2xl" aria-hidden="true">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </span>
            </button>

            {{-- <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 space-x-2"></div> --}}
        </div>
    </div>
@endsection
