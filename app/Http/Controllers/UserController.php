<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Pdf\TemplatePDF;

class UserController extends Controller
{

    public readonly User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $users = $this->user->all();

        $qtdTotal = $users->count();

        if (request()->ajax()) {
            return view('users.partials.index', compact('users', 'qtdTotal'));
        }

        return view('users.index', compact('users', 'qtdTotal'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        //
    }

    public function exportarPdf()
    {
        $users = User::orderBy('name')->get();
        $headers = ['ID', 'Nome', 'Email', 'Criado em'];
        $mesReferencia = "Outubro/2025";

        $data = $users->map(fn($user) => [
            $user->id,
            $user->name,
            $user->email,
            $user->created_at ? $user->created_at->format('d/m/Y') : ''

        ])->toArray();


        $pdf = new TemplatePDF("Relatório de Usuários", $headers, $mesReferencia, $data);
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->renderTable($headers, $data);

        $pdf->Output('I', 'usuarios.pdf');
    }
}
