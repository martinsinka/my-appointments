<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::doctors()->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'dni' => 'nullable|digits:8',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:6'
        ];
        $this->validate($request, $rules);

        User::create(
            $request->only('name', 'email', 'dni', 'address', 'phone')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->input('password')),
            ]
        );

        $notification = 'El medico se ha registrado correctamente.';
        return redirect('/doctors')->with(compact('notification'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);
        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'dni' => 'nullable|digits:8',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:6'
        ];
        $this->validate($request, $rules);

        $user = User::doctors()->findOrFail($id);
        $data = $request->only('name', 'email', 'dni', 'address', 'phone');
        $password = $request->input('password');
        if ($password)
            $data['password'] = bcrypt($password);
        $user->fill($data);
        $user->save();

        $notification = 'La informacion del medico se ha actualizado correctamente.';
        return redirect('/doctors')->with(compact('notification'));
    }

    public function destroy(User $doctor)
    {
        $notification = 'El medico ' . $doctor->name . ' ha sido eliminado correctamente.';
        $doctor->delete();
        return redirect('/doctors')->with(compact('notification'));
    }
}
