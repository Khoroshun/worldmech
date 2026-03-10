<?php

namespace App\Providers;

use App\Models\User;
use Coroowicaksono\ChartJsIntegration\StackedChart;
use Illuminate\Support\Facades\Gate;
use Laravel\Fortify\Features;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        Nova::style('custom-nova', resource_path('css/nova.css'));
        Nova::script('chartjs', public_path('js/chart.js'));
        Nova::script('dataset-chart', resource_path('js/nova-dataset-chart.js'));
    }

    public function cards(): array
    {
        return [
            (new StackedChart())
                ->title('Revenue')
                ->series(array([
                    'barPercentage' => 0.5,
                    'label' => 'Product #1',
                    'backgroundColor' => '#ffcc5c',
                    'data' => [30, 70, 80],
                ],[
                    'barPercentage' => 0.5,
                    'label' => 'Product #2',
                    'backgroundColor' => '#ff6f69',
                    'data' => [40, 62, 79],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => [ 'Jan', 'Feb', 'Mar' ]
                    ],
                ])
                ->width('1/3'),

        ];
    }
    protected function resources(): void
    {
        Nova::resources([
            \App\Nova\Material::class,
            \App\Nova\Constant::class,
            \App\Nova\Dataset::class,
            \App\Nova\DataPoint::class,
        ]);
    }

    /**
     * Register the configurations for Laravel Fortify.
     */
    protected function fortify(): void
    {
        Nova::fortify()
            ->features([
                Features::updatePasswords(),
                // Features::emailVerification(),
                // Features::twoFactorAuthentication(['confirm' => true, 'confirmPassword' => true]),
            ])
            ->register();
    }

    /**
     * Register the Nova routes.
     */
    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes(default: true)
            ->withPasswordResetRoutes()
            ->withoutEmailVerificationRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function (User $user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Dashboard>
     */
    protected function dashboards(): array
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Tool>
     */
    public function tools(): array
    {
        return [
        ];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();

        //
    }
}
