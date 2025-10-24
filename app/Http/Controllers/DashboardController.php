<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\User;


class DashboardController extends Controller
{
  
    public function index()
    {
        $totalProdutos = Produto::count();
        $totalCategorias = Categoria::count();
        $totalUsers = User::count();

        return view('dashboard', compact('totalProdutos', 'totalCategorias', 'totalUsers'));
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

  
    public function show(string $id)
    {
        //
    }

  
    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

   
    public function destroy(string $id)
    {
        //
    }
}
