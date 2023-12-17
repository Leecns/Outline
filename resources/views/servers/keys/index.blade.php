@extends('layouts.app')

@section('content')
    <div class="m-5 p-1">
        <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <a class="btn btn-tool" href="{{ route('servers.index') }}">
                        <svg width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="m7.825 13l4.9 4.9q.3.3.288.7t-.313.7q-.3.275-.7.288t-.7-.288l-6.6-6.6q-.15-.15-.213-.325T4.426 12q0-.2.063-.375T4.7 11.3l6.6-6.6q.275-.275.688-.275t.712.275q.3.3.3.713t-.3.712L7.825 11H19q.425 0 .713.288T20 12q0 .425-.288.713T19 13z"/></svg>
                    </a>
                    <h2 class="m-0">{{ $server->name }}</h2>
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
            <div class="d-flex justify-content-between gap-2 align-items-center">
                <h2>{{ __('🗝️ Access Keys') }}</h2>

               @if ($server->is_available)
                    <a href="{{ route('servers.keys.create', $server->id) }}" class="btn btn-primary">{{ __('Create') }}</a>
               @endif
            </div>

            <table class="table-responsive">
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
                    <tr>
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
                                <button class="btn btn-tool" title="{{ __('Show QR code') }}">
                                    <svg width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M10.553 13.447c-.424-.424-.95-.596-1.535-.675c-.553-.074-1.25-.074-2.086-.074H5.827c-.58 0-1.065 0-1.459.037c-.411.04-.795.124-1.146.34c-.345.21-.634.5-.845.844c-.216.352-.3.735-.34 1.147C2 15.459 2 15.944 2 16.525v.068c0 .884 0 1.597.055 2.17c.056.592.175 1.108.459 1.571c.288.47.682.864 1.152 1.152c.463.284.979.403 1.57.46C5.81 22 6.524 22 7.407 22h.07c.58 0 1.064 0 1.458-.037c.412-.04.795-.124 1.147-.34c.344-.21.633-.5.844-.844c.216-.352.3-.736.34-1.147c.037-.394.037-.879.037-1.46v-1.104c0-.836 0-1.533-.074-2.086c-.079-.584-.251-1.111-.675-1.535m-1.62-11.41c.412.04.795.124 1.147.34c.344.21.633.5.844.845c.216.351.3.735.34 1.146c.037.394.037.879.037 1.46v1.104c0 .836 0 1.533-.074 2.086c-.079.584-.251 1.111-.675 1.535c-.424.424-.95.596-1.535.675c-.553.074-1.25.074-2.086.074H5.827c-.58 0-1.065 0-1.459-.037c-.411-.04-.795-.124-1.146-.34a2.559 2.559 0 0 1-.845-.844c-.216-.352-.3-.735-.34-1.147C2 8.54 2 8.056 2 7.475v-.068c0-.884 0-1.597.055-2.17c.056-.592.175-1.108.459-1.571c.288-.47.682-.864 1.152-1.152c.463-.284.979-.403 1.57-.46C5.81 2 6.524 2 7.407 2h.07c.58 0 1.064 0 1.458.037M16.593 2h-.068c-.58 0-1.065 0-1.46.037c-.41.04-.794.124-1.146.34c-.344.21-.633.5-.844.845c-.216.351-.3.735-.34 1.146c-.037.394-.037.879-.037 1.46v1.104c0 .836 0 1.533.074 2.086c.079.584.251 1.111.675 1.535c.424.424.95.596 1.535.675c.553.074 1.25.074 2.086.074h1.105c.58 0 1.065 0 1.459-.037c.411-.04.795-.124 1.146-.34c.345-.21.634-.5.845-.844c.216-.352.3-.735.34-1.147C22 8.54 22 8.056 22 7.475v-.068c0-.884 0-1.597-.055-2.17c-.056-.592-.175-1.108-.459-1.571a3.489 3.489 0 0 0-1.152-1.152c-.463-.284-.979-.403-1.57-.46C18.19 2 17.477 2 16.594 2" opacity=".5"/><path fill="currentColor" d="M14.093 21.302a.698.698 0 1 1-1.396 0v-2.79h1.396z" opacity=".4"/><path fill="currentColor" d="M21.302 12.698a.698.698 0 0 0-.697.697v3.256H22v-3.256a.698.698 0 0 0-.698-.697" opacity=".5"/><path fill="currentColor" d="M16.076 16.617c-.076.184-.076.417-.076.883s0 .699.076.883a1 1 0 0 0 .541.54c.184.077.417.077.883.077s.699 0 .883-.076a1 1 0 0 0 .54-.541c.077-.184.077-.417.077-.883s0-.699-.076-.883a1 1 0 0 0-.541-.54C18.199 16 17.966 16 17.5 16s-.699 0-.883.076a1 1 0 0 0-.54.541"/><path fill="currentColor" d="M22 18.535v-.023h-1.396c0 .443 0 .74-.016.97c-.015.224-.043.333-.073.405a1.163 1.163 0 0 1-.629.63c-.072.029-.18.056-.405.072c-.23.015-.527.016-.97.016h-1.86V22h1.883c.414 0 .759 0 1.042-.02a2.62 2.62 0 0 0 .844-.175a2.558 2.558 0 0 0 1.384-1.384c.112-.27.156-.549.176-.844c.02-.283.02-.628.02-1.042" opacity=".7"/><path fill="currentColor" d="M12.697 16.616v.035h1.396c0-.668 0-1.116.035-1.458c.034-.33.093-.482.16-.583a1.16 1.16 0 0 1 .321-.32c.101-.068.254-.128.584-.161c.342-.035.79-.036 1.458-.036h1.86v-1.395h-1.896c-.623 0-1.142 0-1.563.043c-.44.044-.85.142-1.218.388c-.28.187-.519.426-.706.706c-.246.368-.343.777-.388 1.217c-.043.421-.043.94-.043 1.564" opacity=".6"/><path fill="currentColor" d="M5.508 18.69c.219.155.528.155 1.146.155c.619 0 .928 0 1.146-.155a.842.842 0 0 0 .2-.199c.154-.218.154-.527.154-1.146c0-.618 0-.927-.155-1.146A.842.842 0 0 0 7.8 16c-.218-.155-.527-.155-1.146-.155c-.618 0-.927 0-1.146.155a.841.841 0 0 0-.199.2c-.155.218-.155.527-.155 1.145c0 .619 0 .928.155 1.146a.841.841 0 0 0 .2.2M6.654 8.155c-.618 0-.927 0-1.146-.155a.84.84 0 0 1-.199-.2c-.155-.217-.155-.527-.155-1.145c0-.619 0-.928.155-1.146a.84.84 0 0 1 .2-.2c.218-.154.527-.154 1.145-.154c.619 0 .928 0 1.146.155a.84.84 0 0 1 .2.199c.154.218.154.527.154 1.146c0 .618 0 .928-.155 1.146A.84.84 0 0 1 7.8 8c-.218.155-.527.155-1.146.155M16.2 8c.218.155.527.155 1.146.155c.618 0 .927 0 1.146-.155a.842.842 0 0 0 .199-.199c.155-.218.155-.528.155-1.146c0-.619 0-.928-.155-1.146a.842.842 0 0 0-.2-.2c-.218-.154-.527-.154-1.145-.154c-.619 0-.928 0-1.146.155a.842.842 0 0 0-.2.199c-.154.218-.154.527-.154 1.146c0 .618 0 .928.155 1.146A.842.842 0 0 0 16.2 8"/></svg>
                                </button>

                                <button class="btn btn-tool" title="{{ __('Copy access key to clipboard') }}">
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
    </div>
@endsection
