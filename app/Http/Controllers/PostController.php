<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $form_data  = $request->validate([
            "message" => ["required", "max:255", "string"],
            "image" => ["required", "image"]
        ]);

        if ($request->hasFile("image")) {
            $image = $request->file("image");
            $extension = $image->getClientOriginalExtension();
            $filename = Str::random(40) . "." . $extension;
            $imageURL = $image->storeAs("public/postImages",  $filename);
            $form_data["image"] = Storage::url($imageURL);
        }

        $post = Post::create($form_data);

        return redirect("/");
    }
}
