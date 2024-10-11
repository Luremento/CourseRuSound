@extends('layouts.app')
@section('title')
    ruSound - {{ $user->name }}
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl w-screen mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-3xl"> <!-- Увеличиваем ширину -->
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-3xl"> <!-- Увеличиваем ширину -->
                    @include('profile.partials.update-user-photo')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-3xl"> <!-- Увеличиваем ширину -->
                    @include('profile.partials.update-password-form')
                </div>
            </div>

        </div>
    </div>
@endsection
