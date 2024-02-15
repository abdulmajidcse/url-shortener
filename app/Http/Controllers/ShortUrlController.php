<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['shortUrls'] = auth()->user()->shortUrls()->latest()->paginate(10)->onEachSide(1)->withQueryString();

        return view('shorturl.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shorturl.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'main_url' => ['required', 'url', 'max:1000'],
        ]);

        $validateData['user_id'] = auth()->id();

        // Any long iteration, when it'll get any error
        try {
            // getting unique short path
            while (true) {
                $shortUrlPath = Str::random(random_int(3, 10));
                if (!ShortUrl::where('short_url_path', $shortUrlPath)->first()) {
                    $validateData['short_url_path'] = $shortUrlPath;
                    break;
                }
            }
        } catch (\Throwable $th) {
            return back()->withInput()->with('error_message', 'Something is wrong. Please, try again later!');
        }

        ShortUrl::create($validateData);

        return redirect()->route('shorturls.index')->with('success_message', 'Short URL Generated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShortUrl $shortUrl)
    {
        abort_if(auth()->id() != $shortUrl->user_id, 403);

        $shortUrl->delete();

        return back()->with('success_message', 'Short URL deleted!');
    }
}
