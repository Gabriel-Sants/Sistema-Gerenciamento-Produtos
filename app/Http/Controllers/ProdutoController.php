<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use Illuminate\Http\Request;



class ProdutoController extends Controller
{
    public readonly Produto $produto;

    public function __construct()
    {
        $this->produto = new Produto();
    }

    public function index()
    {
        $produtos = $this->produto->all();

        $valorTotal = $produtos->sum(function ($produto) {
            $preco = floatval(str_replace(',', '.', $produto->preco));
            return $produto->quantidade * $preco;
        });

        $qtdTotal = $produtos->sum('quantidade');


        $requisicaoAjax = request()->ajax();

        //Página Dinâmica 
        if ($requisicaoAjax) {
            return view('produtos.partials.index', compact('produtos', 'valorTotal', 'qtdTotal', 'requisicaoAjax'));
        }

        //Página Estática

        return view('produtos.index', compact('produtos', 'valorTotal', 'qtdTotal', 'requisicaoAjax'));
    }


    public function create()
    {
        $categorias = Categoria::all();

        $requisicaoAjax = request()->ajax();
        if ($requisicaoAjax) {
            return view('produtos.partials.create', compact('categorias', 'requisicaoAjax'));
        }

        return view('produtos.create', compact('categorias', 'requisicaoAjax'));
    }

    public function store(StoreProdutoRequest $request)
    {
        //validate utilizando StoreProdutoRequest em rules()
        $validated = $request->validated();
        $produto = Produto::create($validated);


        $requisicaoAjax = request()->ajax();

        if ($requisicaoAjax) {
            $produtos = Produto::with('categorias')->get();
            $valorTotal = $produtos->sum(fn($p) => $p->preco * $p->quantidade);
            $qtdTotal = $produtos->sum('quantidade');

            // Renderiza a tabela parcial
            $html = view('produtos.partials.index', compact('produtos', 'valorTotal', 'qtdTotal', 'requisicaoAjax'))->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'message' => 'Produto criado com sucesso!'
            ]);
        }

        return redirect()->route('produtos.index')->with('message', 'Produto criado com sucesso!');
    }

    public function show(Produto $produto)
    {
        //
    }


    public function edit(Produto $produto)
    {

        $requisicaoAjax = request()->ajax();
        if ($requisicaoAjax) {
            return view('produtos.partials.edit', compact('produto', 'requisicaoAjax'));
        }

        return view('produtos.edit', compact('produto', 'requisicaoAjax'));
    }

    public function update(UpdateProdutoRequest $request, Produto $produto)
    {

        $validated = $request->validated();
        $updated = $produto->update($validated);

        $requisicaoAjax = request()->ajax();

        if ($requisicaoAjax) {
            $produtos = Produto::with('categorias')->get();
            $valorTotal = $produtos->sum(fn($p) => $p->preco * $p->quantidade);
            $qtdTotal = $produtos->sum('quantidade');

            $html = view('produtos.partials.index', compact('produtos', 'valorTotal', 'qtdTotal', 'requisicaoAjax'))->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'message' => 'Produto atualizado com sucesso!'
            ]);
        }

        return redirect()->route('produtos.index')->with('message', 'Produto atualizado com sucesso!');
    }

    public function destroy(Request $request, Produto $produto)
    {
        $deleted = $produto->delete();
        $requisicaoAjax = request()->ajax();

        if ($deleted) {
            if ($requisicaoAjax) {
                $produtos = Produto::with('categorias')->get();
                $valorTotal = $produtos->sum(fn($p) => $p->preco * $p->quantidade);
                $qtdTotal = $produtos->sum('quantidade');

                $html = view('produtos.partials.index', compact('produtos', 'valorTotal', 'qtdTotal', 'requisicaoAjax'))->render();

                return response()->json([
                    'success' => true,
                    'html' => $html,
                    'message' => 'Produto excluído com sucesso!'
                ]);
            }

            return redirect()->route('produtos.index')->with('message', 'Produto excluído com sucesso!');
        }

        if ($requisicaoAjax) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir o produto!'
            ]);
        }

        return redirect()->back()->with('message', 'Erro ao excluir o produto!');
    }
}
