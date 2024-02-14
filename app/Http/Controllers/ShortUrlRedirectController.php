<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;

class ShortUrlRedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ShortUrl $shortUrl)
    {
        // updated short url click count
        $shortUrl->increment('click_count');

        return redirect()->away($shortUrl->main_url);
    }
}
