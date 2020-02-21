<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use TheNetworg\OAuth2\Client\Provider\Azure;

class OAuthController extends Controller
{
    /**
     * @var Azure
     */
    private $azure;

    public function __construct()
    {
        $this->middleware('guest');

        $this->azure = new Azure([
            'clientId' => env('AZURE_CLIENT'),
            'clientSecret' => env('AZURE_SECRET'),
            'redirectUri' => route('auth.azure.callback')
        ]);
    }

    public function azureRedirect(Request $request)
    {
        return redirect()->away($this->azure->getAuthorizationUrl())->withCookie(cookie()->forever('azure_state', $this->azure->getState()));
    }

    public function azureCallback(Request $request)
    {
        if ($request->cookie('azure_state') != $request->get('state'))
            abort(403);

        $token = $this->azure->getAccessToken('authorization_code', [
            'code' => $request->get('code'),
            'resource' => 'https://graph.windows.net',
        ]);

        try {
            $me = $this->azure->get('me', $token);
            //dd($me);

            $user = User::where('email', $me['mail'])->first();
            if ($user) {
                Auth::login($user);
            } else {
                $user = User::create([
                    'name' => $me['displayName'],
                    'email' => $me['mail'],
                    'password' => Hash::make(Str::random(16)),
                    'api_token' => Str::random(80)
                ]);
                Auth::login($user);
            }
        } catch (Exception $e) {
            abort(403, $e->getMessage());
        }
        return redirect()->route('root');
    }

}
