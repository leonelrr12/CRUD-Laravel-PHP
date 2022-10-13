<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['empleados']=Empleado::paginate(2);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'nombre' =>'required|string|max:100',
            'apellido_paterno' =>'required|string|max:100',
            'apellido_materno' =>'required|string|max:100',
            'email' =>'required|email',
            'foto' =>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required' =>'El :attribute es requerido.',
            'foto.required' =>'La foto es requerida.',
        ];

        $this->validate($request, $campos, $mensaje);

        #$datos=request()->all();
        $datos=request()->except('_token'); 

        if($request->hasFile('foto')){
            $datos['foto']=$request->file('foto')->store('uploads', 'public');
        }

        Empleado::insert($datos);
        #return response()->json($datos);
        return redirect('empleado')->with('mensaje','Empleado agregado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        $edit=true;
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'nombre' =>'required|string|max:100',
            'apellido_paterno' =>'required|string|max:100',
            'apellido_materno' =>'required|string|max:100',
            'email' =>'required|email',
        ];
        $mensaje=[
            'required' =>'El :attribute es requerido.',
        ];

        if($request->hasFile('foto')){
            $campos=['foto' =>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['foto.required' =>'La foto es requerida.',];
        }
        $this->validate($request, $campos, $mensaje);

        $empleado=request()->except(['_token', '_method']);
        
        if($request->hasFile('foto')){
            $img=Empleado::findOrFail($id);
            Storage::delete('public/'.$img->foto);
            $empleado['foto']=$request->file('foto')->store('uploads', 'public');
        }
        
        Empleado::where('id','=',$id)->update($empleado);
        $edit=True;
        return redirect('empleado')->with('mensaje', 'Empleado actualizado!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img=Empleado::findOrFail($id);
        Storage::delete('public/'.$img->foto);
        Empleado::destroy($id);

        return redirect('empleado')->with('mensaje', 'Empleado eliminado!!!');
    }
}
