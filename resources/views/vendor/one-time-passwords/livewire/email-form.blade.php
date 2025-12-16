<div>
    <x-auth-header :title="__('one-time-passwords::form.email_form_title')" />

    <form wire:submit="submitEmail" class="mt-6 space-y-6">
        <div>
            <flux:input
                id="email"
                name="email"
                type="email"
                required
                autofocus
                wire:model="email"
                :placeholder="__('one-time-passwords::form.email_label')"
            />
            @error('email')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1">{{ $message }}</p>
            @enderror
        </div>

        <flux:button variant="primary" type="submit" class="w-full">
            {{ __('one-time-passwords::form.send_login_code_button') }}
        </flux:button>
    </form>
</div>
