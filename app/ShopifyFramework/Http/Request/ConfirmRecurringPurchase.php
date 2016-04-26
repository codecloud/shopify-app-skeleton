<?php
namespace App\ShopifyFramework\Http\Request;

class ConfirmRecurringPurchase extends Request
{
    public function rules()
    {
        return [
            'charge_id' => 'required|numeric',
        ];
    }
}