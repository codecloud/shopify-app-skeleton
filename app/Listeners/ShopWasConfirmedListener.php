<?php
namespace App\Listeners;

use App\ShopifyFramework\Entity\User;
use App\ShopifyFramework\Event\ShopifyShopWasConfirmed;

class ShopWasConfirmedListener
{
    /**
     * @param ShopifyShopWasConfirmed $event
     */
    public function handle(ShopifyShopWasConfirmed $event)
    {
        $user = new User([
            'shop_url' => $event->getShopUrl(),
            'last_logged_in_at' => date('Y-m-d H:i:s')
        ]);

        $user->access_token = $event->getAccessToken();
        $user->save();

        \Auth::login($user);
    }
}