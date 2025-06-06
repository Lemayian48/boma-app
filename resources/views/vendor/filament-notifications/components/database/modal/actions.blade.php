@props([
    'notifications',
    'unreadNotificationsCount',
])

<div {{ $attributes->class('mt-2 flex gap-x-3') }}>
    @if ($unreadNotificationsCount)
        <x-filament::link
            color="primary"
            tag="button"
            wire:click="markAllNotificationsAsRead"
        >
            {{ __('filament-notifications::database.modal.actions.mark_all_as_read.label') }}
        </x-filament::link>
    @endif

    <x-filament::link
        color="danger"
        tag="button"
        wire:click="clearNotifications"
        x-on:click="close();document.documentElement.classList.add('flow-auto')"
    >
        {{ __('filament-notifications::database.modal.actions.clear.label') }}
    </x-filament::link>
</div>
