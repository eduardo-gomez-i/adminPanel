<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Documento;
use App\Models\Impresora;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('impresoras_index'), 403);
        $documentos = Documento::paginate(5);
        return view('documentos.index', compact('documentos'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), 403);
        $ubicaciones = Ubicacion::all()->pluck('nombre', 'id');
        return view('documentos.create', compact('ubicaciones'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|min:3|max:5',
        //     'username' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required'
        // ]);
        if ($request->file('archivo')) {
            $fileName = $request->archivo->getClientOriginalName();
            $filePath = $request->file('archivo')->storeAs('uploads', $fileName, 'public');

            $documento = new Documento();

            $documento->nombre = $request->nombre;
            //$documento->archivo = $request->file('archivo')->getClientOriginalName();
            $documento->archivo = '/storage/' . $filePath;
            $documento->save();

            //$documento = Impresora::create($request->only('nombre', 'archivo'));

            $ubicaciones = $request->input('ubicaciones', []);
            $documento->ubicaciones()->sync($ubicaciones);
            return redirect()->route('documentos.index', $documento->id)->with('success', 'Impresora creada correctamente');
        }
        
    }

    public function show(Impresora $user)
    {
        abort_if(Gate::denies('user_show'), 403);
        // $user = User::findOrFail($id);
        // dd($user);
        $user->load('roles');
        return view('users.show', compact('user'));
    }

    public function edit(Documento $documento)
    {
        abort_if(Gate::denies('user_edit'), 403);
        $ubicaciones = Ubicacion::all()->pluck('nombre', 'id');
        $documento->load('ubicaciones');
        return view('documentos.edit', compact('documento', 'ubicaciones'));
    }

    public function update(Request $request, Documento $documento)
    {
        // $user=User::findOrFail($id);
        //$data = $request->only('nombre', 'archivo');
        // if(trim($request->password)=='')
        // {
        //     $data=$request->except('password');
        // }
        // else{
        //     $data=$request->all();
        //     $data['password']=bcrypt($request->password);
        // }
        //$documento->update($data);

        if ($request->file('archivo')) {
            $documentoAnterior = str_replace('/storage/uploads/', '', $documento->archivo);
            Storage::disk('public')->delete('uploads/'.$documentoAnterior);
            $fileName = $request->archivo->getClientOriginalName();
            $filePath = $request->file('archivo')->storeAs('uploads', $fileName, 'public');

            $documento->nombre = $request->nombre;
            //$documento->archivo = $request->file('archivo')->getClientOriginalName();
            $documento->archivo = '/storage/' . $filePath;
            $documento->save();

            $ubicaciones = $request->input('ubicaciones', []);
            $documento->ubicaciones()->sync($ubicaciones);
            return redirect()->route('documentos.index', $documento->id)->with('success', 'Documento actualizado correctamente');
        }else {
            $documento->nombre = $request->nombre;
            $documento->save();

            $ubicaciones = $request->input('ubicaciones', []);
            $documento->ubicaciones()->sync($ubicaciones);
            return redirect()->route('documentos.index', $documento->id)->with('success', 'Documento actualizada correctamente');
        }

        
    }

    public function destroy(Documento $documento)
    {
        abort_if(Gate::denies('user_destroy'), 403);

        //if (auth()->user()->id == $impresora->id) {
        //    return redirect()->route('impresoras.index');
        //}

        $documento->delete();
        return back()->with('succes', 'Documento eliminado correctamente');
    }
}
