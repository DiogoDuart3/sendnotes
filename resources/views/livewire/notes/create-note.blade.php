<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5', 'max:255'],
            'noteBody' => ['required', 'string', 'max:255'],
            'noteRecipient' => ['required', 'string', 'email', 'max:255'],
            'noteSendDate' => ['required', 'date'],
        ]);

        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $validated['noteTitle'],
                'body' => $validated['noteBody'],
                'recipient' => $validated['noteRecipient'],
                'send_date' => $validated['noteSendDate'],
                'is_published' => true
            ]);

        redirect(route('notes.index'));
    }
}; ?>

<div>
    <div>
        <x-button icon="arrow-left" href="{{ route('notes.index') }}">All notes</x-button>
    </div>
    <form wire:submit='submit' class="mt-6 space-y-4">
        <x-input wire:model="noteTitle" label="Note Title" placeholder="It's been a great day." />
        <x-textarea wire:model="noteBody" label="Your Note" placeholder="Share all your toughts with your friend." />
        <x-input wire:model="noteRecipient" label="Recipient" type="email" placeholder="email@example.com" />
        <x-input wire:model="noteSendDate" label="Send Date" type="date" />
        <div class="pt-4">
            <x-button wire:click="submit" primary right-icon="calendar" spinner>Submit</x-button>
        </div>
        <x-errors />
    </form>
</div>
