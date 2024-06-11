<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::latest('id')->paginate();

        return view('admin.positions.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        Position::create($request->all());

        return redirect()->route('admin.positions.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {

        return view('admin.positions.edit',compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $position->update($request->all());
        return redirect()->route('admin.positions.index', $position);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
            // Eliminar el empleado
        $position->delete();

        // Redirigir de nuevo a la lista de empleados con un mensaje de éxito
        return redirect()->route('admin.positions.index')->with('success', 'Cargo eliminado correctamente');
    }
}
