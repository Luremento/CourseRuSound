@extends('layouts.app')
@section('title')
    ruSound - Статистика
@endsection

@section('content')
    <div class="card border rounded-xl mb-4">
        <h2 class="px-5 pt-3 font-bold">Пользователи</h2>
        <div class="grid grid-cols-1 gap-8 p-5 lg:grid-cols-2 xl:grid-cols-4">
            @component('components.stats-block', [
                'name' => 'Всего',
                'number' => count($all_users),
                'percent' => 'None',
            ])
                @slot('svg')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-12 h-12 text-gray-300">
                        <path
                            d="M20 18L14 18M11 21H4C4 17.134 7.13401 14 11 14C11.695 14 12.3663 14.1013 13 14.2899M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z"
                            stroke="#d1d5db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                @endslot
            @endcomponent

            @component('components.stats-block', [
                'name' => 'За последний месяц',
                'number' => $users_lastMonth,
                'percent' => $percentage_change,
            ])
                @slot('svg')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-12 h-12 text-gray-300">
                        <path
                            d="M20 18L14 18M11 21H4C4 17.134 7.13401 14 11 14C11.695 14 12.3663 14.1013 13 14.2899M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z"
                            stroke="#d1d5db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
