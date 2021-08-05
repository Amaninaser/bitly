<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function index()
    {
        $shortLinks = ShortLink::Click(10)->get();
        return view('das',[
            'short_links' =>  $shortLinks,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
           'url_link' => 'required|url'
        ]);
        $input['url_link'] = $request->url_link;
        $input['code'] = Str::random(8);
        $input['user_id'] = Auth::user()->id;
        ShortLink::create($input);  
        return redirect('shorten-link')
             ->with('success', 'Shorten Link Generated Successfully!');

    }
    public function shortenLink($code)
    {
        $find = ShortLink::where('code', $code)->first();
        $find->increment('count');
        return redirect($find->url_link);
    }
}
