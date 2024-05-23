<div wire:init='checkStatus'>
    <p><strong>Site:</strong> <a class="hover:underline" href="{{ $site->site_url }}">{{ $site->site_url }}</a></p>
    <div class="flex gap-1 mt-2">
        <strong>Status:</strong>
        @if (! $installed)
            <span wire:stream="status" class="flex gap-1">{{ $status }}</span><x-spinner size="md"/>
        @else
            <span>Installed</span>
        @endif
    </div>
    @if($installed)
        <p class="text-green-800">{{ $message }}</p>
        <div class="flex gap-4 mt-4">
            @if($site->password)
                <button class="p-2 text-white border border-none rounded-lg bg-yoast-purple-800 hover:bg-yoast-purple-900" wire:click='revokeConnection'>Revoke Connection</button>
            @endif
            <a target="_blank" href="{{ $site->site_url }}/wp-admin/admin.php?page=wpseo_dashboard" class="p-2 text-white border border-none rounded-lg bg-yoast-purple-800 hover:bg-yoast-purple-900">Visit Site &raquo;</a>
        </div>
    @endif
</div>
