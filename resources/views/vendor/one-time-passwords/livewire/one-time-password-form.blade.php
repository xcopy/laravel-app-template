<div x-data="{resendText: '{{ __('one-time-passwords::form.resend_code') }}', isResending: false}">
    <x-auth-header :title="__('one-time-passwords::form.one_time_password_form_title')" />

    <form wire:submit="submitOneTimePassword" class="mt-6 space-y-6">
        <div>
            <flux:input
                type="text"
                id="one_time_password"
                wire:model="oneTimePassword"
                :placeholder="__('one-time-passwords::form.password_label')"
            />
            @error('oneTimePassword')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1">{{ $message }}</p>
            @enderror
        </div>

        <flux:button variant="primary" type="submit" class="w-full">
            {{ __('one-time-passwords::form.submit_login_code_button') }}
        </flux:button>

        <flux:button
            variant="ghost"
            type="button"
            class="w-full"
            x-text="resendText"
            x-on:click="
                if (!isResending) {
                    isResending = true;
                    resendText = 'Code sent';
                    $wire.resendCode();
                    setTimeout(() => {
                        resendText = '{{ __('one-time-passwords::form.resend_code') }}';
                        isResending = false;
                    }, 2000);
                }
            "
        />
    </form>
</div>
