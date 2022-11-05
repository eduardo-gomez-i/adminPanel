<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Documentos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_index'), 403);
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), 403);
        $roles = Role::all()->pluck('name', 'id');
        return view('users.create', compact('roles'));
    }

    public function store(UserCreateRequest $request)
    {
        // $request->validate([
            //     'name' => 'required|min:3|max:5',
            //     'username' => 'required',
            //     'email' => 'required|email|unique:users',
            //     'password' => 'required'
            // ]);
            if ($request->file('foto') != null) {
                $fileName = time().'_'. $request->foto->getClientOriginalName();
                $request->foto->move(public_path('images'), $fileName);

                $user = User::create($request->only('name', 'username', 'email', 'telefono', 'fecha_nacimiento', 'aficiones')
                + [
                    'password' => bcrypt($request->input('password')),
                ]+ ['foto' => $fileName]);
            }else {
            $user = User::create($request->only('name', 'username', 'email', 'telefono', 'fecha_nacimiento', 'aficiones')
                + [
                    'password' => bcrypt($request->input('password')),
                ]);
        }

        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        return redirect()->route('users.show', $user->id)->with('success', 'Usuario creado correctamente');
    }

    public function show(User $user)
    {
        $hoy = Carbon::today();
        $primerDia = Carbon::now()->startOfMonth();
        abort_if(Gate::denies('user_show'), 403);
        // $user = User::findOrFail($id);
        // dd($user);
        $user->load('roles');

        $comision = Documentos::select(DB::raw('SUM(ORISUBTOTAL1 + ORISUBTOTAL2) AS SUBTOTAL0'), DB::raw('SUM((ORISUBTOTAL1 + ORISUBTOTAL2) *.0035) AS COMISION'))
        ->leftJoin('per', 'doc.VENDEDORID', '=', 'per.PERID')
        ->where(function ($q) {
            $q->where('doc.TIPO', 'F')
            ->orWhere('doc.TIPO', 'N');
        })
        ->whereRaw("(INSTR(PER.CATEGORIA, 'EO')=0)")
        ->whereRaw("(INSTR(PER.CATEGORIA, 'JV')=0)")
        ->whereRaw("(INSTR(PER.CATEGORIA, 'C2')=0)")
        ->whereRaw("(INSTR(PER.CATEGORIA, 'AD')=0)")
        ->whereBetween('doc.FECHA', [$primerDia, $hoy])
        ->where('per.CATEGORIA', $user->username)
        ->first();
        
        return view('users.show', compact('user', 'comision'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), 403);
        $roles = Role::all()->pluck('name', 'id');
        $user->load('roles');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserEditRequest $request, User $user)
    {
        // $user=User::findOrFail($id);
        $data = $request->only('name', 'username', 'email', 'telefono', 'fecha_nacimiento', 'aficiones');
        $password=$request->input('password');
        if($password)
            $data['password'] = bcrypt($password);
            if ($request->file('foto') != null) {
                $fileName = time() . '_' . $request->foto->getClientOriginalName();
                $request->foto->move(public_path('images'), $fileName);
                $data['foto'] = $fileName;
            }
        // if(trim($request->password)=='')
        // {
        //     $data=$request->except('password');
        // }
        // else{
        //     $data=$request->all();
        //     $data['password']=bcrypt($request->password);
        // }

        $user->update($data);

        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        return redirect()->route('users.show', $user->id)->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_destroy'), 403);

        if (auth()->user()->id == $user->id) {
            return redirect()->route('users.index');
        }

        $user->delete();
        return back()->with('succes', 'Usuario eliminado correctamente');
    }
}
