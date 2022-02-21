<?php


namespace App\Repositories;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contract\ITeam',
            'App\Repositories\TeamRepository');

        $this->app->bind(
            'App\Repositories\Contract\IWeek',
            'App\Repositories\WeekRepository');
    }
}
