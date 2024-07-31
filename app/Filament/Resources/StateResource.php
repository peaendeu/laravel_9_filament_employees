<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StateResource\Pages;
use App\Filament\Resources\StateResource\RelationManagers;
use App\Models\State;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StateResource extends Resource
{
  protected static ?string $model = State::class;
  protected static ?string $navigationIcon = 'heroicon-o-office-building';
  protected static ?string $navigationGroup = 'System Management';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Card::make()->schema([
          Forms\Components\Select::make('country_id')->required()->relationship('country', 'name'),
          Forms\Components\TextInput::make('name')->required()->maxLength(100),
        ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
        Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
        Tables\Columns\TextColumn::make('country.name')->sortable()->searchable(),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\DeleteBulkAction::make(),
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
      'index' => Pages\ListStates::route('/'),
      'create' => Pages\CreateState::route('/create'),
      'edit' => Pages\EditState::route('/{record}/edit'),
    ];
  }
}
