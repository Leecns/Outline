<?php

namespace App\Http\Controllers;

use App\Models\AccessKey;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeyController extends Controller
{
    public function index(Server $server)
    {
        // TODO: sync the existing keys
        $keys = $server->keys()->latest()->paginate();

        return view('servers.keys.index', compact('server', 'keys'));

    }

    public function create(Server $server)
    {
        return view('servers.keys.create', compact('server'));
    }

    public function store(Request $request, Server $server)
    {
        $request->validate([
            'name' => 'required|string|max:64'
        ]);

        DB::transaction(function() use ($request, $server) {
            $server->keys()->create([
                'name' => $request->name,
                // Todo: add expire time
            ]);
        });

        return redirect()->route('servers.keys.index', $server->id);
    }

    public function edit(Server $server, AccessKey $key)
    {
        return view('servers.keys.edit', compact('server', 'key'));
    }

    public function update(Request $request, Server $server, AccessKey $key)
    {
        $request->validate([
            'name' => 'required|string|max:64'
        ]);

        DB::transaction(function () use ($request, $key) {
            $key->update([
                'name' => $request->name
            ]);
        });

        return redirect()->route('servers.keys.index', $server->id);
    }

    public function destroy(Server $server, AccessKey $key)
    {
        DB::transaction(function () use ($server, $key) {
            $server->keys()->find($key->id)->delete();
        });

        return redirect()->route('servers.keys.index', $server->id);
    }
}
