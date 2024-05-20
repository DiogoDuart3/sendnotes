<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public Note $note;

    protected $listeners = ['echo:my-name,NoteGivenHeart' => 'handleNoteChange'];

    public function mount(Note $note)
    {
        $this->note = $note;
    }

    public function heart()
    {
        $this->note->increment('heart_count');
        event(new \App\Events\NoteGivenHeart($this->note));
    }

    public function handleNoteChange($data)
    {
        $this->note->heart_count = $data['note']['heart_count'];
    }
}; ?>

<div>
    <x-button xs wire:click='heart' rose icon="heart" spinner="heart">{{ $note->heart_count }}</x-button>
    <div x-data="{ open: false }" @mouseleave="open = false">
        <button @mouseenter="open = true">Show More...</button>
        <ul x-show="open">
            <li><button wire:click="archive">Archive</button></li>
            <li><button wire:click="delete">Delete</button></li>
        </ul>
    </div>
</div>
