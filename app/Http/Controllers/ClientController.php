<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientCollection;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->tokenCan('client:index'), JsonResponse::HTTP_UNAUTHORIZED);
        return new ClientCollection(Client::with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        abort_if(!auth()->user()->tokenCan('client:store'), JsonResponse::HTTP_UNAUTHORIZED);

        DB::transaction(function() use($request){
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password'))
            ]);

            $user->client()->create([
                'name' => $request->get('name'),
            ]);
        });

        return response()->json(status:JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return new ClientResource($client->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //dd($request->all(), $client->user);
        DB::transaction(function() use($request, $client){
            $client->user->update([
                'name' => $request->get('name')
            ]);
        });

        return response()->json(status: JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json(status: JsonResponse::HTTP_NO_CONTENT);
    }
}
