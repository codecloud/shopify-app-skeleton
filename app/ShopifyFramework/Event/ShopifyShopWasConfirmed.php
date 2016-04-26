<?php
namespace App\ShopifyFramework\Event;

class ShopifyShopWasConfirmed
{
    /**
     * @var \stdClass
     */
    public $shopifyConfirmation;

    /**
     * @var string
     */
    public $shopUrl;

    /**
     * @param \stdClass $shopifyConfirmation
     * @param string $shopUrl
     */
    public function __construct(\stdClass $shopifyConfirmation, $shopUrl)
    {
        $this->shopifyConfirmation = $shopifyConfirmation;
        $this->shopUrl = $shopUrl;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->shopifyConfirmation->access_token;
    }

    /**
     * @return string
     */
    public function getShopUrl()
    {
        return $this->shopUrl;
    }
}