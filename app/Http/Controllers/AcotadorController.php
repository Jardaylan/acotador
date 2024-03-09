<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcotadorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $domain;

    public function __construct()
    {
        $this->domain = 'https://acotadorlink/';
    }

    /**
     * Codificar urls link acotado
     */

    public function encode(Request $request){

        if (!$this->esUrlValida($request->link)) {
            return response()->json(['error' => 'La URL proporcionada no es valida'], 400);
        }

        $token = uniqid();

        $result = DB::table('acotador')->insert([
            'url_link' => $request->link,
            'token' => $token,
        ]);

        $url = $this->domain . $token;

        return response()->json(['type' => 'success', 'message' => $url], 200);


    }

    /**
     * Decodificar urls
     */

    public function decode(Request $request){

        $token = str_replace($this->domain, '', $request->url);

        $token = DB::table('acotador')
                    ->where('token', $token)
                    ->value('url_link');
        
        if (!$token) {
            return response()->json(['error' => 'Url no encontrada'], 400);
        }

        return response()->json(['type' => 'success', 'message' => $token], 200);
    }

    private function esUrlValida($url)
    {
        $parsedUrl = parse_url($url);

        // Verificar que la URL (http o https) y un host
        return isset($parsedUrl['scheme']) && in_array($parsedUrl['scheme'], ['http', 'https']) &&
               isset($parsedUrl['host']);
    }
}
