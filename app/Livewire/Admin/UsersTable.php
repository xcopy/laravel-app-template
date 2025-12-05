<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    /**
     * {@inheritDoc}
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $fieldAttributes = [
            'default' => true,
            'class' => 'px-4 py-2'
        ];

        $this->setSearchFieldAttributes($fieldAttributes);
        $this->setPerPageFieldAttributes($fieldAttributes);
    }

    /**
     * {@inheritDoc}
     */
    public function builder(): Builder
    {
        return parent::builder()
            ->orderBy($this->getPrimaryKey(), 'desc');
    }

    /**
     * {@inheritDoc}
     */
    public function columns(): array
    {
        $dateOutputFormat = 'd M Y, H:i';

        $columns = [
            Column::make('ID', 'id'),
            Column::make(__('Name'))->searchable(),
            Column::make(__('Username'))->searchable(),
            Column::make(__('Email'))->searchable(),
            BooleanColumn::make(__('Active')),
            DateColumn::make(__('Created At'), 'created_at')->outputFormat($dateOutputFormat),
            DateColumn::make(__('Updated At'), 'updated_at')->outputFormat($dateOutputFormat),
        ];

        return array_map(fn ($column) => $column->sortable(), $columns);
    }
}
