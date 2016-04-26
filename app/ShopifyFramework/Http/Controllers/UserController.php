<?php
namespace App\ShopifyFramework\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ShopifyFramework\Http\Request\FinaliseUserDetails;
use App\ShopifyFramework\Http\Request\UpdateUserSettings;

class UserController extends Controller
{
    public function getFinalise()
    {
        $shop = $this->api()->shop()->get([
            'fields' => 'shop_owner,email'
        ]);

        return view('framework.user.finalise', [
            'shopUrl'    => $this->user()->shop_url,
            'ownerName' => $shop->shop_owner,
            'emailAddress' => $shop->email
        ]);
    }

    public function postFinalise(FinaliseUserDetails $request)
    {
        $this->user()->fill($request->all())->save();
        $this->flashOk('Excellent - you have completed the installation process!');
        return redirect('/entry');
    }

    public function getPurchasesAndPayments()
    {
        return view('framework.user.purchases-and-payments', [
            'purchases' => []
        ]);
    }

    public function getSettings()
    {
        return view('framework.user.settings', camel_case_array_keys($this->user()->toArray()));
    }

    public function postSettings(UpdateUserSettings $request)
    {
        $this->user()->fill($request->only(['owner_name', 'email_address']))->save();
        $this->flashOk('Your account settings were updated');
        return redirect()->back();
    }
}