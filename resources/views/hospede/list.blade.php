<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Hóspedes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

    <a href="{{ url('/admin/dashboard') }}">
        <button class="btn btn-secondary mb-3">
            <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="15"> Voltar
        </button>
    </a>

    <h2 class="mb-4">Listagem de Hóspedes</h2>

    @if ($hospedes->isEmpty())
        <div class="alert alert-warning">Nenhum hóspede encontrado.</div>
    @else
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data Nasc.</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Cidade</th>
                    <th>Rua</th>
                    <th>Nº</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hospedes as $h)
                    <tr>
                        <td>{{ $h->id }}</td>
                        <td>{{ $h->nome }}</td>
                        <td>{{ $h->cpf }}</td>
                        <td>{{ date('d/m/Y', strtotime($h->data_nascimento)) }}</td>
                        <td>{{ $h->telefone }}</td>
                        <td>{{ $h->email }}</td>
                        <td>{{ $h->cidade }}</td>
                        <td>{{ $h->rua }}</td>
                        <td>{{ $h->numcasa }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
