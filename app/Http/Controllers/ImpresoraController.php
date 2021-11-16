<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Impresora;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ImpresoraController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('impresoras_index'), 403);
        $impresoras = Impresora::paginate(5);
        return view('impresoras.index', compact('impresoras'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), 403);
        $ubicaciones = Ubicacion::all()->pluck('nombre', 'id');
        return view('impresoras.create', compact('ubicaciones'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|min:3|max:5',
        //     'username' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required'
        // ]);
        $impresora = Impresora::create($request->only('nombre', 'nombrered'));

        $ubicaciones = $request->input('ubicaciones', []);
        $impresora->ubicaciones()->sync($ubicaciones);
        return redirect()->route('impresoras.index', $impresora->id)->with('success', 'Impresora creada correctamente');
    }

    public function show(Impresora $user)
    {
        abort_if(Gate::denies('user_show'), 403);
        // $user = User::findOrFail($id);
        // dd($user);
        $user->load('roles');
        return view('users.show', compact('user'));
    }

    public function edit(Impresora $impresora)
    {
        abort_if(Gate::denies('user_edit'), 403);
        $ubicaciones = Ubicacion::all()->pluck('nombre', 'id');
        $impresora->load('ubicaciones');
        return view('impresoras.edit', compact('impresora', 'ubicaciones'));
    }

    public function update(Request $request, Impresora $impresora)
    {
        // $user=User::findOrFail($id);
        $data = $request->only('nombre', 'nombrered');
        // if(trim($request->password)=='')
        // {
        //     $data=$request->except('password');
        // }
        // else{
        //     $data=$request->all();
        //     $data['password']=bcrypt($request->password);
        // }

        $impresora->update($data);

        $ubicaciones = $request->input('ubicaciones', []);
        $impresora->ubicaciones()->sync($ubicaciones);
        return redirect()->route('impresoras.index', $impresora->id)->with('success', 'Impresora actualizada correctamente');
    }

    public function destroy(Impresora $impresora)
    {
        abort_if(Gate::denies('impresoras_index'), 403);

        //if (auth()->user()->id == $impresora->id) {
        //    return redirect()->route('impresoras.index');
        //}

        $impresora->delete();
        return back()->with('succes', 'Impresora eliminada correctamente');
    }
}
