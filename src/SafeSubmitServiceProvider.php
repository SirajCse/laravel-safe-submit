<?php

namespace SirajCSE\LaravelSafeSubmit;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SafeSubmitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Blade::directive('safesubmit', function ($expression) {
            return "<?php echo '<input type=\"hidden\" name=\"' . app(SafeSubmit::class)->tokenKey() . '\" value=\"' . app(SafeSubmit::class)->token() . '\">'; ?>";
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(SafeSubmit::class, function () {
            return new SafeSubmit();
        });
    }
}
