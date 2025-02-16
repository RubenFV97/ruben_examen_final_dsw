<?php

namespace App\Http\Controllers;

use App\Models\DesaTrainer;
use Illuminate\Http\Request;
use App\Http\Requests\DesaRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateDesaRequest;

class DESAController extends Controller
{
    public function index()
    {
        $datos = DesaTrainer::all();
        return view('admin.desa.index', compact('datos'));
    }

    public function show($id)
    {
        $datos = DesaTrainer::findOrFail($id);

        return view('admin.desa.show', compact('datos'));
    }

    public function destroy($id)
    {
        $desaTrainer = DesaTrainer::find($id);

        if (!$desaTrainer) {
            return redirect()->route('desa.index')->with('error', 'El dispositivo no existe.');
        }

        $desaTrainer->delete();
        return redirect()->route('desa.index')->with('success', 'DESA Trainer eliminado correctamente.');
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('admin.desa.create');
    }

    // Almacenar un nuevo DesaTrainer
    public function store(DesaRequest $request)
    {
        $data = $request->validated();
        $desa = DesaTrainer::create($data);

        $fileName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        $filePath = $request->file('image')->storeAs('images', $fileName, 'public');

        $desa->update([
            "image" => $filePath
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('desa.index')->with('success', 'Desa Trainer creado exitosamente');
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        $desaTrainer = DesaTrainer::findOrFail($id);
        return view('admin.desa.update', compact('desaTrainer'));
    }

    // Actualizar un DesaTrainer
    public function update(UpdateDesaRequest $request, $id)
    {
        // Validación de los datos
        $data = $request->validated();

        // Buscar el DesaTrainer a actualizar
        $desaTrainer = DesaTrainer::findOrFail($id);

        // Manejar la actualización de imagen
        if (isset($data["image"])) { // Ajuste de 'imagen' a 'image'
            // Eliminar la imagen anterior si existe
            if ($desaTrainer->image) {
                Storage::delete($desaTrainer->image);
            }

            $fileName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('images', $fileName, 'public');   
            

        }

        $desaTrainer->update(
            [
                "name" => $data['name'],
                "model" => $data['model'],
                "description" => $data['description'],
                "settings" => 'null',
                "image" => isset($data["image"]) ? $imagePath : $desaTrainer->image
            ]
        );

        // Redirigir con mensaje de éxito
        return redirect()->route('desa.index')->with('success', 'Desa Trainer actualizado exitosamente');
    }

    public function editButtons($id)
    {
        
    $desaTrainer = DesaTrainer::find($id);

    return view('admin.desa.editButtons', compact('desaTrainer'));
    }
    
}
