<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('order', 'ASC')->get();
        return view('back.pages.index', compact('pages'));
    }

    public function orders(Request $request)
    {
        foreach ($request->get('page') as $key => $order) {
            Page::where('id', $order)->update(['order' => $key]);
        }
    }

    public function create()
    {
        return view('back.pages.create');
    }

    public function update($id)
    {
        $page = Page::findOrFail($id);
        return view('back.pages.update', compact('page'));
    }

    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'image|mimes:jpeg,png,jpg|max:5120'
        ]);

        $page = Page::findOrFail($id);
        $page->title = $request->input('title');
        $page->content = $request->input('content');
        $page->slug = Str::slug($request->title);
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = asset('uploads/') . '/' . $imageName;
        }
        $page->save();
        toastr()->success('The Page was updated successfully.');
        return redirect()->route('admin.page.index');
    }

    public function post(Request $request)
    {
        $last = Page::orderBy('order', 'DESC')->first();
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ]);
        $page = new Page;
        $page->title = $request->input('title');
        $page->content = $request->input('content');
        $page->order = $last->order + 1;
        $page->slug = Str::slug($request->title);
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = asset('uploads/') . '/' . $imageName;
        }
        $page->save();
        toastr()->success('The Page was created successfully.');
        return redirect()->route('admin.page.index');


    }

    public function delete($id)
    {
        $page = Page::find($id);
        if (File::exists($page->image)) {
            File::delete(public_path($page->image));
        }
        $page->delete();
        toastr()->success('Page successfully deleted');
        return redirect()->route('admin.page.index');
    }


    public function switch(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->status = $request->statu == "true" ? 1 : 0;
        $page->save();
    }
}
