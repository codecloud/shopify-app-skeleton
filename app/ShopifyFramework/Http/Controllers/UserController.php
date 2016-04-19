<?php
namespace App\ShopifyFramework\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Core\FinaliseUserDetails;

class UserController extends Controller
{
    public function getFinalise()
    {
        return view('core.user.finalise', [
            'shopUrl'    => $this->user()->getShopUrl(),
            'formAction' => url()
        ]);
    }

    public function postFinalise(FinaliseUserDetails $request)
    {
        $this->user()->fill($request->all())->save();
        $this->flashOk('You have completed the installation process');
        return redirect('/');
    }
}