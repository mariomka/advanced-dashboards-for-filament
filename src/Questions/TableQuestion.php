<?php

namespace Mariomka\AdvancedDashboardsForFilament\Questions;

use Filament\Actions;
use Filament\Forms;
use Filament\Infolists;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

class TableQuestion extends Question implements Actions\Contracts\HasActions, Forms\Contracts\HasForms, Infolists\Contracts\HasInfolists, Tables\Contracts\HasTable
{
    use Actions\Concerns\InteractsWithActions;
    use Forms\Concerns\InteractsWithForms;
    use Infolists\Concerns\InteractsWithInfolists;
    use Tables\Concerns\InteractsWithTable {
        makeTable as makeBaseTable;
    }

    /**
     * @var view-string
     */
    protected static string $view = 'advanced-dashboards-for-filament::questions.table-question';

    protected function paginateTableQuery(Builder $query): Paginator | CursorPaginator
    {
        return $query->simplePaginate(($this->getTableRecordsPerPage() === 'all') ? $query->count() : $this->getTableRecordsPerPage());
    }

    protected function makeTable(): Table
    {
        return $this->makeBaseTable()
            ->heading(
                $this->getHeading() ?? (string) str(class_basename(static::class))
                    ->beforeLast('Question')
                    ->kebab()
                    ->replace('-', ' ')
                    ->title(),
            );
    }
}
