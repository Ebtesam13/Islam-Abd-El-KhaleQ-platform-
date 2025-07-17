<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')


        <div class="form-group">
            <label for="update_password_current_password">{{__('labels.current_password')}}</label>
            <input class="form-control" id="update_password_current_password" name="current_password" type="password" autocomplete="current-password">
        </div>
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="update_password_password">{{__('labels.new_password')}}</label>
            <input class="form-control" id="update_password_password" name="password" type="password" autocomplete="new-password">
        </div>
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="update_password_password_confirmation">{{__('labels.password_confirmation')}}</label>
            <input class="form-control" id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
        </div>
        @error('password_confirmation')
        <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="flex items-center gap-4">
            <button class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
