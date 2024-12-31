<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
// use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Sebastienheyd\Boilerplate\Models\User;

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

        Gate::define('update', function (User $user, $modeldate, $permission) {
            $setting = Setting::where('name', 'update_within')->first();
            $updatehour = (int) $setting->value;

            $modifydate = Carbon::parse($modeldate)->addHours($updatehour);

            $currentdate = Carbon::now();

            if ($user->ability(['admin'], [$permission]) || $modifydate->greaterThanOrEqualTo($currentdate)) {
                return Response::allow();
            } else {
                return Response::deny('You need update permission to update this data or it is higher than the within update hours');

            }
        });

        Gate::define('delete', function (User $user, $modeldate, $permission) {
            $setting = Setting::where('name', 'update_within')->first();
            $updatehour = (int) $setting->value;

            $modifydate = Carbon::parse($modeldate)->addHours($updatehour);

            $currentdate = Carbon::now();

            if ($user->ability(['admin'], [$permission]) || $modifydate->greaterThanOrEqualTo($currentdate)) {
                return Response::allow();
            } else {
                return Response::deny('You need delete permission to delete this data or it is higher than the within delete hours');

            }
        });
    }
}
