<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;

class SpecialtyController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('specialties.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'name' => 'required|min:3'
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar el nombre.',
            'name.min' => 'Como minimo el nombre debe tener 3 caracteres.',
        ];
        $this->validate($request, $rules, $messages);

        $specialty = new Specialty();
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save();

        $notification = 'La especialidad se ha registrado correctamente.';
        return redirect('/specialties')->with(compact('notification'));
    }

    public function edit(Specialty $specialty)
    {
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $rules = [
            'name' => 'required|min:3'
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar el nombre.',
            'name.min' => 'Como minimo el nombre debe tener 3 caracteres.',
        ];
        $this->validate($request, $rules, $messages);

        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save();

        $notification = 'La especialidad se ha actualizado correctamente.';
        return redirect('/specialties')->with(compact('notification'));
    }

    public function destroy(Specialty $specialty)
    {
        $notification = 'La especialidad ' . $specialty->name . ' se ha eliminado correctamente.';
        $specialty->delete();
        return redirect('/specialties')->with(compact('notification'));
    }
}
