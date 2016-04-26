<?php
namespace App\ShopifyFramework\Http\Request;

class FinaliseUserDetails extends Request
{
    public function rules()
    {
        return [
            'owner_name' => 'required',
            'email_address' => 'required|email',
            'shop_url' => 'required'
        ];
    }
}