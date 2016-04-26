<?php
namespace App\ShopifyFramework\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ShopifyFramework\Event\ShopifyShopWasConfirmed;
use CodeCloud\ShopifyApiClient\Auth\HmacSignature;
use CodeCloud\ShopifyApiClient\Auth\Nonce;
use CodeCloud\ShopifyApiClient\Auth\RequestAuthenticator;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class OAuthController extends Controller
{
    public function getInstallApp(Request $request)
    {
        if (! $shop = $request->get('shop')) {
            throw new InvalidParameterException('Shop is a required parameter');
        }

        $clientId = \Config::get('shopify-api-client.keys.api_key');
        $scopes   = implode(',', \Config::get('shopify-api-client.scopes'));
        $redirectUri = url('oauth/confirm-installation');
        $state = (new Nonce())->generateAndPersist();

        $url = "https://$shop.myshopify.com/admin/oauth/authorize?client_id=$clientId&scope=$scopes&redirect_uri=$redirectUri&state=$state";

        return \response()->redirectTo($url);
    }

    public function getConfirmInstallation(Request $request)
    {
        $code = $request->get('code');
        $shop = $request->get('shop');

        $requestAuthenticator = new RequestAuthenticator(new HmacSignature(\Config::get('shopify-api-client.keys.secret_key')));

        if ($requestAuthenticator->authenticates($request)) {
            throw new AccessDeniedHttpException('Invalid parameters were passed to confirm the app installation');
        }

        if ($request->get('state') != (new Nonce())->retrieve()) {
            throw new AccessDeniedHttpException('Invalid nonce');
        }

        if (! preg_match('/^[0-9A-Za-z-\.]+\.myshopify\.com$/', $shop)) {
            throw new InvalidParameterException('Invalid shop name "' . $shop . '"');
        }

        $url = "https://$shop/admin/oauth/access_token";

        $response = (new Client(['verify' => false]))->post($url, [
            'form_params' => [
                'client_id' => \Config::get('shopify-api-client.keys.api_key'),
                'client_secret' => \Config::get('shopify-api-client.keys.secret_key'),
                'code' => $code
            ]
        ]);

        $decoded = json_decode($response->getBody()->getContents());

        //do something here
        \Event::fire(new ShopifyShopWasConfirmed($decoded, $shop));

        return redirect(url('entry'));
    }
}