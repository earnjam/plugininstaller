<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Installer extends Component
{
    public $site;
    public $installed;
    public $installing = true;
    public $message;
    public $status = 'Checking status...';

    public function checkStatus()
    {
        if ($this->site->isPluginInstalled()) {
            $this->installed = true;
        } else {
            $this->install();
        }
    }

    public function install()
    {
        $this->stream('status', 'Installing Yoast SEO', true);
        $response = $this->site->installPlugin();
        if ($response->successful()) {
            $this->site->installed_at = now();
            $this->site->save();
            $this->installed = true;
            $this->status = 'Installed';
        }
    }

    public function revokeConnection()
    {
        $this->site->revokeConnection();
        return redirect()->route('welcome')->with('success', 'Connection to ' . $this->site->site_url . ' revoked');
    }

    public function render()
    {
        return view('livewire.installer');
    }
}
