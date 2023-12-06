<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index()
    {
        $servers = Server::latest()->paginate();

        return view('servers.index', compact('servers'));
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

        Server::create([
            'api_url' => $data->apiUrl,
            'api_cert_sha256' => $data->certSha256,
        ]);

        return redirect()->route('servers.index');
    }
}
