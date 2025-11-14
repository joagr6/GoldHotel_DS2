<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante de Reserva - Gold Hotel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #d4af37;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #d4af37;
            font-size: 28px;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header p {
            color: #666;
            font-size: 11px;
        }
        .comprovante-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }
        .info-section {
            margin-bottom: 25px;
        }
        .info-section h3 {
            background-color: #f5f5f5;
            padding: 8px;
            margin-bottom: 10px;
            font-size: 14px;
            color: #333;
            border-left: 4px solid #d4af37;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dotted #ddd;
        }
        .info-label {
            font-weight: bold;
            width: 40%;
        }
        .info-value {
            width: 60%;
            text-align: right;
        }
        .total-section {
            background-color: #f9f9f9;
            padding: 15px;
            margin-top: 30px;
            border: 2px solid #d4af37;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .total-label {
            font-weight: bold;
        }
        .total-value {
            font-weight: bold;
            color: #d4af37;
            font-size: 16px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 11px;
        }
        .status-ativa {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Gold Hotel</h1>
        <p>Comprovante de Reserva</p>
    </div>

    <div class="comprovante-title">
        COMPROVANTE DE RESERVA #{{ $reserva->id }}
    </div>

    <div class="info-section">
        <h3>Dados do Hóspede</h3>
        <div class="info-row">
            <span class="info-label">Nome:</span>
            <span class="info-value">{{ $reserva->hospede->nome }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">CPF:</span>
            <span class="info-value">{{ $reserva->hospede->cpf }}</span>
        </div>
        @if($reserva->hospede->email)
        <div class="info-row">
            <span class="info-label">E-mail:</span>
            <span class="info-value">{{ $reserva->hospede->email }}</span>
        </div>
        @endif
        @if($reserva->hospede->telefone)
        <div class="info-row">
            <span class="info-label">Telefone:</span>
            <span class="info-value">{{ $reserva->hospede->telefone }}</span>
        </div>
        @endif
    </div>

    <div class="info-section">
        <h3>Dados da Reserva</h3>
        <div class="info-row">
            <span class="info-label">Número da Reserva:</span>
            <span class="info-value">#{{ $reserva->id }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Data de Entrada:</span>
            <span class="info-value">{{ \Carbon\Carbon::parse($reserva->data_entrada)->format('d/m/Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Data de Saída:</span>
            <span class="info-value">{{ \Carbon\Carbon::parse($reserva->data_saida)->format('d/m/Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Número de Diárias:</span>
            <span class="info-value">{{ $dias }} {{ $dias == 1 ? 'diária' : 'diárias' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Status:</span>
            <span class="info-value">
                <span class="status-badge status-{{ strtolower($reserva->status) }}">
                    {{ ucfirst($reserva->status) }}
                </span>
            </span>
        </div>
        <div class="info-row">
            <span class="info-label">Data de Emissão:</span>
            <span class="info-value">{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</span>
        </div>
    </div>

    <div class="info-section">
        <h3>Dados do Quarto</h3>
        <div class="info-row">
            <span class="info-label">Tipo de Quarto:</span>
            <span class="info-value">{{ $reserva->quarto->tipoQuarto }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Capacidade:</span>
            <span class="info-value">{{ $reserva->quarto->capacidade }} pessoa(s)</span>
        </div>
        <div class="info-row">
            <span class="info-label">Valor da Diária:</span>
            <span class="info-value">R$ {{ number_format($reserva->quarto->valorDiaria, 2, ',', '.') }}</span>
        </div>
    </div>

    <div class="total-section">
        <div class="total-row">
            <span class="total-label">Valor Total da Reserva:</span>
            <span class="total-value">R$ {{ number_format($valorTotal, 2, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        <p><strong>Gold Hotel</strong></p>
        <p>Este é um comprovante gerado automaticamente pelo sistema.</p>
        <p>Em caso de dúvidas, entre em contato conosco.</p>
        <p style="margin-top: 10px;">Documento gerado em {{ \Carbon\Carbon::now()->format('d/m/Y \à\s H:i') }}</p>
    </div>
</body>
</html>

