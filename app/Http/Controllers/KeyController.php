<?php

namespace App\Http\Controllers;

use App\Models\AccessKey;
use App\Services\OutlineVPN\ApiAccessKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeyController extends Controller
{
    public function index()
    {
        // TODO: sync the existing keys
        $serverInfoRequest = api()->server();

        if ($serverInfoRequest->succeed) {
            $server = $serverInfoRequest->result;
dd($server);
            $keys = AccessKey::latest()->paginate();

            return view('servers.keys.index', compact('server', 'keys'));
        }

        $serverInfoRequest->throw();
    }

    public function create()
    {
        return view('servers.keys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64'
        ]);

        DB::transaction(function() use ($request) {
            AccessKey::create([
                'name' => $request->name,
                // Todo: add expire time
            ]);
        });

        return redirect()->route('keys.index');
    }

    public function edit(AccessKey $key)
    {
        return view('servers.keys.edit', compact('key'));
    }

    public function update(Request $request, AccessKey $key)
    {
        $request->validate([
            'name' => 'required|string|max:64'
        ]);

        DB::transaction(function () use ($request, $key) {
            $key->update([
                'name' => $request->name
            ]);
        });

        return redirect()->route('keys.index');
    }

    public function destroy(AccessKey $key)
    {
        DB::transaction(function () use ($key) {
            $key->delete();
        });

        return redirect()->route('keys.index');
    }
}
