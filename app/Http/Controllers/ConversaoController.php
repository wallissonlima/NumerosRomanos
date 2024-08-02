<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conversao;

class ConversaoController extends Controller
{
   // Mapa de valores romanos
   private $romanoMap = [
    'M' => 1000,
    'CM' => 900,
    'D' => 500,
    'CD' => 400,
    'C' => 100,
    'XC' => 90,
    'L' => 50,
    'XL' => 40,
    'X' => 10,
    'IX' => 9,
    'V' => 5,
    'IV' => 4,
    'I' => 1
];

// Método para converter números reais para romanos
public function toRomano($numero)
{
    $romano = '';
    foreach ($this->romanoMap as $key => $value) {
        while ($numero >= $value) {
            $romano .= $key;
            $numero -= $value;
        }
    }
    return $romano;
}

// Método para converter números romanos para reais
public function toReal($romano)
{
    $numero = 0;
    foreach ($this->romanoMap as $key => $value) {
        while (strpos($romano, $key) === 0) {
            $numero += $value;
            $romano = substr($romano, strlen($key));
        }
    }
    return $numero;
}

// Método para armazenar uma conversão
public function store(Request $request)
{
    $validated = $request->validate([
        'numero_real' => 'required|integer|min:1'
    ]);

    $numero_real = $validated['numero_real'];
    $numero_romano = $this->toRomano($numero_real);

    $conversao = Conversao::create([
        'numero_real' => $numero_real,
        'numero_romano' => $numero_romano,
    ]);

    return response()->json($conversao, 201);
}

// Método para mostrar uma conversão específica
public function show($id)
{
    $conversao = Conversao::findOrFail($id);
    return response()->json($conversao);
}

// Método para converter números romanos para reais
public function convertRomano(Request $request)
{
    $validated = $request->validate([
        'numero_romano' => 'required|string'
    ]);

    $numero_romano = $validated['numero_romano'];
    $numero_real = $this->toReal($numero_romano);

    return response()->json(['numero_real' => $numero_real]);
}
}
