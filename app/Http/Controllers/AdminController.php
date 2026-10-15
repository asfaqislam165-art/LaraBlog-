<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addpost()
    {
        return view('admin.add_post');
    }

    public function createpost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $post = new Post();

        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img'), $imagename);

            $post->image = $imagename;
        }

        $post->user_name = Auth::user()->name;
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect()
            ->route('admin.addpost')
            ->with('status', 'Added Successfully');
    }

    public function allpost()
    {
        $post = Post::all();

        return view('admin.allpost', compact('post'));
    }

    public function updatePost(int $id)
    {
        $post = Post::findOrFail($id);

        return view('admin.updatepost', compact('post'));
    }

    public function postupdate(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img'), $imagename);

            $post->image = $imagename;
        }

        $post->user_name = Auth::user()->name;
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect()
            ->route('admin.allpost')
            ->with('status', 'Updated Successfully');
    }

        
    public function deletePost($id){
        $post = Post::findOrFail($id);
        $post->delete();
         return redirect()
            ->route('admin.allpost')
            ->with('status', 'Deleted Successfully');
    }


}