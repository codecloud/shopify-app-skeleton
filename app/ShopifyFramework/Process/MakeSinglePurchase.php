<?php
namespace App\ShopifyFramework\Process;

use App\Traits\CanPerformDbTransactions;
use Codecloud\ShopifyApiClient\Endpoint\ApplicationCharge;
use App\ShopifyFramework\Entity\SingleCharge;
use App\ShopifyFramework\Entity\SingleProduct;
use App\ShopifyFramework\Entity\SinglePurchase;
use App\ShopifyFramework\Entity\User;

class MakeSinglePurchase
{
    use CanPerformDbTransactions;

    /**
     * @var ApplicationCharge
     */
    private $chargeEndpoint;

    /**
     * @param ApplicationCharge $chargeEndpoint
     */
    public function __construct(ApplicationCharge $chargeEndpoint)
    {
        $this->chargeEndpoint = $chargeEndpoint;
    }

    /**
     * @param SingleProduct $product
     * @param string $returnUrl
     */
    public function getChargeUrl(SingleProduct $product, $returnUrl)
    {
        $response = $this->chargeEndpoint->create($product->name, $product->amount, [
            'return_url' => $returnUrl
        ]);

        return $response->confirmation_url;
    }

    /**
     * @param int $chargeId
     * @param User $user
     * @param SingleProduct $product
     * @throws \Exception
     */
    public function activateCharge($chargeId, User $user, SingleProduct $product)
    {
        if (! $this->chargeEndpoint->activate($chargeId)) {
            throw new \Exception('The charge could not be activated');
        }

        $this->beginTransaction();

        SinglePurchase::create([
            'user_id' => $user->id,
            'single_product_id' => $product->id,
            'status' => 'ACTIVE',
            'last_charged_at' => date('Y-m-d')
        ]);

        SingleCharge::create([
            'user_id' => $user->id,
            'single_purchase_id' => $product->id,
            'amount' => $product->amount,
            'shopify_charge_reference' => $chargeId
        ]);

        $this->endTransaction();
    }
}