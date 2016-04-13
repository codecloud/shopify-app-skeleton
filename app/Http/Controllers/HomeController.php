<?php
namespace App\Controllers;

class HomeController extends Controller
{
    public function getIndex()
    {
        return view('home.index', [
            'installUrl' => \Config::get('shopify-api-client.urls.install')
        ]);
    }
}