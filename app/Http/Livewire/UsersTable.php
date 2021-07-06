<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            // Column::make('Verified', 'email_verified_at')
            //     ->sortable(),
            Column::make('Admin', 'is_admin')
                ->sortable(),
            Column::blank(),
            Column::blank(),
        ];
    }

    public function query(): Builder
    {
        return User::query();
    }

    public function rowView(): string
    {
        return 'livewire.users-table';
    }

    public function demoteUser(int $id)
    {
        $user = User::where('id', $id);
        $user->is_admin = false;
        $user->save();
        $this->refresh = true;
    }

    public function deleteUser(int $id)
    {
        $user = User::where('id', $id);
        $user->delete();
        $this->refresh = true;
    }
}
