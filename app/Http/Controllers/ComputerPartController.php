<?php

namespace App\Http\Controllers;

use App\Models\ComputerPart;
use Illuminate\Http\Request;

class ComputerPartController extends Controller
{
    // 3. Público: Listar todas las piezas
    public function index()
    {
        return response()->json(ComputerPart::all(), 200);
    }

    // 4. Público: Ver una sola pieza
    public function show($id)
    {
        $part = ComputerPart::find($id);
        if (!$part) {
            return response()->json(['message' => 'Part not found'], 404);
        }
        return response()->json($part, 200);
    }

    // 5. Privado: Crear una nueva pieza (Requiere Token)
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'brand' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $part = ComputerPart::create($fields);
        return response()->json($part, 201);
    }

    // 6. Privado: Borrar una pieza (Requiere Token)
    public function destroy($id)
    {
        $part = ComputerPart::find($id);
        if (!$part) {
            return response()->json(['message' => 'Part not found'], 404);
        }
        $part->delete();
        return response()->json(['message' => 'Part deleted successfully'], 200);
    }
}