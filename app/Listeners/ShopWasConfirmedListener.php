<?php
namespace App\Listeners;

use CodeCloud\ShopifyApiClient\Event\ShopifyStoreWasConfirmed;
use CodeCloud\ShopifyFramework\Entity\User;
use Illuminate\Queue\Listener;

class ShopWasConfirmedListener extends Listener
{
    /**
     * @param ShopifyStoreWasConfirmed $event
     */
    public function handle(ShopifyStoreWasConfirmed $event)
    {
        $user = User::create([
            'shop_url'     => $event->getShopUrl(),
            'access_token' => $event->getAccessToken()
        ]);

        \Auth::login($user);
    }
}