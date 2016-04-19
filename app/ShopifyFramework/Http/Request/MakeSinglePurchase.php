<?php
namespace App\ShopifyFramework\Http\Request;

class MakeSinglePurchase extends Request
{
    public function rules()
    {
        return [
            'product_id' => 'required|integer'
        ];
    }
}