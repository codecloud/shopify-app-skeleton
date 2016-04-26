<?php
namespace App\ShopifyFramework\Http\Controllers;

use App\Http\Controllers\Controller;

class EntryController extends Controller
{
    public function getIndex()
    {
        if ($user = $this->user()) {
            if ($user->owner_name && $user->email_address) {
                //has the user got an active purchase/subscription?
                if (! $user->hasActivePurchase()) {
                    return redirect('/recurring-purchase/options');
                }

                return redirect('/dashboard');

            } else {
                return redirect('/user/finalise');
            }
        } else {
            return redirect('/');
        }
    }
}