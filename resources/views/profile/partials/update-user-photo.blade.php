<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Изменить фото профиля') }}
        </h2>
    </header>

    <form method="post" action="{{ route('profile.update-photo') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="profile_photo" :value="__('Выберите фото')" />
            <input id="profile_photo" name="avatar_change" type="file" class="mt-1 block w-full" required />
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'profile-photo-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Фото профиля обновлено') }}</p>
            @endif
        </div>
    </form>
</section>
