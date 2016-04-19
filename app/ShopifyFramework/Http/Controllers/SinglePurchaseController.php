<?php
namespace App\ShopifyFramework\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ShopifyFramework\Entity\SingleProduct;
use App\ShopifyFramework\Http\Request\ConfirmSinglePurchase;
use App\ShopifyFramework\Http\Request\MakeSinglePurchase;

class SinglePurchaseController extends Controller
{
    public function postMake(MakeSinglePurchase $request)
    {
        $product = SingleProduct::get($request->get('product_id'));

        $process = new \App\ShopifyFramework\Process\MakeSinglePurchase($this->api()->applicationCharge());

        $redirectUrl = url('single-purchase/confirm');

        $confirmationUrl = $process->getChargeUrl($product, $redirectUrl);

        return redirect($confirmationUrl);
    }

    public function getConfirm(ConfirmSinglePurchase $request)
    {
        $process = new \App\ShopifyFramework\Process\MakeSinglePurchase($this->api()->applicationCharge());
        $process->activateCharge($request->get('charge_id'));

        return redirect(url('user/finalise'));
    }
}