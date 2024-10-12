@extends('layouts.app')
@section('title')
    ruSound - Статистика
@endsection

@section('content')
    <div class="card border rounded-xl mb-4">
        <h2 class="px-5 pt-3 font-bold">Пользователи</h2>
        <div class="grid grid-cols-1 gap-8 p-5  lg:grid-cols-2 xl:grid-cols-4">
            @component('components.stats-block', [
                'name' => 'Пользователи',
                'number' => '30000',
                'percent' => '+3,4',
                'svg' => '',
            ])
            @endcomponent
        </div>
    </div>
@endsection
