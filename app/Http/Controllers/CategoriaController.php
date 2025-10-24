<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;

class CategoriaController extends Controller
{
    public readonly Categoria $categoria;

    public function __construct()
    {
        $this->categoria = new Categoria();
    }


    public function index()
    {

        $categorias = $this->categoria
            ->withCount('produtos')
            ->with('produtos')
            ->get();

        $qtdTotal = $categorias->sum('produtos_count');

        if (request()->ajax()) {
            return view('categorias.partials.index', compact('categorias', 'qtdTotal'));
        }

        return view('categorias.index', compact('categorias', 'qtdTotal'));
    }


    public function create() {}


    public function store(StoreCategoriaRequest $request)
    {
        //
    }


    public function show(Categoria $categoria)
    {
        //
    }


    public function edit(Categoria $categoria)
    {
        //
    }


    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        //
    }


    public function destroy(Categoria $categoria)
    {
        //
    }
}
