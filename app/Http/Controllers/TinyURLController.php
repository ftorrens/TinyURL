<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTinyUrl;
use Illuminate\Support\Facades\Http;

class TinyURLController extends Controller
{
    function index(GetTinyUrl $request)
    {

        try {

            $url_api = env('URL_TINY_API', 'https://tinyurl.com/api-create.php');
            $response_api = Http::get($url_api . '?url=' . $request->url);

            return response()->json([
                'url' => $response_api->getBody()->getContents()
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong'
            ]);
        }
    }
}
