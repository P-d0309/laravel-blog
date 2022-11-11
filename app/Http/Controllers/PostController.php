<?php

namespace App\Http\Controllers;

use App\Models\Post;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $posts = Post::query()->where('user_id', auth()->user()->id);
            return DataTables::of($posts)
            ->editColumn('text', function($data) {
                return trim_string($data->text, 50);
            })
            ->addColumn('action', function($data){
                return "
                <a class='btn btn-sm btn-primary m-1 edit' href='".route('post.edit', $data->id)."'>
                    <i class='fas fa-pen pr-0'></i>
                </a>
                <button class='btn btn-sm btn-danger m-1 delete' data-id='$data->id'>
                    <i class='fas fa-trash-alt pr-0'></i>
                </button>";
            })
            ->rawColumns(['action'])
            ->make();
        }

        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function destroy(Post $post) {
        $post->delete();
        return Response::json(['status' => 'success']);
    }
}
