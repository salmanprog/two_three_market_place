<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\AdminNotification;
use Modules\Customer\Entities\Chat;
use Laravel\Scout\Console\ImportCommand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(TranslationServiceProvider::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // if (!$this->app->runningInConsole()) {
        //     $this->commands([
        //         ImportCommand::class,
        //     ]);
        // }
        if (!Collection::hasMacro('paginate')) {
            Collection::macro('paginate',
                function ($perPage = 15, $page = null, $options = []) {
                $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                return (new LengthAwarePaginator(
                    $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                    ->withPath('');
            });
        }

        if (config('app.force_https')) {
            URL::forceScheme('https');
        }


        Schema::defaultStringLength(191);


        Validator::extend('check_unique_phone', function($attribute, $value, $parameters, $validator) {
            if (is_numeric($value)) {
              $data=User::where('phone',$value)->first();
              if($data){
                return false;
               }
                return true;
            }
            return true;

        });

        Paginator::useBootstrap();

        View::composer('backEnd.partials._menu', function ($view) {
            if (! auth()->check()) {
                $view->with('chatUnreadCount', 0);
                $view->with('adminNotificationUnreadCount', 0);

                return;
            }
            if (! Schema::hasColumn('chat', 'is_read')) {
                $view->with('chatUnreadCount', 0);
            } else {
                $view->with('chatUnreadCount', Chat::unreadCountForUser((int) auth()->id()));
            }

            $roleType = auth()->user()->role->type ?? null;
            if (in_array($roleType, ['superadmin', 'admin', 'staff'], true)) {
                $view->with('adminNotificationUnreadCount', AdminNotification::unreadCountForAdminPanel());
            } else {
                $view->with('adminNotificationUnreadCount', 0);
            }
        });
    }
}
