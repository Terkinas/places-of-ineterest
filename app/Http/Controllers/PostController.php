<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::all();

        return response()->json([
            'posts' => $posts
        ]);
    }

    public function indexArray($locationId)
    {
        // $path = public_path() . '/storage/images/location/' . $location;
        // return Response::download($path);

        $posts = Post::select('id', 'image_name', 'image_title')->where('location_id', $locationId)->get();
        $url = Storage::url('images/location/lietuva/091659-image-XFRy8f71jH.jpg');
        return response()->json([
            'posts' => $posts,
        ]);
    }

    public function indexAdmin(Request $request)
    {

        if (auth()->user()->email != 'admin@gmail.com') {
            return response()->json([
                'status' => 'unauthorized'
            ]);
        }
        $posts = Post::all();

        return ['posts' => $posts];

        return response()->json([
            'status' => 'successful',
            'posts' => $posts
        ]);
    }




    public function store(Request $request)
    {
        Log::debug($request->hasFile('photo'));
        Log::debug($request->title);
        if ($request->hasFile('photo')) {

            function generateRandomString($length = 10)
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }


            $randName = generateRandomString(10);
            $file = $request->file('photo');
            $filename = $file->getClientOriginalExtension();
            $finalName = date('His')  . '-image-' . $randName . '.jpg';

            $filepath = $file->storeAs('/images/location/' . 'lietuva', $finalName, 'public');
            Log::debug('this is the path: ' . $filepath);

            Post::create([
                'image_name' => $finalName,
                'image_title' => $request->title,
                'image_path' => $filepath,
                'location_id' => $request->locationId,
                'user_id' => $request->user()->id
            ]);

            return response()->json([
                'status' => 'successfully stored image',
            ]);
        }

        return response()->json([
            'status' => 'successful'
        ]);
    }

    public function delete($id, Request $request)
    {


        if (auth()->user()->email == 'admin@gmail.com') {

            $post = Post::find($id);
            $post->delete();

            $posts = Post::all();

            return response()->json([
                'status' => 'successfully deleted',
                'posts' => $posts,
                'id' => $id
            ]);
        }
        if (auth()->user()) {

            $post = Post::where('id', $id)->where('user_id', auth()->user()->id)->first();
            $post->delete();

            $posts = Post::all();

            return response()->json([
                'posts' => $posts,
                'status' => 'successfully deleted',
            ]);
        }

        return response()->json([
            'posts' => [],
            'status' => 'unauthenticated',
        ]);
    }

    public function personal(Request $request)
    {
        $posts = Post::where('user_id', $request->user()->id)->get();

        return response()->json([
            'posts' => $posts
        ]);
    }
}
