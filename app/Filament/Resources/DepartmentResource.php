<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Filament\Resources\DepartmentResource\RelationManagers\EmployeesRelationManager;
use App\Models\Department;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentResource extends Resource
{
  protected static ?string $model = Department::class;
  protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
  protected static ?string $navigationGroup = 'System Management';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Card::make()->schema([
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
      'index' => Pages\ListDepartments::route('/'),
      'create' => Pages\CreateDepartment::route('/create'),
      'edit' => Pages\EditDepartment::route('/{record}/edit'),
    ];
  }
}
