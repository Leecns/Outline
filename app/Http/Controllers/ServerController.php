<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
use Throwable;

class ServerController extends Controller
{
    public function index(Request $request)
    {
        $numberOfServers = Server::count();
        $servers = Server::when($request->has('q'), function($query) use ($request) {
            $query->where('name', 'LIKE', "%$request->q%");
//                ->orWhere('ip', 'LIKE', "%$request->q%"); // TODO: add ip field to server model
        })->latest()->get();

        return view('servers.index', compact('servers', 'numberOfServers'));
    }

    public function create()
    {
        return view('servers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'api_url_and_cert_sha256' => 'required|max:255'
        ]);

        $data = json_decode($request->api_url_and_cert_sha256);

        try {
            Server::create([
                'api_url' => $data->apiUrl,
                'api_cert_sha256' => $data->certSha256,
            ]);
        } catch (Throwable $exception) {
            // TODO: report to sentry
            return back()->withErrors([ 'message' => __('Could not create new server.') ]);
        }

        return redirect()->route('servers.index');
    }
}
