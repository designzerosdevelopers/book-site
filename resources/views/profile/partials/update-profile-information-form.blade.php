<div class="card">
    <div class="card-body">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>
        @if(session('status'))
            <div class="alert alert-success" role="alert" id="updateSuccessAlert">
                {{ session('status') }}
            </div>
        @endif
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

       

        <form method="post" action="{{ route('profile.update') }}" class="mt-6">
            @csrf
            @method('patch')

            <div class="form-group space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="form-control mb-4" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="form-control mb-4" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="btn btn-gradient-primary me-2">
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
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="btn btn-gradient-success ">{{ __('Save') }}</button>

                  
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Wait for the document to be ready
    $(document).ready(function(){
        // Delay for 4 seconds (4000 milliseconds) before sliding up the alert
        setTimeout(function(){
            $("#updateSuccessAlert").slideUp();
        }, 4000);
    });
</script>