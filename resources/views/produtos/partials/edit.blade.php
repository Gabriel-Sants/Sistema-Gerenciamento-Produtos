@include('produtos.partials.form', [
    'title' => "Editar - $produto->titulo",
    'action' => route('produtos.update', ['produto' => $produto->id]),
    'produto' => $produto
])

