<?php
namespace App\ShopifyFramework\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    abstract public function rules();
}