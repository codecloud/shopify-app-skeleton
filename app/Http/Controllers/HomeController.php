<?php
namespace App\Http\Controllers;

use App\ShopifyFramework\Entity\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getIndex()
    {
        return view('home.index', [
            'installUrl' => '/oauth/install-app'
        ]);
    }

    public function getLoginUser(Request $request)
    {
        \Auth::login(User::get($request->get('id')), true);

        return redirect('/entry');
    }
}