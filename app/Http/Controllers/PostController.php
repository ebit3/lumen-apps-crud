<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Posts::all();

        return response()->json([
            'status' => true,
            'message' => "list semua post",
            'data' => $posts
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "title" => "required|string|max:20",
                "content" => "required|string|max:20"
            ]
        );

        if ($validator->fails()) {

            # code...
            return response()->json([
                'status' => 500,
                'message' => $validator->messages()
            ], 500);
        } else {

            # code...
            $post = Posts::create([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            if ($post) {

                # code...
                return response()->json([
                    'status' => 200,
                    'message' => "Tambah Data Berhasil",
                    'data' => $post
                ], 200);
            } else {

                # code...
                return response()->json([
                    'status' => 300,
                    'message' => "Tambah Data Gagal",
                ], 300);
            }
        }
    }

    public function show($id)
    {
        $post = Posts::find($id);

        if ($post) {

            # code...
            return response()->json([
                'status' => 200,
                'message' => "Data Berhasil Ditemukan",
                'data' => $post
            ], 200);
        } else {

            # code...
            return response()->json([
                'status' => 300,
                'message' => "Data Gagal Ditemukan",
            ], 300);
        }
    }

    public function update(Request $request, int $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                "title" => "required|string|max:20",
                "content" => "required|string|max:20"
            ]
        );

        if ($validator->fails()) {

            # code...
            return response()->json([
                'status' => 500,
                'message' => $validator->messages()
            ], 500);
        } else {

            # code...
            $post = Posts::find($id);

            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            if ($post) {

                # code...
                return response()->json([
                    'status' => 200,
                    'message' => "Ubah Data Berhasil",
                    'data' => $post
                ], 200);
            } else {

                # code...
                return response()->json([
                    'status' => 300,
                    'message' => "Ubah Data Gagal",
                ], 300);
            }
        }
    }

    public function destroy($id)
    {
        $post = Posts::find($id);

        if ($post) {

            # code...
            $post->delete();

            return response()->json([
                'status' => 200,
                'message' => "Hapus Data Berhasil",
                'data' => $post
            ], 200);
        } else {

            # code...
            return response()->json([
                'status' => 300,
                'message' => "Hapus Data Gagal",
            ], 300);
        } 
    }
}
