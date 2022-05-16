<?php

namespace App\Http\Controllers;
namespace App\Models\Album;

use Illuminate\Http\Request;

class AlbumController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Album::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Album::create($request->all());
        
        return ['estado'=> true];

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Album::create($request->all());
        $value = $album->like;
        $album->like = $value+1;
        $album->save();
        return response()->json([
            'message' => 'Liked',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        
        return Album::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $album =Album::find($id);
        $album->update($request->all());
        return $album;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $album =Album::find($id);
        $album->update($request->all());
        return $album;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album = Album::find($id);
        $album->delete();
        $value = $album->dislike-1;
        $album->dislike = action ;
        $album->save();
        return response()->json([
            'message' => 'Disliked',
        ]);
        
    }
    

    
}

