<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
        //print_r($request->post());

        $isExist = Category::whereSlug(Str::slug($request->category))->first();
        if ($isExist) {
            toastr()->error($request->category . ' | This category already exists');
            return redirect()->back();
        }

        $request->validate([
            'name' => 'min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ]);
        $category = new Category();
        $category->name = $request->category;
        $category->slug = Str::slug($request->category);

        if ($request->hasFile('image')) {

            $imageName = Str::slug($request->category) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $category->image = asset('uploads/') . '/' . $imageName;
        }
        $category->save();
        toastr()->success('The category was created successfully.');
        return redirect()->back();

    }

    public function update(Request $request)
    {
        //print_r($request->post());

        $isName = Category::whereName($request->category)->whereNotIn('id', [$request->id])->first();
        if ($isName) {
            toastr()->error($request->category . ' | This category already exists');
            return redirect()->back();
        }

        $request->validate([
            'name' => 'min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);
        $category = Category::find($request->id);
        $category->name = $request->category;
        $category->slug = Str::slug($request->category);
        if ($request->hasFile('image') && $request->file('image') != null) {

            $imageName = Str::slug($request->category) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $category->image = asset('uploads/') . '/' . $imageName;
        }
        $category->save();
        toastr()->success('The category was updated successfully.');
        return redirect()->back();

    }

    public function delete(Request $request){
        $category = Category::findOrFail($request->id);
        $defaultCategory = Category::find(1);
        if($category->id==1){
            toastr()->error('This category cannot be deleted.');
            return redirect()->back();
        }
        $allArticle = Article::withTrashed()->where('category_id',$category->id);
        $allArticles = Article::withTrashed()->where('category_id',$category->id)->get();
        $count = $category->articleCount();
        $message = '';
        if($count > 0 ){
            $allArticle->update(['category_id'=>1]);
            $message = '' . $count . ' Articles belonging to this category have been moved to the ' . $defaultCategory->name . ' category.';
        }elseif ($count==0 and count($allArticles)>0) {
            $allArticle->update(['category_id'=>1]);
        }
        $category->delete();
        toastr()->success($message, 'Category deleted successfully', ['timeOut' => 4000]);
        return redirect()->back();
    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }

    public function switch(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->statu == "true" ? 1 : 0;
        $category->save();
    }
}
