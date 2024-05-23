<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InstallController extends Controller
{
    public function install(Site $site)
    {
        return view('install', ['site' => $site]);
    }
}
