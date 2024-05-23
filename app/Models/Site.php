<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Site extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false;

    protected $fillable = [
        'site_url',
        'user_login',
        'password_id',
        'password',
        'installed_at',
    ];

    protected $casts = [
            'user_login' => 'encrypted',
            'password_id' => 'encrypted',
            'password' => 'encrypted',
    ];

    public function getRequestAttribute()
    {
        return Http::withHeaders([
            'content-type' => 'application/json',
            'Cookie' => 'instawp_skip_splash=true',
            ])
            ->withBasicAuth($this->user_login, $this->password);
    }

    public function validateConnection()
    {
        $response = $this->request->get($this->site_url . '/?rest_route=/wp/v2/users/me/application-passwords/introspect');
        if ($response->status() === 200) {
            $collection = collect(json_decode($response, true));
            $this->password_id = $collection->get('uuid');
            $this->save();
            return true;
        }
        return false;
    }

    public function isPluginInstalled()
    {
        $response = $this->request->get($this->site_url . '/?rest_route=/wp/v2/plugins/wordpress-seo/wp-seo');
        return $response->status() === 200;
    }

    public function installPlugin()
    {
        return $this->request->post($this->site_url . '/?rest_route=/wp/v2/plugins', [
            'slug' => 'wordpress-seo',
            'status' => 'active',
        ]);
    }

    public function revokeConnection()
    {
        $endpoint = $this->site_url . '/?rest_route=/wp/v2/users/me/application-passwords/' . $this->password_id;
        $response = $this->request->delete($endpoint);
        if ($response->successful()) {
            $this->user_login = null;
            $this->password = null;
            $this->password_id = null;
            $this->save();
            $this->message = 'Password revoked';
        } else {
            $this->message = 'Failed to revoke password';
        }
    }
}
