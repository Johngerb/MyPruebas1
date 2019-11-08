<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
 

class WebServiceController extends Controller
{
    public $client;

    public function __construct()
    {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://jsonplaceholder.typicode.com/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
    }

    public function obtener_post()
    {
        $response= $this->client->request('GET','posts');
        $posts=json_decode($response->getBody()->getContents());
        
        return view ('administracion.posts.index',compact('posts'));
    }

    public function buscar_post($id)
    {
       $url_Final = 'posts/'.$id;

       $response= $this->client->request('GET',$url_Final);
       $post=json_decode($response->getBody()->getContents());
       return view ('administracion.posts.post',compact('post'));
    }

    public function mostrar_formulario()
    {
       
       return view ('administracion.posts.formulario');
    }


    public function guardar_post(Request $request)
    {
        $valores= response()->json($request->all());
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => $valores
           ]; 

        $response =  $this->client->post('/posts', $options);

        dd(json_decode($response->getBody()->getContents()));
    }

    public function mostrar_formulario2()
    {
       
       return view ('administracion.posts.formulario_actualizar');
    }


    public function actualizar_post(Request $request){
        $id_post = $request->id;

        $valores= response()->json($request->all());

        $url= 'posts/'.$id_post;
      

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => $valores
           ]; 

        $response =  $this->client->put($url, $options);

        dd(json_decode($response->getBody()->getContents()));




    }


}

