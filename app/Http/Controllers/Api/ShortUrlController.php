<?php

namespace App\Http\Controllers\Api;

use App\Models\ShortUrl;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShortUrlResource;
use Illuminate\Support\Facades\Validator;

class ShortUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shortUrls = $request->user()->shortUrls()->latest()->paginate(10)->onEachSide(1)->withQueryString();

        return ShortUrlResource::collection($shortUrls);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'main_url' => ['required', 'url', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 422);
        }

        $data = $validator->validated();

        $data['user_id'] = auth()->id();

        // Any long iteration, when it'll get any error
        try {
            // getting unique short path
            while (true) {
                $shortUrlPath = Str::random(random_int(3, 10));
                if (!ShortUrl::where('short_url_path', $shortUrlPath)->first()) {
                    $data['short_url_path'] = $shortUrlPath;
                    break;
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Something is wrong. Please, try again later!'], 422);
        }

        $shortUrl = ShortUrl::create($data);

        return new ShortUrlResource($shortUrl);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShortUrl $shortUrl)
    {
        if (auth()->id() != $shortUrl->user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $shortUrl->delete();

        return response()->json(['message' => 'Short URL deleted!']);
    }
}
