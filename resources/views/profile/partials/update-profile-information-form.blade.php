<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4 space-y-6">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        
        <div>
            <div class="flex items-center space-x-2">
            <x-input-label for="nickname" :value="__('Nickname')" />
            <p class="text-sm text-gray-500">　（公開されます。）</p>
        </div>
            <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" :value="old('nickname', $user->nickname)" />
            <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
        </div>
        
        <div>
            <x-input-label for="sex" :value="__('Sex')" />
            <select id="sex" name="sex" class="mt-1 block w-full rounded-lg">
                <option value=""></option>
                <option value="male" {{ old('sex', $user->sex) === 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>	
                <option value="female" {{ old('sex', $user->sex) === 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>	
                <option value="other" {{ old('sex', $user->sex) === 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>	
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('sex')" />
        </div>
    
        <div>
            <div class="flex items-center space-x-2">
            <x-input-label for="bio" :value="__('Bio')" />
            <p class="text-sm text-gray-500 ">　(公開されます。1000文字以内）</p>
            </div>
            <textarea id="bio" name="bio" class="mt-1 block w-full rounded-lg" rows="3">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
