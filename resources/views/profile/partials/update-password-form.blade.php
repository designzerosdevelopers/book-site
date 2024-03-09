<div class="card">
    <div class="card-body">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Update Password') }}
            </h2>
        
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </header>
        @if(session('status-password-update'))
            <div class="alert alert-success" role="alert" id="updateSuccessAlert">
                {{ session('status-password-update') }}
            </div>
        @endif
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')
            <div class="form-group space-y-4">
    
            <div>
                <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control mb-4" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>
    
            <div>
                <x-input-label for="update_password_password" :value="__('New Password')" />
                <x-text-input id="update_password_password" name="password" type="password" class="mb-4 form-control"  autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>
    
            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mb-4 form-control"  autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

           
            <div class="flex items-center justify-between">
                <button type="submit" class="btn btn-gradient-success mt-2">{{ __('Save') }}</button>
    
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

