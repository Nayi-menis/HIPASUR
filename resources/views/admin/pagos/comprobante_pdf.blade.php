<!DOCTYPE html>
<html>
<head>
    <title>Comprobante de Pago #{{ $pago->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; text-transform: uppercase; }
        .section { margin-top: 15px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .footer { margin-top: 50px; text-align: center; }
        .signature { margin-top: 40px; display: inline-block; width: 200px; border-top: 1px solid #000; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Comprobante de Egreso de Caja</div>
        <div><strong>HIPASUR S.A.C.</strong></div>
        <div>Puno, Perú | Fecha de Emisión: {{ date('d/m/Y H:i') }}</div>
    </div>

    <div class="section">
        <table class="table">
            <tr>
                <th width="30%">NRO. TRANSACCIÓN:</th>
                <td># {{ str_pad($pago->id, 6, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <th>FECHA DE PAGO:</th>
                <td>{{ \Carbon\Carbon::parse($pago->fecha)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>BENEFICIARIO:</th>
                <td><strong>{{ $beneficiario }}</strong></td>
            </tr>
            @if($pago->recurso)
            <tr>
                <th>DNI TRABAJADOR:</th>
                <td>{{ $pago->recurso->dni }}</td>
            </tr>
            @elseif($pago->proveedor)
            <tr>
                <th>RUC PROVEEDOR:</th>
                <td>{{ $pago->proveedor->ruc }}</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="section">
        <table class="table">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>DESCRIPCIÓN</th>
                    <th>MONTO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $pago->descripcion }} ({{ $pago->tipo }})</td>
                    <td>S/. {{ number_format($pago->egreso, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <p><strong>INFORMACIÓN DE TRANSFERENCIA:</strong></p>
        <ul>
            <li><strong>Medio:</strong> {{ $pago->estado }}</li>
            <li><strong>Nro. Operación:</strong> {{ $pago->nro_operacion ?? 'N/A' }}</li>
            @if($pago->recurso)
                <li><strong>Cuenta Abono:</strong> {{ $pago->recurso->cuenta }}</li>
            @elseif($pago->proveedor)
                <li><strong>Banco / Cuenta:</strong> {{ $pago->proveedor->banco }} - {{ $pago->proveedor->nro_cuenta }}</li>
            @endif
        </ul>
    </div>

    <div class="footer">
        <div style="margin-top: 60px;">
            <div class="signature">Firma del Administrador</div>
            <div style="display: inline-block; width: 50px;"></div>
            <div class="signature">Firma del Beneficiario</div>
        </div>
    </div>
</body>
</html>