@extends('layouts.app')

@section('content')
    <div class="m-5 p-1">
        <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <a class="btn btn-tool" href="{{ route('servers.index') }}">
                        <svg width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="m7.825 13l4.9 4.9q.3.3.288.7t-.313.7q-.3.275-.7.288t-.7-.288l-6.6-6.6q-.15-.15-.213-.325T4.426 12q0-.2.063-.375T4.7 11.3l6.6-6.6q.275-.275.688-.275t.712.275q.3.3.3.713t-.3.712L7.825 11H19q.425 0 .713.288T20 12q0 .425-.288.713T19 13z"/></svg>
                    </a>
                    <h2>{{ $server->name }}</h2>
                </div>

                <a class="btn" href="{{ route('servers.edit', $server->id) }}">{{ __('Settings') }}</a>
            </div>

            <section class="d-flex flex-wrap gap-3 card text-wrap mb-3">
                <div>
                    <span class="opacity-75">{{ __('Status') }}:</span>

                    @if ($server->is_available)
                        <span class="status status-success">{{ __('Available') }}</span>
                    @else
                        <span class="status status-danger">{{ __('Not Available') }}</span>
                    @endif
                </div>

                <div>
                    <span class="opacity-75">{{ __('Version') }}:</span>
                    <span class="status status-secondary">{{ $server->version }}</span>
                </div>

                <div>
                    <span class="opacity-75">{{ __('Creation date') }}:</span>
                    <span class="status status-secondary">{{ $server->api_created_at }} ({{ $server->api_created_at->diffForHumans() }})</span>
                </div>

                <div>
                    <span class="opacity-75">{{ __('Number of keys') }}:</span>
                    <span class="status status-secondary">{{ $keys->count() }}</span>
                </div>

                <div>
                    <span class="opacity-75">{{ __('Total usage') }}:</span>
                    <span class="status status-secondary">{{ format_bytes($server->total_data_usage) }}</span>
                </div>

                <div>
                    <span class="opacity-75">{{ __('Port for new access keys') }}</span>
                    <span class="status status-secondary">{{ $server->port_for_new_access_keys }}</span>
                </div>

                <div>
                    <span class="opacity-75">{{ __('Hostname for new access keys') }}</span>
                    <span class="status status-secondary">{{ $server->hostname_for_new_access_keys }}</span>
                </div>

                <div>
                    <span class="opacity-75">{{ __('Management API URL') }}:</span>
                    <a class="status status-secondary" href="{{ $server->api_url }}" target="_blank">{{ $server->api_url }}</a>
                </div>
            </section>
        </div>

        <div>
            <div class="d-flex justify-content-between gap-2 align-items-center mb-3">
                <h2>{{ __('🗝️ Access Keys') }}</h2>

               @if ($server->is_available)
                    <a href="{{ route('servers.keys.create', $server->id) }}" class="btn btn-primary">{{ __('Create') }}</a>
               @endif
            </div>

            <table>
                <thead>
                <tr class="text-uppercase">
                    <th>{{ __('#') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Data Usage') }}</th>
                    <th>{{ __('Validity') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($keys as $key)
                    <tr data-key="{{ $key->access_url }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $key->name }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-1 justify-content-center">
                                <span>{{ format_bytes($key->data_usage) }}</span>
                                <span class="opacity-50">{{ __('of') }}</span>
                                <span class="d-flex align-items-center">
                                    @if ($key->data_limit)
                                        {{format_bytes($key->data_limit)}}
                                    @else
                                        <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 12a3.5 3.5 0 0 0 3.5 3.5c1.204 0 2.02-.434 2.7-1.113c.621-.623 1.121-1.44 1.655-2.387c-.534-.947-1.034-1.764-1.656-2.387C8.52 8.933 7.704 8.5 6.5 8.5A3.5 3.5 0 0 0 3 12m3.5 5.5a5.5 5.5 0 1 1 0-11c1.797 0 3.105.691 4.113 1.7c.536.534.987 1.162 1.387 1.802c.4-.64.851-1.268 1.387-1.803C14.395 7.191 15.703 6.5 17.5 6.5a5.5 5.5 0 1 1 0 11c-1.796 0-3.105-.691-4.113-1.7c-.536-.534-.987-1.162-1.387-1.802c-.4.64-.851 1.268-1.387 1.803C9.605 16.809 8.297 17.5 6.5 17.5m6.645-5.5c.534.947 1.034 1.764 1.656 2.387c.68.68 1.496 1.113 2.699 1.113a3.5 3.5 0 1 0 0-7c-1.203 0-2.02.434-2.7 1.113c-.621.623-1.121 1.44-1.655 2.387"/></svg>
                                    @endif
                                </span>
                            </div>
                        <td>
                            <div class="d-flex justify-content-center">
                                @if ($key->expires_at)
                                    <span class="status status-warning">{{ $key->expires_at }}</span>
                                @else
                                    <span class="status status-success d-flex align-items-center" title="{{ __('Forever') }}">
                                        <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 12a3.5 3.5 0 0 0 3.5 3.5c1.204 0 2.02-.434 2.7-1.113c.621-.623 1.121-1.44 1.655-2.387c-.534-.947-1.034-1.764-1.656-2.387C8.52 8.933 7.704 8.5 6.5 8.5A3.5 3.5 0 0 0 3 12m3.5 5.5a5.5 5.5 0 1 1 0-11c1.797 0 3.105.691 4.113 1.7c.536.534.987 1.162 1.387 1.802c.4-.64.851-1.268 1.387-1.803C14.395 7.191 15.703 6.5 17.5 6.5a5.5 5.5 0 1 1 0 11c-1.796 0-3.105-.691-4.113-1.7c-.536-.534-.987-1.162-1.387-1.802c-.4.64-.851 1.268-1.387 1.803C9.605 16.809 8.297 17.5 6.5 17.5m6.645-5.5c.534.947 1.034 1.764 1.656 2.387c.68.68 1.496 1.113 2.699 1.113a3.5 3.5 0 1 0 0-7c-1.203 0-2.02.434-2.7 1.113c-.621.623-1.121 1.44-1.655 2.387"/></svg>
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="status status-success">Active</span>
                        </td>
                        <td>
                            <div class="d-flex gap-2 align-items-center justify-content-center flex-wrap">
                                <button class="btn btn-tool" title="{{ __('Show access key') }}" data-dialog-trigger="true" data-dialog="accessKeyModal" data-as-modal="true" onclick="bindAccessKey(this)">
                                    <svg width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M18.977 14.79a6.907 6.907 0 1 0-11.573-3.159c.095.369.01.768-.258 1.037L3.433 16.38a1.48 1.48 0 0 0-.424 1.21l.232 2.089c.025.223.125.43.283.589l.208.208a.987.987 0 0 0 .589.283l2.089.232a1.48 1.48 0 0 0 1.21-.424l.71-.71l-1.747-1.728a.75.75 0 1 1 1.055-1.066l1.752 1.733l1.942-1.942c.27-.27.668-.353 1.037-.258a6.904 6.904 0 0 0 6.608-1.806m-6.391-6.204a2 2 0 1 1 2.828 2.828a2 2 0 0 1-2.828-2.828" clip-rule="evenodd"/></svg>
                                </button>

                                <button class="btn btn-tool" title="{{ __('Show QR code') }}" data-dialog-trigger="true" data-dialog="qrCodeModal" data-as-modal="true" onclick="createQRCode(this)">
                                    <svg width="20" height="20" viewBox="0 0 448 512"><path fill="currentColor" d="M0 80c0-26.5 21.5-48 48-48h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48zm64 16v64h64V96zM0 336c0-26.5 21.5-48 48-48h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48zm64 16v64h64v-64zM304 32h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48h-96c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48m80 64h-64v64h64zM256 304c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s7.2 16 16 16h32c8.8 0 16-7.2 16-16s7.2-16 16-16s16 7.2 16 16v96c0 8.8-7.2 16-16 16h-64c-8.8 0-16-7.2-16-16s-7.2-16-16-16s-16 7.2-16 16v64c0 8.8-7.2 16-16 16h-32c-8.8 0-16-7.2-16-16zm112 176a16 16 0 1 1 0-32a16 16 0 1 1 0 32m64 0a16 16 0 1 1 0-32a16 16 0 1 1 0 32"/></svg>
                                </button>

                                <button class="btn btn-tool" title="{{ __('Copy access key to clipboard') }}" onclick="copyToClipboard('{{ $key->access_url }}', '{{ __('Copied 😎') }}')">
                                    <svg width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M6.6 11.397c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c2.715 0 4.073 0 4.916.847c.844.847.844 2.21.844 4.936v4.82c0 2.726 0 4.089-.844 4.936c-.843.847-2.201.847-4.916.847h-2.88c-2.716 0-4.073 0-4.917-.847c-.843-.847-.843-2.21-.843-4.936z"/><path fill="currentColor" d="M4.172 3.172C3 4.343 3 6.229 3 10v2c0 3.771 0 5.657 1.172 6.828c.617.618 1.433.91 2.62 1.048c-.192-.84-.192-1.996-.192-3.66v-4.819c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c1.652 0 2.8 0 3.638.19c-.138-1.193-.43-2.012-1.05-2.632C16.657 2 14.771 2 11 2C7.229 2 5.343 2 4.172 3.172" opacity=".5"/></svg>
                                </button>

                                @if ($server->is_available)
                                    <a href="{{ route('servers.keys.edit', [$server->id, $key->id]) }}" class="btn btn-tool" title="{{ __('Edit the key') }}">
                                        <svg width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M20.849 8.713a3.932 3.932 0 0 0-5.562-5.561l-.887.887l.038.111a8.754 8.754 0 0 0 2.093 3.32a8.754 8.754 0 0 0 3.43 2.13z" opacity=".5"/><path fill="currentColor" d="m14.439 4l-.039.038l.038.112a8.754 8.754 0 0 0 2.093 3.32a8.753 8.753 0 0 0 3.43 2.13l-8.56 8.56c-.578.577-.867.866-1.185 1.114a6.554 6.554 0 0 1-1.211.748c-.364.174-.751.303-1.526.561l-4.083 1.361a1.06 1.06 0 0 1-1.342-1.341l1.362-4.084c.258-.774.387-1.161.56-1.525c.205-.43.456-.836.749-1.212c.248-.318.537-.606 1.114-1.183z"/></svg>
                                    </a>
                                    <form method="post" action="{{ route('servers.keys.destroy', [$server->id, $key->id]) }}" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-tool btn-danger" title="{{ __('Remove the key') }}">
                                            <svg width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2zM18 4h-2.5l-.71-.71c-.18-.18-.44-.29-.7-.29H9.91c-.26 0-.52.11-.7.29L8.5 4H6c-.55 0-1 .45-1 1s.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="99">
                            <section class="p-3 text-center text-muted d-grid gap-2 align-items-center">
                                <div>¯\_(ツ)_/¯</div>
                                <div>{{ __("There is no access key to display!") }}</div>
                            </section>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <dialog id="accessKeyModal">
            <h3>{{ __('Access Key URL') }}</h3>
            <div class="my-3">
                <code id="accessKeyModalValue">__access_key__</code>
            </div>
            <div class="text-end">
                <button class="btn px-4" data-dialog-close="true" data-dialog="accessKeyModal">{{ __('Ok') }}</button>
            </div>
        </dialog>

        <dialog id="qrCodeModal">
            <h3>{{ __('️Access Key QR Code') }}</h3>
            <div class="my-3" id="accessKeyQRCodeContainer"></div>
            <div class="text-end">
                <button class="btn px-4" data-dialog-close="true" data-dialog="qrCodeModal">{{ __('Ok') }}</button>
            </div>
        </dialog>
    </div>
@endsection

@section('footer-stuff')
    <script>
        const accessKeyModalValueEl = document.getElementById('accessKeyModalValue');

        const bindAccessKey = (el) => {
            accessKeyModalValueEl.innerHTML = el.closest('tr').dataset.key;
        }

        const createQRCode = (el) => {
            const intervalId = setInterval(() => {
                if (!window.createQRCode)
                    return;

                clearInterval(intervalId);
                window.createQRCode(el.closest('tr').dataset.key, '{{ asset('favicon.svg') }}', '#accessKeyQRCodeContainer');
            }, 100);
        }
    </script>
@endsection
