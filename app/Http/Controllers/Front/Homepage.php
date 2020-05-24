<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use  Validator;

//Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;

class Homepage extends Controller
{
    public function __construct()
    {
        if (Config::find(1)->active == 0) {
            return redirect()->to('site-offline')->send();
        }
        view()->share('pages', Page::orderBy('order', 'ASC')->whereStatus(1)->get());
        view()->share('categories', Category::where('status', 1)->inRandomOrder()->get());
        view()->share('config', Config::find(1));
    }

    public function index()
    {
        $data['articles'] = Article::with('getCategory')->where('status', 1)->whereHas('getCategory' , function ($query) {
            $query->where('status', 1);
        })->orderBy('created_at', 'DESC')->paginate(5);
        $data['articles']->withPath(url('page'));

        return view('front.homepage', $data);
    }

    public function single($category, $slug)
    {
        $category = Category::whereSlug($category)->first() ?? abort(403, 'No such category was found.');
        $article = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403, 'No such article was found.');
        $article->increment('hit');
        $data['article'] = $article;

        return view('front.single', $data);

    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403, 'No such category was found.');
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id', $category->id)->where('status',1)->orderBy('created_at', 'DESC')->paginate(3);

        return view('front.category', $data);

    }

    public function page($slug)
    {
        $page = Page::whereSlug($slug)->first() ?? abort(403, 'No such page was found.');
        $data['page'] = $page;
        return view('front.page', $data);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactpost(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required|min:10'
        ];
        $validate = Validator::make($request->post(), $rules);

        if ($validate->fails()) {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        Mail::send([], [], function ($message) use ($request) {
            $message->from('contact@thenorth.com', 'Emre SERPER');
            $message->to('emreserper81@hotmail.com');
            $message->setBody('From : ' . $request->name . '<br/>
             Mail : ' . $request->email . '<br/>
             Subject :' . $request->topic . '<br/>
             Message :' . $request->message . '<br/><br/>
             Message sent date : ' . now() . '', 'text/html');
            $message->subject($request->name . ' sent a message.');

        });
        //  $contact = new Contact;
        //  $contact->name = $request->name;
        //  $contact->email = $request->email;
        //  $contact->topic = $request->topic;
        //  $contact->message = $request->message;
        //  $contact->save();
        return redirect()->route('contact')->with('success', 'Your message has been sent to us. We thank you.');
    }
}
