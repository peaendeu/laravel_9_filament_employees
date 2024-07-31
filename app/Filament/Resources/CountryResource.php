<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Filament\Resources\CountryResource\RelationManagers\EmployeesRelationManager;
use App\Filament\Resources\CountryResource\RelationManagers\StatesRelationManager;
use App\Models\Country;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountryResource extends Resource
{
  protected static ?string $model = Country::class;
  protected static ?string $navigationIcon = 'heroicon-o-flag';
  protected static ?string $navigationGroup = 'System Management';

  public static function form(Form $form): Form
  {
    return $form->schema([
      Forms\Components\Card::make()->schema([
        Forms\Components\TextInput::make('country_code')->required()->maxLength(3),
        Forms\Components\TextInput::make('name')->required()->maxLength(50),
      ])
    ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
        Tables\Columns\TextColumn::make('country_code')->sortable()->searchable(),
        Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
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
      StatesRelationManager::class,
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListCountries::route('/'),
      'create' => Pages\CreateCountry::route('/create'),
      'edit' => Pages\EditCountry::route('/{record}/edit'),
    ];
  }
}
