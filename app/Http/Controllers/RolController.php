<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Rol;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::where('estado',1)->orderBy('id')->get();
         return View('administracion.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('administracion.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**dd($request); paara revisar los valores de la variable **/

        Rol::create([
            'rol' =>  $request->rol,
            'descripcion' =>  $request->descripcion,
            'fecha_registro' =>  $request->fecha_registro,
      
        
        ]);

        return Redirect::to('administracion/roles')->with('mensaje-registro', 'Registrado Correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nuevo_id= Crypt::decrypt($id);
        $rol = Rol::find($nuevo_id);
        
        return view('administracion.roles.edit',compact('rol'));
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
        $rol = Rol::find($id);

        $rol->fill([

            'rol' =>  $request->rol,
            'descripcion' => $request->descripcion,
            'fecha_registro' => $request->fecha_registro,

       ]);

           
       if($rol->save()){
        return Redirect::to('administracion/roles')->with('mensaje-registro', 'Registro Actualizado Correctamente');
       }
       else{
        return Redirect::to('administracion/roles')->with('mensaje-error', 'Error--');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $rol = Rol::find($id);
        $rol->estado = 0;
        $rol->save();

        DB::table('user_rol')->where('rol_id', $rol->id)->delete();

        $message = "Eliminado Correctamente";
        if ($request->ajax()) {
            return response()->json([
               
                'message' => $message
            ]);
        }
    }
    
  //
  public function roles_ajax(Request $request)
  {
          $roles = Rol::where('estado',1)->get();
          // esto es igual a  select * from rol where estado =1
          //tambien se puede hacer DB::select("select * from rol where estado =1")

          
          return Datatables::of($roles)
                  ->addIndexColumn() //obligatorio
                  ->setRowId('id')
            
                  ->addColumn('accion', function($row){

                    $id_encriptado= Crypt::encrypt($row->id);  
                    $url = route('roles.edit',['parameters' => $id_encriptado]);
 
                         $btn = '<a title="Editar" style="cursor:pointer;" href="'.$url. '" role="button"><i class="fa fa-edit"></i></a> <a title="Eliminar" style="cursor:pointer;"   onclick="eliminar_rol('.$id_encriptado.')" class="btn-delete" role="button"><i class="fa fa-trash"></i></a>';
   
                          return $btn;
                  })
                  ->rawColumns(['accion'])
                  ->make(true);
  }



}
