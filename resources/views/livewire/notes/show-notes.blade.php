<?php

use Livewire\Volt\Component;

new class extends Component {
    public function delete($noteId)
    {
        $note = Auth::user()->notes()->findOrFail($noteId);

        $this->authorize('delete', $note);

        $note->delete();

        Session::flash('success', 'Note deleted successfully.');

        redirect(route('notes.index'));
    }

    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date')->get(),
        ];
    }
}; ?>

<div>
    @if ($notes->isEmpty())
        <div class="text-center">
            <p class="text-xl font-bold">No notes yet</p>
            <p class="text-sm">Let's create your first note to send.</p>
            <x-button primary right-icon="plus" class="mt-3" href="{{ route('notes.create') }}" wire:navigate>Create
                note</x-button>
        </div>
    @else
        <x-button primary right-icon="plus" class="mt-3" href="{{ route('notes.create') }}" wire:navigate>Create
            note</x-button>
        <ul class="grid grid-cols-3 gap-4 mt-6">
            @foreach ($notes as $note)
                <x-card wire:key='{{ $note->id }}'>
                    <div class="flex justify-between">
                        <a href="#" class="text-xl font-bold hover:underline hover:text-blue-500">
                            {{ $note->title }}
                        </a>
                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($note->send_date)->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs">
                            {{ Str::limit($note->body, 100) }}
                        </p>
                    </div>
                    <div class="flex items-end justify-between mt-4 space-x-1">
                        <p class="text-xs">Recipient: <span class="font-semibold">{{ $note->recipient }}</span></p>
                        <div>
                            <x-button.circle icon="eye" href="{{ route('notes.edit', $note) }}" wire:navigate />
                            <x-button.circle icon="trash" wire:click="delete('{{ $note->id }}')" />
                        </div>
                    </div>
                </x-card>
            @endforeach
        </ul>
    @endif
</div>
