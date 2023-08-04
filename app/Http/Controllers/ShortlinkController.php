<?php

namespace App\Http\Controllers;

use App\Models\Shortlink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_links = Shortlink::get();
        return response()->json($data_links, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validated  = $request->validate([
                'url' => 'required|url'
            ]);
            $generate_code =  Str::random(7);
            $created = Shortlink::create([
                'url' => $request->url,
                'g_code' => $generate_code,
                'shorturl' => env('APP_URL') . '/' . $generate_code,
            ]);
            if ($created) {
                return response()->json('Link generate with successfully');
            } else {
                return response()->json('Someting is wornag');
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($shorturl)
    {
        $origin_link = Shortlink::select('url')->where('g_code', $shorturl)->first();
        return redirect($origin_link->url);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function count_visit(Request $request)
    {
        try {


            $validated = $request->validate([
                'id' => 'required|integer',
                'nb_visit' => 'required|integer',
            ]);
            $link_update = Shortlink::find($request->id);
            $add_visit =  $link_update->update([
                'nb_visit' => $request->nb_visit
            ]);
            if ($add_visit) {
                return response()->json('NB visit add with successfully');
            } else {
                return response()->json('Nb not added');
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shortlink $shortlink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shortlink $shortlink)
    {
        //
    }
}
