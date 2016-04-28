<?php
namespace App\ShopifyFramework\Process;

use App\ShopifyFramework\Entity\RecurringCharge;
use App\ShopifyFramework\Entity\RecurringProduct;
use App\ShopifyFramework\Entity\RecurringPurchase;
use App\Traits\CanPerformDbTransactions;
use App\ShopifyFramework\Entity\User;
use Codecloud\ShopifyApiClient\Endpoint\RecurringApplicationCharge;
use CodeCloud\ShopifyApiClient\EndpointFramework\EndpointProxy;

class MakeRecurringPurchase
{
    use CanPerformDbTransactions;

    /**
     * @var RecurringApplicationCharge
     */
    private $chargeEndpoint;

    /**
     * @param RecurringApplicationCharge|EndpointProxy $chargeEndpoint
     */
    public function __construct(EndpointProxy $chargeEndpoint)
    {
        $this->chargeEndpoint = $chargeEndpoint;
    }

    /**
     * @param RecurringProduct $product
     * @param string $returnUrl
     */
    public function getChargeUrl(RecurringProduct $product, $returnUrl)
    {
        $response = $this->chargeEndpoint->create($product->display_name, $product->amount, [
            'return_url' => $returnUrl,
            'test' => true
        ]);

        return $response->confirmation_url;
    }

    /**
     * @param int $chargeId
     * @param User $user
     * @param RecurringProduct $product
     * @throws \Exception
     */
    public function activateCharge($chargeId, User $user, RecurringProduct $product)
    {
        if (! $this->chargeEndpoint->activate($chargeId, [])) {
            throw new \Exception('The charge could not be activated');
        }

        $this->beginTransaction();

        $purchase = RecurringPurchase::create([
            'user_id' => $user->id,
            'recurring_product_id' => $product->id,
            'status' => 'ACTIVE',
            'shopify_recurring_charge_reference' => $chargeId,
            'last_charged_at' => date('Y-m-d'),
            'expires_at' => date('Y-m-d', strtotime($product->getFrequencyAsTimeModifierString()))
        ]);

        RecurringCharge::create([
            'user_id' => $user->id,
            'recurring_purchase_id' => $purchase->id,
            'amount' => $product->amount,
            'shopify_charge_reference' => $chargeId
        ]);

        $this->endTransaction();
    }
}