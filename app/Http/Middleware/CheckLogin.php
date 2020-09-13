<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
       if (isset($_COOKIE['auth'])) {
        if (\App\User::where('token', $_COOKIE['auth'])->count() == 0) return redirect()->route('home');
        $user = \App\User::where('token', $_COOKIE['auth'])->get()->first();
        $password = decrypt($user->password);
        $curl = curl_init();
        $header = array();
        $header[] = 'Authorization: '. env('FIBRAFORTE_API_KEY');
        curl_setopt($curl, CURLOPT_URL, env('FIBRAFORTE_API_ENDPOINT_LOGIN'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "username={$user->username}&password=$password");
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        \Auth::login($user);
       } else {
        return redirect()->route('home');
       }
       return $next($request);
    }
}
