<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Redirect;
use App\Rol;
use App\User;
use App\UserRol;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $usuarios = User::where('estado',1)->orderBy('id')->get();
         return View('administracion.usuarios.index',compact('usuarios'));
    }

    public function buscar_cedula_usuario(Request $request)
    {
       if($request->ajax()){
          
           $cedula=$request->cedula;
           $usuarios = User::where('cedula', $cedula)->get();
       
                if(count($usuarios) > 0) {
      
                   return response()->json("existe");
    
                }else{

                 return response()->json("no_existe");

                }
           } 


       }

       
       public function buscar_email_usuario(Request $request)
       {
   
           if($request->ajax()){
             
               $email=$request->email;

               $usuarios= User::where('email', $email)->get();
               if(count($usuarios) > 0) {
                return response()->json("existe");
    
               }else{
              
                return response()->json("no_existe");
    
               }
    
               
    
           }
   
   
       
   
       }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::where('estado',1)->orderBy('id')->get();
        return view('administracion.usuarios.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $imagen = $request->file('path');
        $imagen->move(public_path('imagenes'), $imagen->getClientOriginalName());
        

       $usuario= User::create([
            'name' =>  $request->name,
            'apellidos' =>  $request->apellidos,
            'cedula' =>  $request->cedula,
            'edad' =>  $request->edad,
            'path' =>  $imagen->getClientOriginalName(),
            'email' =>  $request->email,
            'password' =>  Hash::make($request->password),
      
        
        ]);

        $total_roles = $request->roles;
        //si tiene roles
            if (isset($total_roles )) {
                foreach($total_roles as $roles){
                    UserRol::create([
                        'user_id'=>$usuario->id,
                        'rol_id'=>$roles,
                    ]);
                }
        

            }

        return Redirect::to('administracion/usuarios')->with('mensaje-registro', 'Se registró Correctamente');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function usuarios_ajax(Request $request)
  {
          $usuarios = User::where('estado',1)->get();
          // esto es igual a  select * from rol where estado =1
          //tambien se puede hacer DB::select("select * from rol where estado =1")

          
          return Datatables::of($usuarios)
                  ->addIndexColumn() //obligatorio
                  ->setRowId('id')
            
                  ->addColumn('accion', function($row){

                      $url = route('usuarios.edit',['parameters' => $row->id]);
 
                         $btn = '<a title="Editar" style="cursor:pointer;" href="'.$url. '" role="button"><i class="fa fa-edit"></i></a> <a title="Eliminar" style="cursor:pointer;"   onclick="eliminar_usuario('.$row->id.')" class="btn-delete" role="button"><i class="fa fa-trash"></i></a>';
   
                          return $btn;
                  })
                  ->rawColumns(['accion'])
                  ->make(true);
  }

}
