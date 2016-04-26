<?php

namespace App\Providers;

use CodeCloud\ShopifyApiClient\Client;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require_once app_path('ShopifyFramework/Support/helpers.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function($app, $params) {
            $client = new Client(new \GuzzleHttp\Client());
            $client->setAuthKey($params['access_token']);
            $client->setShopUrl($params['shop_url']);
            return $client;
        });

        \Blade::directive('dateFormat', function($expression) {
            return '<?php echo date("jS F Y", strtotime(' . $expression . ')) ?>';
        });

        \Blade::directive('timeFormat', function($expression) {
            return '<?php echo date("H:i", strtotime(' . $expression . ')) ?>';
        });
    }
}
