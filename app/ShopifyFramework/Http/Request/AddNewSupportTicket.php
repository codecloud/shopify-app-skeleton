<?php
namespace App\ShopifyFramework\Http\Request;

class AddNewSupportTicket extends Request
{
    public function rules()
    {
        return [
            'subject' => 'required',
            'message' => 'required'
        ];
    }
}