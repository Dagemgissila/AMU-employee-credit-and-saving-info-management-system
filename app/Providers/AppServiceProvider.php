<?php

namespace App\Providers;
use DB;
use Carbon\Carbon;
use App\Models\CreditPayment;
use App\Models\RequestCredit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
    public function boot()
    {
        View::composer('*', function ($view) {
            $RequestCredits = RequestCredit::all();
            $view->with('RequestCredits', $RequestCredits);
        });

        View::composer("*", function($view) {
            $missedPaymentCount = CreditPayment::where('status', 0)
                ->where('paid_month', '<=', Carbon::now()->toDateString())
                ->count();

            $view->with("missedPaymentCount", $missedPaymentCount);
        });



            View::composer("*", function($view) {
                if(Auth::check()){
                $notificationCount = DB::table('notifications')
                    ->where('notifiable_id', auth()->user()->id)
                    ->whereNull('read_at')
                    ->count();


                $view->with("notificationCount", $notificationCount);
                }
            });


    }
}
