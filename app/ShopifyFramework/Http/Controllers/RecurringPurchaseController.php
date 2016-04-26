<?php
namespace App\ShopifyFramework\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ShopifyFramework\Entity\RecurringProduct;
use App\ShopifyFramework\Entity\RecurringPurchase;
use App\ShopifyFramework\Entity\SingleProduct;
use App\ShopifyFramework\Http\Request\ConfirmRecurringPurchase;
use App\ShopifyFramework\Http\Request\ConfirmSinglePurchase;
use App\ShopifyFramework\Http\Request\MakeRecurringPurchase;
use App\ShopifyFramework\Http\Request\MakeSinglePurchase;

class RecurringPurchaseController extends Controller
{
    public function getOptions()
    {
        return view('framework.recurring-purchase.options', [
            'options' => RecurringProduct::all()
        ]);
    }

    public function postMake(MakeRecurringPurchase $request)
    {
        $product = RecurringProduct::get($request->get('recurring_product_id'));

        $process = new \App\ShopifyFramework\Process\MakeRecurringPurchase($this->api()->recurringApplicationCharge());

        $redirectUrl = url('recurring-purchase/confirm');

        $confirmationUrl = $process->getChargeUrl($product, $redirectUrl);

        return redirect($confirmationUrl);
    }

    public function getConfirm(ConfirmRecurringPurchase $request)
    {
        $process = new \App\ShopifyFramework\Process\MakeRecurringPurchase($this->api()->recurringApplicationCharge());
        $process->activateCharge($request->get('charge_id'));
        return redirect('/entry');
    }
}