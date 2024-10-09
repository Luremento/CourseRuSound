<header class="bg-white">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex gap-x-12 text-nowrap">
            <a href={{ route('index') }} class="text-sm font-semibold leading-6 text-gray-900">Главная</a>
            <a href={{ route('track.upload') }} class="text-sm font-semibold leading-6 text-gray-900">Загрузить трек</a>
            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Альбомы</a>
        </div>
        <div class="flex flex-1 justify-end max-sm:hidden">
            @guest
                <a href={{ route('login') }} class="text-sm font-semibold leading-6 text-gray-900">Вход<span
                        aria-hidden="true">&rarr;</span></a>
            @else
                <a href={{ route('profile') }} class="text-sm font-semibold leading-6 text-gray-900">Профиль</a>

            @endguest
        </div>
    </nav>
</header>
