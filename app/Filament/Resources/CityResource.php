<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Filament\Resources\CityResource\RelationManagers;
use App\Filament\Resources\CityResource\RelationManagers\EmployeesRelationManager;
use App\Models\City;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CityResource extends Resource
{
  protected static ?string $model = City::class;
  protected static ?string $navigationIcon = 'heroicon-o-office-building';
  protected static ?string $navigationGroup = 'System Management';
  // protected static ?int $navigationSort = 3;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Card::make()->schema([
          Forms\Components\Select::make('state_id')->required()->relationship('state', 'name'),
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
        Tables\Columns\TextColumn::make('state.name')->sortable()->searchable(),
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
      EmployeesRelationManager::class,
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListCities::route('/'),
      'create' => Pages\CreateCity::route('/create'),
      'edit' => Pages\EditCity::route('/{record}/edit'),
    ];
  }
}
