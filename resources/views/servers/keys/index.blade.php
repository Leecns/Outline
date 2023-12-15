@extends('layouts.app')

@section('content')
    <div class="card m-5 p-1">
        <div class="card-body">
            <div class="card-title d-flex justify-content-between align-items-center">
                <h5>{{ $server->name }}</h5>
                <a class="btn btn-outline-light btn-sm" href="{{ route('servers.edit', $server->id) }}">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <defs>
                            <symbol id="lineMdCog0">
                                <path fill="none" stroke-width="2" d="M15.24 6.37C15.65 6.6 16.04 6.88 16.38 7.2C16.6 7.4 16.8 7.61 16.99 7.83C17.46 8.4 17.85 9.05 18.11 9.77C18.2 10.03 18.28 10.31 18.35 10.59C18.45 11.04 18.5 11.52 18.5 12"><animate fill="freeze" attributeName="d" begin="0.8s" dur="0.2s" values="M15.24 6.37C15.65 6.6 16.04 6.88 16.38 7.2C16.6 7.4 16.8 7.61 16.99 7.83C17.46 8.4 17.85 9.05 18.11 9.77C18.2 10.03 18.28 10.31 18.35 10.59C18.45 11.04 18.5 11.52 18.5 12;M15.24 6.37C15.65 6.6 16.04 6.88 16.38 7.2C16.38 7.2 19 6.12 19.01 6.14C19.01 6.14 20.57 8.84 20.57 8.84C20.58 8.87 18.35 10.59 18.35 10.59C18.45 11.04 18.5 11.52 18.5 12"/></path>
                            </symbol>
                        </defs>
                        <g fill="none" stroke="currentColor" stroke-width="2">
                            <g stroke-linecap="round" stroke-linejoin="round">
                                <path stroke-dasharray="42" stroke-dashoffset="42" d="M12 5.5C15.59 5.5 18.5 8.41 18.5 12C18.5 15.59 15.59 18.5 12 18.5C8.41 18.5 5.5 15.59 5.5 12C5.5 8.41 8.41 5.5 12 5.5z" opacity="0">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.5s" values="42;0"/>
                                    <set attributeName="opacity" begin="0.2s" to="1"/>
                                    <set attributeName="opacity" begin="0.7s" to="0"/>
                                </path>
                                <path stroke-dasharray="20" stroke-dashoffset="20" d="M12 9C13.66 9 15 10.34 15 12C15 13.66 13.66 15 12 15C10.34 15 9 13.66 9 12C9 10.34 10.34 9 12 9z">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="20;0"/>
                                </path>
                            </g>
                            <g opacity="0"><use href="#lineMdCog0"/>
                                <use href="#lineMdCog0" transform="rotate(60 12 12)"/>
                                <use href="#lineMdCog0" transform="rotate(120 12 12)"/>
                                <use href="#lineMdCog0" transform="rotate(180 12 12)"/>
                                <use href="#lineMdCog0" transform="rotate(240 12 12)"/>
                                <use href="#lineMdCog0" transform="rotate(300 12 12)"/>
                                <set attributeName="opacity" begin="0.7s" to="1"/>
                            </g>
                        </g>
                    </svg>
                </a>
            </div>

            <h6 class="card-subtitle mb-2 text-body-secondary opacity-50">{{ $server->version }} | {{ $server->api_id }}</h6>

            <section class="d-flex flex-wrap gap-2 justify-content-between">
                <div>
                    <span class="opacity-50">{{ __('Status') }}:</span>
                    @if ($server->is_available)
                        <span class="badge bg-success text-dark">{{ __('Available') }}</span>
                    @else
                        <span class="badge bg-danger text-dark">{{ __('Not Available') }}</span>
                    @endif
                </div>

                <div>
                    <span class="opacity-50">{{ __('Creation date') }}:</span>
                    <span class="badge bg-light text-dark">{{ $server->api_created_at }} ({{ $server->api_created_at->diffForHumans() }})</span>
                </div>
                <div>
                    <span class="opacity-50">{{ __('Total usage') }}:</span>
                    <span class="badge bg-light text-dark">{{ format_bytes($server->total_data_usage) }}</span>
                </div>

                <div>
                    <span class="opacity-50">
                        <abbr title="{{ __('This port will be used for new keys.') }}">{{ __('Port') }}</abbr>:
                    </span>
                    <span class="badge bg-light text-dark">{{ $server->port_for_new_access_keys }}</span>
                </div>

                <div>
                    <span class="opacity-50">
                        <abbr title="{{ __('This hostname will be used for new keys.') }}">{{ __('Hostname') }}</abbr>:
                    </span>
                    <span class="badge bg-light text-dark">{{ $server->hostname_for_new_access_keys }}</span>
                </div>

                <div>
                    <span class="opacity-50">{{ __('Number of keys') }}:</span>
                    <span class="badge bg-light text-dark">{{ $keys->count() }}</span>
                </div>

                <div class="w-100">
                    <span class="opacity-50">{{ __('Management URL') }}:</span>
                    <a class="btn btn-link px-0 text-break" href="{{ $server->api_url }}" target="_blank">{{ $server->api_url }}</a>
                </div>
            </section>
        </div>
    </div>

    <div class="card m-5 p-1">
        <div class="card-body">
            <div class="card-title d-flex justify-content-between gap-2 align-items-center mb-3">
                <h5>{{ __('Keys') }}</h5>

               @if ($server->is_available)
                    <a href="{{ route('servers.keys.create', $server->id) }}" class="btn btn-light text-uppercase">{{ __('Create') }}</a>
               @endif
            </div>


            <section class="d-flex flex-wrap gap-3 justify-content-start">
                @foreach($keys as $key)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $key->name ?: "Key-$key->id" }}</h5>
                            <div class="card-text py-2 mb-2">
                                <section>
                                    <code>{{ $key->access_url }}</code>
                                </section>

                                <section>
                                    <span><svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20.536 20.536C22 19.07 22 16.714 22 12c0-4.714 0-7.071-1.465-8.536C19.072 2 16.714 2 12 2S4.929 2 3.464 3.464C2 4.93 2 7.286 2 12c0 4.714 0 7.071 1.464 8.535C4.93 22 7.286 22 12 22c4.714 0 7.071 0 8.535-1.465" opacity=".5"/><path fill="currentColor" d="M7 10.75a.75.75 0 0 1-.493-1.315l3.437-3a.75.75 0 0 1 .987 1.13L9 9.25h8a.75.75 0 0 1 0 1.5zm6.07 5.685a.75.75 0 0 0 .986 1.13l3.437-3A.75.75 0 0 0 17 13.25H7a.75.75 0 0 0 0 1.5h8z"/></svg></span>
                                    <span>{{ format_bytes($server->total_data_usage) }}</span>
                                </section>

                                @if ($key->expires_at)
                                    <section>
                                        <span><svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3.464 20.536C4.93 22 7.286 22 12 22c4.714 0 7.071 0 8.535-1.465C22 19.072 22 16.714 22 12s0-7.071-1.465-8.536C19.072 2 16.714 2 12 2S4.929 2 3.464 3.464C2 4.93 2 7.286 2 12c0 4.714 0 7.071 1.464 8.535" opacity=".5"/><path fill="currentColor" fill-rule="evenodd" d="M12 7.25a.75.75 0 0 1 .75.75v3.69l2.28 2.28a.75.75 0 1 1-1.06 1.06l-2.5-2.5a.75.75 0 0 1-.22-.53V8a.75.75 0 0 1 .75-.75" clip-rule="evenodd"/></svg></span>
                                        <span>{{ $key->expires_at }}</span>
                                    </section>
                                @endif
                            </div>

                           <section class="d-flex gap-3">
                               <button class="btn btn-outline-light">
                                   <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M10.553 13.447c-.424-.424-.95-.596-1.535-.675c-.553-.074-1.25-.074-2.086-.074H5.827c-.58 0-1.065 0-1.459.037c-.411.04-.795.124-1.146.34c-.345.21-.634.5-.845.844c-.216.352-.3.735-.34 1.147C2 15.459 2 15.944 2 16.525v.068c0 .884 0 1.597.055 2.17c.056.592.175 1.108.459 1.571c.288.47.682.864 1.152 1.152c.463.284.979.403 1.57.46C5.81 22 6.524 22 7.407 22h.07c.58 0 1.064 0 1.458-.037c.412-.04.795-.124 1.147-.34c.344-.21.633-.5.844-.844c.216-.352.3-.736.34-1.147c.037-.394.037-.879.037-1.46v-1.104c0-.836 0-1.533-.074-2.086c-.079-.584-.251-1.111-.675-1.535m-1.62-11.41c.412.04.795.124 1.147.34c.344.21.633.5.844.845c.216.351.3.735.34 1.146c.037.394.037.879.037 1.46v1.104c0 .836 0 1.533-.074 2.086c-.079.584-.251 1.111-.675 1.535c-.424.424-.95.596-1.535.675c-.553.074-1.25.074-2.086.074H5.827c-.58 0-1.065 0-1.459-.037c-.411-.04-.795-.124-1.146-.34a2.559 2.559 0 0 1-.845-.844c-.216-.352-.3-.735-.34-1.147C2 8.54 2 8.056 2 7.475v-.068c0-.884 0-1.597.055-2.17c.056-.592.175-1.108.459-1.571c.288-.47.682-.864 1.152-1.152c.463-.284.979-.403 1.57-.46C5.81 2 6.524 2 7.407 2h.07c.58 0 1.064 0 1.458.037M16.593 2h-.068c-.58 0-1.065 0-1.46.037c-.41.04-.794.124-1.146.34c-.344.21-.633.5-.844.845c-.216.351-.3.735-.34 1.146c-.037.394-.037.879-.037 1.46v1.104c0 .836 0 1.533.074 2.086c.079.584.251 1.111.675 1.535c.424.424.95.596 1.535.675c.553.074 1.25.074 2.086.074h1.105c.58 0 1.065 0 1.459-.037c.411-.04.795-.124 1.146-.34c.345-.21.634-.5.845-.844c.216-.352.3-.735.34-1.147C22 8.54 22 8.056 22 7.475v-.068c0-.884 0-1.597-.055-2.17c-.056-.592-.175-1.108-.459-1.571a3.489 3.489 0 0 0-1.152-1.152c-.463-.284-.979-.403-1.57-.46C18.19 2 17.477 2 16.594 2" opacity=".5"/><path fill="currentColor" d="M14.093 21.302a.698.698 0 1 1-1.396 0v-2.79h1.396z" opacity=".4"/><path fill="currentColor" d="M21.302 12.698a.698.698 0 0 0-.697.697v3.256H22v-3.256a.698.698 0 0 0-.698-.697" opacity=".5"/><path fill="currentColor" d="M16.076 16.617c-.076.184-.076.417-.076.883s0 .699.076.883a1 1 0 0 0 .541.54c.184.077.417.077.883.077s.699 0 .883-.076a1 1 0 0 0 .54-.541c.077-.184.077-.417.077-.883s0-.699-.076-.883a1 1 0 0 0-.541-.54C18.199 16 17.966 16 17.5 16s-.699 0-.883.076a1 1 0 0 0-.54.541"/><path fill="currentColor" d="M22 18.535v-.023h-1.396c0 .443 0 .74-.016.97c-.015.224-.043.333-.073.405a1.163 1.163 0 0 1-.629.63c-.072.029-.18.056-.405.072c-.23.015-.527.016-.97.016h-1.86V22h1.883c.414 0 .759 0 1.042-.02a2.62 2.62 0 0 0 .844-.175a2.558 2.558 0 0 0 1.384-1.384c.112-.27.156-.549.176-.844c.02-.283.02-.628.02-1.042" opacity=".7"/><path fill="currentColor" d="M12.697 16.616v.035h1.396c0-.668 0-1.116.035-1.458c.034-.33.093-.482.16-.583a1.16 1.16 0 0 1 .321-.32c.101-.068.254-.128.584-.161c.342-.035.79-.036 1.458-.036h1.86v-1.395h-1.896c-.623 0-1.142 0-1.563.043c-.44.044-.85.142-1.218.388c-.28.187-.519.426-.706.706c-.246.368-.343.777-.388 1.217c-.043.421-.043.94-.043 1.564" opacity=".6"/><path fill="currentColor" d="M5.508 18.69c.219.155.528.155 1.146.155c.619 0 .928 0 1.146-.155a.842.842 0 0 0 .2-.199c.154-.218.154-.527.154-1.146c0-.618 0-.927-.155-1.146A.842.842 0 0 0 7.8 16c-.218-.155-.527-.155-1.146-.155c-.618 0-.927 0-1.146.155a.841.841 0 0 0-.199.2c-.155.218-.155.527-.155 1.145c0 .619 0 .928.155 1.146a.841.841 0 0 0 .2.2M6.654 8.155c-.618 0-.927 0-1.146-.155a.84.84 0 0 1-.199-.2c-.155-.217-.155-.527-.155-1.145c0-.619 0-.928.155-1.146a.84.84 0 0 1 .2-.2c.218-.154.527-.154 1.145-.154c.619 0 .928 0 1.146.155a.84.84 0 0 1 .2.199c.154.218.154.527.154 1.146c0 .618 0 .928-.155 1.146A.84.84 0 0 1 7.8 8c-.218.155-.527.155-1.146.155M16.2 8c.218.155.527.155 1.146.155c.618 0 .927 0 1.146-.155a.842.842 0 0 0 .199-.199c.155-.218.155-.528.155-1.146c0-.619 0-.928-.155-1.146a.842.842 0 0 0-.2-.2c-.218-.154-.527-.154-1.145-.154c-.619 0-.928 0-1.146.155a.842.842 0 0 0-.2.199c-.154.218-.154.527-.154 1.146c0 .618 0 .928.155 1.146A.842.842 0 0 0 16.2 8"/></svg>
                               </button>

                               <button class="btn btn-outline-light">
                                   <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6.6 11.397c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c2.715 0 4.073 0 4.916.847c.844.847.844 2.21.844 4.936v4.82c0 2.726 0 4.089-.844 4.936c-.843.847-2.201.847-4.916.847h-2.88c-2.716 0-4.073 0-4.917-.847c-.843-.847-.843-2.21-.843-4.936z"/><path fill="currentColor" d="M4.172 3.172C3 4.343 3 6.229 3 10v2c0 3.771 0 5.657 1.172 6.828c.617.618 1.433.91 2.62 1.048c-.192-.84-.192-1.996-.192-3.66v-4.819c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c1.652 0 2.8 0 3.638.19c-.138-1.193-.43-2.012-1.05-2.632C16.657 2 14.771 2 11 2C7.229 2 5.343 2 4.172 3.172" opacity=".5"/></svg>
                               </button>

                               @if ($server->is_available)
                                   <a href="{{ route('servers.keys.edit', [$server->id, $key->id]) }}" class="btn btn-outline-light">
                                       <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20.849 8.713a3.932 3.932 0 0 0-5.562-5.561l-.887.887l.038.111a8.754 8.754 0 0 0 2.093 3.32a8.754 8.754 0 0 0 3.43 2.13z" opacity=".5"/><path fill="currentColor" d="m14.439 4l-.039.038l.038.112a8.754 8.754 0 0 0 2.093 3.32a8.753 8.753 0 0 0 3.43 2.13l-8.56 8.56c-.578.577-.867.866-1.185 1.114a6.554 6.554 0 0 1-1.211.748c-.364.174-.751.303-1.526.561l-4.083 1.361a1.06 1.06 0 0 1-1.342-1.341l1.362-4.084c.258-.774.387-1.161.56-1.525c.205-.43.456-.836.749-1.212c.248-.318.537-.606 1.114-1.183z"/></svg>
                                   </a>
                                   <form method="post" action="{{ route('servers.keys.destroy', [$server->id, $key->id]) }}">
                                       @csrf
                                       @method('DELETE')

                                       <button class="btn btn-outline-danger">
                                           <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 6.386c0-.484.345-.877.771-.877h2.665c.529-.016.996-.399 1.176-.965l.03-.1l.115-.391c.07-.24.131-.45.217-.637c.338-.739.964-1.252 1.687-1.383c.184-.033.378-.033.6-.033h3.478c.223 0 .417 0 .6.033c.723.131 1.35.644 1.687 1.383c.086.187.147.396.218.637l.114.391l.03.1c.18.566.74.95 1.27.965h2.57c.427 0 .772.393.772.877s-.345.877-.771.877H3.77c-.425 0-.77-.393-.77-.877"/><path fill="currentColor" fill-rule="evenodd" d="M9.425 11.482c.413-.044.78.273.821.707l.5 5.263c.041.433-.26.82-.671.864c-.412.043-.78-.273-.821-.707l-.5-5.263c-.041-.434.26-.821.671-.864m5.15 0c.412.043.713.43.671.864l-.5 5.263c-.04.434-.408.75-.82.707c-.413-.044-.713-.43-.672-.864l.5-5.264c.041-.433.409-.75.82-.707" clip-rule="evenodd"/><path fill="currentColor" d="M11.596 22h.808c2.783 0 4.174 0 5.08-.886c.904-.886.996-2.339 1.181-5.245l.267-4.188c.1-1.577.15-2.366-.303-2.865c-.454-.5-1.22-.5-2.753-.5H8.124c-1.533 0-2.3 0-2.753.5c-.454.5-.404 1.288-.303 2.865l.267 4.188c.185 2.906.277 4.36 1.182 5.245c.905.886 2.296.886 5.079.886" opacity=".5"/></svg>
                                       </button>
                                   </form>
                               @endif
                           </section>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
@endsection
