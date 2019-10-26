<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;

class ApiController extends Controller
{

    public function show_token() {
        return csrf_token(); 
  
      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status'=>'ok','data'=>Rol::all()], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rol = Rol::create($request->all());

        return response()->json($rol, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
		$rol=Rol::find($id);

		
		if (!$rol)
		{
		
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
		}

		return response()->json(['status'=>'ok','data'=>$rol],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rol=Rol::find($id);
        $rol->rol = $request->rol;
        $rol->descripcion = $request->descripcion;

       if($rol->save()){
           return response()->json($rol, 200);
       }else{

        return response()->json("error", 404);

       }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Rol::where('id', $id)->exists()) {
        $rol = Rol::find($id);
        $rol->delete();

        return response()->json([
          "message" => "Eliminado"
        ], 202);
      } else {
        return response()->json([
          "message" => "Rol no encontrado"
        ], 404);
      }
    }
}
