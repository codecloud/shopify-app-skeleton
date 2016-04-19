<?php
namespace App\Http\Requests\Core;

use App\Http\Requests\Request;

class FinaliseUserDetails extends Request
{
    public function rules()
    {
        return [
            'name' => 'required',
            'email_address' => 'required|email',
            'shop_url' => 'required'
        ];
    }
}