<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Contracts\View\View;

class PendingEventsTable  extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;




    public function table(Table $table): Table
    {
        return $table
            ->query(
                Event::query()
                    ->where('status', 'pending')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->weight(FontWeight::Bold)
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->sortable(query: function ($query, $direction) {
                        $query->orderBy('date', $direction);
                    })
                    ->date('F j, Y'),
            ])
            ->emptyStateHeading('No pending events found')
            ->filters([
                // ...
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->action(fn (Event $record) => $record->approve())
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                // ...
            ]);
    }


    public function render()
    {
        return view('livewire.pending-events-table');
    }
}
