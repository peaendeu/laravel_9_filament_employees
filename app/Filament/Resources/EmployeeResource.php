<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
  protected static ?string $model = Employee::class;

  protected static ?string $navigationIcon = 'heroicon-o-collection';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Card::make()->schema([
          Forms\Components\Select::make('country_id')->required()->relationship('country', 'name'),
          Forms\Components\Select::make('state_id')->required()->relationship('state', 'name'),
          Forms\Components\Select::make('city_id')->required()->relationship('city', 'name'),
          Forms\Components\Select::make('department_id')->required()->relationship('department', 'name'),
          Forms\Components\TextInput::make('first_name')->required(),
          Forms\Components\TextInput::make('last_name')->required(),
          Forms\Components\TextInput::make('address')->required(),
          Forms\Components\TextInput::make('zip_code')->required(),
          Forms\Components\DatePicker::make('birth_date')->required(),
          Forms\Components\DatePicker::make('date_hired')->required(),
        ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
        Tables\Columns\TextColumn::make('first_name')->sortable()->searchable(),
        Tables\Columns\TextColumn::make('last_name')->sortable()->searchable(),
        Tables\Columns\TextColumn::make('department.name')->sortable()->searchable(),
        Tables\Columns\TextColumn::make('date_hired')->sortable()->searchable(),
      ])
      ->filters([
        Tables\Filters\SelectFilter::make('department')->relationship('department', 'name')
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
      'index' => Pages\ListEmployees::route('/'),
      'create' => Pages\CreateEmployee::route('/create'),
      'edit' => Pages\EditEmployee::route('/{record}/edit'),
    ];
  }
}
