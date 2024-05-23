<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class Connect extends Controller
{
    public function connect(Request $request)
    {
        $site = Site::where('site_url', $request->site_url)->first();
        $site->user_login = $request->user_login;
        $site->password = $request->password;
        if ($site->validateConnection()) {
            $site->save();
            return redirect()->route('install', ['site' => $site->id]);
        } else {
            return redirect()->route('welcome')->with('error', 'Unable to connect to the site. Please check your credentials.');
        }
    }
}
