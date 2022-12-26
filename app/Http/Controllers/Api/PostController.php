<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorPostRequest;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $post = Posts::all();
       return response()->json([
        'status'=>true,
        'posts'=>$post
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorPostRequest $request)
    {
        // dd($request->all());
        $post = Posts::create($request->all()); 
        return response()->json([
            'status'=>true,
            'message'=>'Post Created Successfully!',
            'posts'=>$post
           ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(StorPostRequest $request, Posts $post)
    {
        $post->update($request->all());
        return response()->json([
            'status'=>true,
            'message'=>'Post Updated Successfully!',
            'posts'=>$post
           ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        $post->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Post Delete Successfully!',
            // 'posts'=>$post
           ],200);
    }
}
