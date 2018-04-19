<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Apidemo extends Controller
{
    //
    public function index(request $request)
    {
        //$response = \Guzzle::get('https://api.github.com/repos/guzzle/guzzle');
        $response = \Guzzle::get('https://mpt.i906.my/mpt.json?code=sgr-9');
        $content = json_decode ($response -> getBody(),true);

        if ($content['meta']['code'] == 200)
        {
            $provider = $content ['response']['provider'];
            $place = $content ['response']['place'];
            $prayer_times = $content ['response']['times'];

            return response ()
                ->view('apidemo/index',
                compact ('provider', 'place', 'prayer_times'));

        } else {
            return "Request failed!";
        }
        
    }
}
