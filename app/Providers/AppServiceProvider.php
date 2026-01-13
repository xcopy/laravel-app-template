<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blueprint::macro('blameable', function () {
            foreach (['created_by', 'updated_by', 'deleted_by'] as $column) {
                $this->integer($column, unsigned: true)->nullable();
                $this->index($column);
                $this->foreign($column, $column)
                    ->references('id')
                    ->on((new User())->getTable());
            }
        });
    }
}
