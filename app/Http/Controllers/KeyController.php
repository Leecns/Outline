<?php

namespace App\Http\Controllers;

use App\Services\OutlineVPN\AccessKey;
use Illuminate\Http\Request;

class KeyController extends Controller
{
    public function index()
    {
        $serverInfoRequest = api()->server();

        if ($serverInfoRequest->succeed) {
            $server = $serverInfoRequest->result;

            $keysRequest = api()->keys();

            if ($keysRequest->succeed) {
                $keys = collect($keysRequest->result->accessKeys)->map(fn ($key) => AccessKey::fromObject($key));

                return view('servers.keys.index', compact('server', 'keys'));
            }

            $keysRequest->throw();
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

        $newKeyRequest = api()->createKey();

        if (! $newKeyRequest->succeed) {
            $newKeyRequest->throw();
        }


        // TODO: Store the key in the database
        $outlineAccessKey = AccessKey::fromObject($newKeyRequest->result);

        return redirect()->route('keys.index');
    }
}
