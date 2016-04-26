<?php

namespace App\Http\Controllers;

use App\ShopifyFramework\Entity\EntityModel;
use CodeCloud\ShopifyApiClient\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * @return Client
     */
    public function api()
    {
        if (! $user = $this->user()) {
            return \App::make(Client::class);
        }

        return \App::make(Client::class, ['access_token' => $user->access_token, 'shop_url' => $user->shop_url]);
    }

    /**
     * @return \App\ShopifyFramework\Entity\User
     */
    public function user()
    {
        return \Auth::user();
    }

    /**
     * @param EntityModel $model
     * @throws AccessDeniedHttpException
     */
    protected function checkUserOwns(EntityModel $model)
    {
        if (! $this->user()->id == $model->user_id) {
            throw new AccessDeniedHttpException('You are not allowed access to this resource');
        }
    }

    /**
     * @param string $message
     */
    protected function flashOk($message)
    {
        \Session::flash('msg.ok', $message);
    }

    /**
     * @param string $message
     */
    protected function flashWarning($message)
    {
        \Session::flash('msg.warning', $message);
    }

    /**
     * @param string $message
     */
    protected function flashError($message)
    {
        \Session::flash('msg.error', $message);
    }
}
