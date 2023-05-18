<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\ContactForm;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class EmailsWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('emails', '1'),
        ];
    }
}
