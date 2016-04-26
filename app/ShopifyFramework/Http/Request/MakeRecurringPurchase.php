<?php
namespace App\ShopifyFramework\Http\Request;

class MakeRecurringPurchase extends Request
{
    public function rules()
    {
        return [
            'recurring_product_id' => 'required|integer'
        ];
    }
}