<?php

namespace App\Livewire\Org;

use App\Models\EventRegistration;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Component;

class AttendanceTable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public function table(Table $table): Table
    {
        return $table
            ->query(EventRegistration::query())
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),
                TextColumn::make('event.name')
                    ->label('Event')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'attended' => 'success',
                        'registered' => 'warning',
                        default => 'gray',
                    })
            ])
            ->filters([
                // with attended status
                SelectFilter::make('status')
                    ->options([
                        'attended' => 'Attended',
                        'registered' => 'Registered',
                    ])
            ])
            ->persistFiltersInSession()
            ->actions([
                ViewAction::make()
                    ->form([
                        TextInput::make('user.name')
                            ->label('User'),
                        TextInput::make('event.name')
                            ->label('Event'),
                        TextInput::make('status')
                            ->label('Status')
                            
                    ]),
                DeleteAction::make(),
            ]);
    }

    public function render()
    {
        return view('livewire.org.attendance-table');
    }
}
