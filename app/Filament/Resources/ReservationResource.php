<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use UpdatePriceService;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\DateTimePicker::make('startDate')
                ->required()
                ->minDate(now())
                ->reactive()
                ->afterStateUpdated(function ($set, $get) {
                    UpdatePriceService::handle($set, $get);
                }),
            Forms\Components\DateTimePicker::make('endDate')
                ->required()
                ->minDate(fn (callable $get) => \Carbon\Carbon::parse($get('startDate'))->addDay())
                ->afterStateUpdated(function ($set, $get) {
                    UpdatePriceService::handle($set, $get);
                }),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required(),
            Forms\Components\Select::make('room_id')
                ->relationship('room', 'name')
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, $set, $get) {
                    UpdatePriceService::handle($set, $get);
                }),
            Forms\Components\TextInput::make('name')
                ->required(),
            Forms\Components\TextInput::make('phone')
                ->tel()
                ->required(),
            Forms\Components\Textarea::make('note')
                ->columnSpanFull(),
            Forms\Components\TextInput::make('price')
                ->numeric()
                ->disabled()
                ->default(0)
                ->prefix('$'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('startDate')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('endDate')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('room.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservations::route('/reservation'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
