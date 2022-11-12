<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use ApiResponseHelpers;
    public function index() : JsonResponse
    {
        $posts = Post::where('status', 'publised')->with('Auther')->get()->toArray();

        return $this->respondWithSuccess($posts);
    }

    public function userPosts() : JsonResponse
    {
        $posts = Post::where(['status' =>  'publised', 'user_id' => auth()->user()->id])->get()->toArray();

        return $this->respondWithSuccess($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'text' => 'required',
            'description' => 'required',
            'file' => 'nullable|image',
            'status' => ['required', Rule::in(['publised','unpublised','draft','archieve'])],
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return validationErrorResponse($validator->messages());
		};

        $post = Post::create([
            'text' => $request->text,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => auth()->user()->id
        ]);

        if($request->file) {
            $extension = $request->file->guessExtension();

            $pathFolder = Str::random(30);
            $pathFolder = "images/posts/$pathFolder";

            File::makeDirectory($pathFolder, 0777, true, false);

            Image::make($request->file)->resize(350, 150)->save("$pathFolder/350x150.$extension");
            Image::make($request->file)->resize(1600,800)->save("$pathFolder/1600x800.$extension");
            $post->thumbnail = "$pathFolder/350x150.$extension";
            $post->file = "$pathFolder/1600x800.$extension";
            $post->file_type = "image";
            $post->save();
        }
        return $this->respondWithSuccess($post);
    }

    public function show($id)
    {
        $post = Post::where(['status' => 'publised', 'id' => $id])->with('Auther')->first();

        if($post) {
            return $this->respondWithSuccess($post);
        } else {
            return $this->respondNotFound("Post not found.");
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'text' => 'required',
            'description' => 'required',
            'file' => 'nullable|image',
            'status' => ['required', Rule::in(['publised','unpublised','draft','archieve'])],
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
			return validationErrorResponse($validator->messages());
		};

        $post = Post::where(['user_id' => auth()->user()->id, 'id' => $id])->first();

        if($post) {
            $post->text = $request->text ? $request->text : $post->text;
            $post->description = $request->description ? $request->description : $post->description;
            $post->status = $request->status ? $request->status : $post->status;
            if($request->file) {
                $extension = $request->file->guessExtension();

                $pathFolder = Str::random(30);
                $pathFolder = "images/posts/$pathFolder";

                File::makeDirectory($pathFolder, 0777, true, false);

                Image::make($request->file)->resize(350, 150)->save("$pathFolder/350x150.$extension");
                Image::make($request->file)->resize(1600,800)->save("$pathFolder/1600x800.$extension");
                $post->thumbnail = "$pathFolder/350x150.$extension";
                $post->file = "$pathFolder/1600x800.$extension";
                $post->file_type = "image";
                $post->save();
            }
            $post->save();
            return $this->respondWithSuccess($post);

        } else {
            return $this->respondNotFound("Post not found.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where(['user_id' => auth()->user()->id, 'id' => $id])->first();
        if($post) {
            $post->delete();
            return $this->respondWithSuccess();
        } else {
            return $this->respondNotFound("Post not found.");
        }
    }
}
