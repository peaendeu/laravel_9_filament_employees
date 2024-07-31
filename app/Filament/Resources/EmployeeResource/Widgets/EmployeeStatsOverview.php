<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use App\Models\Country;
use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class EmployeeStatsOverview extends BaseWidget
{
  protected function getCards(): array
  {
    $idn = Country::where('country_code', 'IDN')->withCount('employees')->first();
    $jpn = Country::where('country_code', 'JPN')->withCount('employees')->first();
    return [
      Card::make('All Employees', Employee::all()->count()),
      Card::make($idn->name, $idn->employees_count),
      Card::make($jpn->name, $jpn->employees_count),
    ];
  }
}
