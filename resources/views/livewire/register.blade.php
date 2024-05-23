<?php

use function Livewire\Volt\{state};
use function Livewire\Volt\{rules};
use function Livewire\Volt\{updated};
use App\Models\Site;

state(['site_url' => '']);
rules(['site_url' => ['required', 'url', function($attribute, $value, $fail) {
        if (! Str::isUrl($value, ['https'])) {
            $fail('The site must be on HTTPS to securely connect.');
        }
    }]
]);

$register = function () {
    $this->validate();
    // Trim any extraneous parts of Site URL
    $host = parse_url($this->site_url, PHP_URL_HOST);
    $path = str(parse_url($this->site_url, PHP_URL_PATH))->before("wp-admin");
    $this->site_url = str('https://' . $host . $path)->trim('/');
    // Find a record or create a new one
    $site = Site::firstOrCreate(['site_url' => $this->site_url]);

    // Not already connected, redirect to authorize
    if (! $site->password) {
        $url = $site->site_url;
        $url .= '/wp-admin/authorize-application.php?';
        $url .= 'app_name=Yoast Plugin Installer';
        $url .= '&app_id=' . $site->id;
        $url .= '&success_url=' . urlencode(route('connect'));
        $url .= '&reject_url=' . urlencode(route('rejected'));
        $this->redirect($url);
    } else {
        $this->redirectRoute('install', ['site' => $site->id]);
    }
}
?>

<div>
    <p>Enter the URL of the site you would like to install Yoast SEO on.</p>
    <div class="mt-4">
        <p><label for="site_url">Site URL:</label></p>
        <div class="flex gap-4 mt-2">
            <input name="site_url" type="text" wire:model='site_url' class="flex-grow p-2 rounded dark:bg-gray-500 dark:placeholder-gray-900" placeholder="https://example.com" />
            <button class="px-4 py-2 text-white border rounded bg-yoast-purple-700 hover:bg-yoast-purple-900 dark:bg-yoast-purple-900 dark:border-yoast-purple-800" wire:click='register'>Install</button>
        </div>
        @error('site_url')
            <div class="mt-2 text-red-700">{{ $message }}</div>
        @enderror
    </div>
</div>
