<?php

namespace App\Http\Controllers;
use App\Models\Receta;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //Crear el constructor para evitar que entren sin autenticacion
    public function __construct()
    {
        $this->middleware('auth',['except'=>'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //Obtener recetas con paginacion
        $recetas=Receta::where('user_id',$perfil->user_id)->paginate(2);

        return view('perfiles.show',compact('perfil','recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize('view',$perfil); //Para que no puedan ver el recuado de edit de otros usuarios
        return view('perfiles.edit',compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //Ejecutar el policy
        $this->authorize('update',$perfil);
        //Validar
        $data=request()->validate([
            'nombre'=>'required',
            'url'=>'required',
            'biografia'=>'required'
        ]);

        //Revisar imagenes
        if($request['imagen']){
            $ruta_imagen=$request['imagen']->store('upload-perfiles','public');

            //Resize de la imagen
            $img=Image::make(public_path("storage/{$ruta_imagen}"))->fit(600,600);
            $img->save();
            $array_imagen=['imagen'=>$ruta_imagen];
            
        }
        //Asignar nombre y url
        auth()->user()->url=$data['url'];
        auth()->user()->name=$data['nombre'];
        auth()->user()->save();

        //Eliminar url y name porque causan problemas en la siguiente insercion
        unset($data['url']);
        unset($data['nombre']);
        //Asiganar biografia e imagen
        auth()->user()->perfil()->update(array_merge(
            $data,$array_imagen ?? []
        ));
   
        //Redireccionar
        return redirect()->action([RecetaController::class,'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
