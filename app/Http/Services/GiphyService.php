<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Support\Facades\Http;

final class GiphyService
{
    public function test()
    {
        try {
            $response = Http::get('https://api.giphy.com/v1/gifs/search?api_key=6YvFOX3wVmdsl5z6Uj8e8k0HnbTXGu8K&q=hello&limit=25&offset=0&rating=g&lang=en&bundle=messaging_non_clips');

            if ($response->failed()) {
                throw new Exception($response->json()['message']);
            }

            return response()->json([
                'data' => (($response->json() && $response->object()) ? $response->object()->data : null),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function testGif()
    {
        try {
            $giphyUrlBase = config('app.GIPHY_API_URL');
            $endpoint = 'search';
            $params = [
                'api_key' => config('app.GIPHY_API_KEY'),
                'q' => 'hello',
                'limit' => 25,
                'offset' => 0,
                'rating' => 'g',
                'lang' => 'en',
                'bundle' => 'messaging_non_clips',
            ];
            //$url = $giphyUrlBase . $endpoint . '?api_key=' . $giphyApiKey . '&q=' . $search . '&limit=' . $limit . '&offset=' . $offset . '&rating=' . $rating . '&lang=' . $lang . '&bundle=' . $bundle;
            //https://api.giphy.com/v1/gifs/search?api_key=6YvFOX3wVmdsl5z6Uj8e8k0HnbTXGu8K&q=hello&limit=25&offset=0&rating=g&lang=en&bundle=messaging_non_clips
            //https://api.giphy.com/v1/gifs/search?api_key=uobS7xQ2OtYPsLTShXW0Ebma2DcQZ5Or&q=dificil&limit=1&offset=1&rating=g&lang=en&bundle=messaging_non_clips
            $response = Http::get($giphyUrlBase . $endpoint, $params);

            if ($response->failed()) {
                throw new Exception($response->json()['message']);
            }

            if ($response && $response->object()) {
                if ($response->object() && $response->object()->data) {
                    foreach ($response->object()->data as $gif) {
                        echo '<image src="' . $gif->images->original->url . '" style="margin=10px;">';
                    }
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function searchGif($request)
    {
        try {
            $giphyUrlBase = env('GIPHY_API_URL', 'https://api.giphy.com/v1/gifs/');
            $endpoint = 'search';
            $params = [
                'api_key' => env('GIPHY_API_KEY'),
                'q' => $request['query'],
                'limit' => $request['limit'],
                'offset' => $request['offset'],
                'rating' => 'g',
                'lang' => 'es',
                'bundle' => 'messaging_non_clips',
            ];

            $response = Http::get($giphyUrlBase . $endpoint, $params);

            if ($response->failed()) {
                throw new Exception($response->json()['message']);
            }

            $result = (($response->json() && $response->object()) ? $response->object()->data : null);            

            return $result;
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $giphyUrlBase . $endpoint.' -- '.$th->getMessage(),
            ], 500);
        }
    }

    public function searchGifById($request)
    {
        try {
            $giphyUrlBase = config('app.GIPHY_API_URL');
            $endpoint = $request['gif_id'];
            $params = [
                'api_key' => config('app.GIPHY_API_KEY'),                
                'rating' => 'g',
            ];

            $response = Http::get($giphyUrlBase . $endpoint, $params);

            if ($response->failed()) {
                throw new Exception($response->json()['message']);
            }

            return response()->json([
                'data' => (($response->json() && $response->object()) ? $response->object()->data : null),
                'meta' => (($response->json() && $response->object()) ? $response->object()->meta : null),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
