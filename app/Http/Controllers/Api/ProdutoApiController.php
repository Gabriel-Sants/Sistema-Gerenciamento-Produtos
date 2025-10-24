<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use Illuminate\Http\Request;

class ProdutoApiController extends Controller
{
    public function index()
    {
        return response()->json(Produto::all());
    }

    public function store(StoreProdutoRequest $request)
    {
        $produto = Produto::create($request->validated());
        return response()->json($produto, 201);
    }
    
    public function show(Produto $produto)
    {
        return response()->json($produto);
    }

    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        $produto->update($request->validated());
        return response()->json([$produto, 'message' => 'Produto atualizado com sucesso']);
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->json(['message' => 'Produto deletado com sucesso']);
    }
}
 