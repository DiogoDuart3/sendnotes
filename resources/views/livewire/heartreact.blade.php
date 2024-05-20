<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public Note $note;
    public $heartCount;

    protected $listeners = ['echo:my-name,NoteGivenHeart' => 'notifyNewOrder'];

    public function mount(Note $note)
    {
        $this->note = $note;
    }

    public function heart(): void
    {
        $this->note->increment('heart_count');
        event(new \App\Events\NoteGivenHeart($this->note));
    }

    public function handleNoteChange(Note $note): void
    {
        $this->note = $note->heart_count;
    }
}; ?>

<div>
    <x-button xs wire:click='heart' rose icon="heart" spinner="heart">{{ $note->heart_count }}</x-button>
</div>
