<?php

namespace App\Livewire;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class EventActionButtons extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $event;

    public function mount($event)
    {
        $this->event = $event;
    }

    public function downloadAction():Action
    {
        return Action::make('download_ticket')
            ->label('Download Ticket')
            ->requiresConfirmation()
            ->visible(fn() => auth()->user()->isReserved($this->event))
            ->icon('heroicon-o-ticket');
    }

    public function giveFeedbackAction():Action
    {
        return Action::make('give_feedback')
            ->label('Give Feedback')
            ->icon('heroicon-o-chat-bubble-bottom-center-text')
            ->visible(fn() => auth()->user()->hasAttended($this->event));
    }

    public function reserveAction():Action
    {
        return Action::make('reserve')
            ->label('Reserve')
            ->icon('heroicon-o-calendar');
            
    }


    public function render()
    {
        return view('livewire.event-action-buttons');
    }
}
