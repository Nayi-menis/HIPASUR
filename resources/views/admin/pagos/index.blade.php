@extends('layouts.admin')

@section('content')
  <div class="row">
    <h1>Control de Finanzas - Puerto Belén</h1>
  </div>
  <hr>

  <div class="row">
      <div class="col-lg-4 col-6">
          <div class="small-box bg-success">
              <div class="inner">
                  <h3>S/. {{ number_format($total_ingresos, 2) }}</h3>
                  <p>Ingresos Totales</p>
              </div>
              <div class="icon"><i class="bi bi-cash-stack"></i></div>
          </div>
      </div>
      <div class="col-lg-4 col-6">
          <div class="small-box bg-danger">
              <div class="inner">
                  <h3>S/. {{ number_format($total_egresos, 2) }}</h3>
                  <p>Egresos Totales</p>
              </div>
              <div class="icon"><i class="bi bi-cart-dash"></i></div>
          </div>
      </div>
      <div class="col-lg-4 col-12">
          <div class="small-box bg-info">
              <div class="inner">
                  <h3>S/. {{ number_format($total_ingresos - $total_egresos, 2) }}</h3>
                  <p>Saldo Actual en Caja</p>
              </div>
              <div class="icon"><i class="bi bi-wallet2"></i></div>
          </div>
      </div>
  </div>

  <div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Historial de Movimientos</h3>
            <div class="card-tools">
              <a href="{{ url('admin/pagos/create') }}" class="btn btn-primary">
                Nuevo Registro
              </a>
            </div>
          </div>
          <div class="card-body">       
            <table id="example1" class="table table-striped table-hover table-sm table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th style="text-align: center"><b>Nro</b></th>
                    <th style="text-align: center"><b>Fecha</b></th>
                    <th style="text-align: center"><b>Concepto</b></th>
                    <th style="text-align: center"><b>Ingreso</b></th>
                    <th style="text-align: center"><b>Egreso</b></th>
                    <th style="text-align: center"><b>Acciones</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $contador = 1; ?>
                  @foreach ($pagos as $pago)
                      <tr>
                        <td style="text-align: center">{{ $contador++ }}</td>
                        <td style="text-align: center">{{ $pago->fecha->format('d/m/Y') }}</td>
                        <td>
                            <small class="badge badge-info">{{ $pago->tipo }}</small><br>
                            {{ $pago->descripcion }}
                        </td>
                        <td style="color: green; text-align: right">
                            {{ $pago->ingreso > 0 ? 'S/. '.number_format($pago->ingreso, 2) : '-' }}
                        </td>
                        <td style="color: red; text-align: right">
                            {{ $pago->egreso > 0 ? 'S/. '.number_format($pago->egreso, 2) : '-' }}
                        </td>
                            <td class="text-center">
                            <div class="btn-group" role="group">
                                {{-- Botón de imprimir con la ruta ya definida --}}
                                <a href="{{ route('admin.pagos.pdf', $pago->id) }}" target="_blank" class="btn btn-danger btn-sm">
                                    <i class="fas fa-file-pdf"></i> 
                                </a>
                                
                                <a href="{{ url('/admin/pagos/'.$pago->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ url('/admin/pagos/'.$pago->id.'/edit') }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ url('/admin/pagos', $pago->id) }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('¿Eliminar?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>

            <script>
                $(function () {
                    $("#example1").DataTable({
                        "pageLength": 5,
                        "language": {
                            "emptyTable": "No hay información",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Movimientos",
                            "infoEmpty": "Mostrando 0 a 0 de 0 Movimientos",
                            "infoFiltered": "(Filtrado de _MAX_ total Movimientos)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Movimientos",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscador:",
                            "zeroRecords": "Sin resultados encontrados",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        },
                        "responsive": true, "lengthChange": true, "autoWidth": false,
                        buttons: [
                            {
                                extend: 'collection',
                                text: 'Reportes',
                                orientation: 'landscape',
                                buttons: [
                                    { extend: 'copy', text: 'Copiar', title: 'HIPASUR_Reporte' },
                                    { 
                                        extend: 'pdf', 
                                        text: 'PDF', 
                                        title: 'HIPASUR_Reporte', 
                                        orientation: 'landscape',
                                        pageSize: 'A4',
                                        exportOptions: { columns: ':visible' }
                                    },
                                    { extend: 'csv', text: 'CSV', title: 'HIPASUR_Reporte' },
                                    { extend: 'excel', text: 'EXCEL', title: 'HIPASUR_Reporte' },
                                    { extend: 'print', text: 'Imprimir', title: 'HIPASUR_Reporte' }
                                ]
                            },
                            {
                                extend: 'colvis',
                                text: 'Visor de columnas',
                                collectionLayout: 'fixed three-column'
                            }
                        ],
                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                });

                function eliminar(id) {
                    Swal.fire({
                        title: '¿Eliminar registro?',
                        text: "Se descontará del saldo total.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                }
            </script>

           <script>
            $(function () {
                const ctx = document.getElementById('myChart').getContext('2d');
                
                // Gradientes para el diseño elegante
                const greenGrad = ctx.createLinearGradient(0, 0, 0, 400);
                greenGrad.addColorStop(0, 'rgba(40, 167, 69, 0.4)');
                greenGrad.addColorStop(1, 'rgba(40, 167, 69, 0)');

                const redGrad = ctx.createLinearGradient(0, 0, 0, 400);
                redGrad.addColorStop(0, 'rgba(220, 53, 69, 0.4)');
                redGrad.addColorStop(1, 'rgba(220, 53, 69, 0)');

                new Chart(ctx, {
                    type: 'line', 
                    data: {
                        labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Dic'],
                        datasets: [
                            {
                                label: 'Ingresos',
                                data: @json($ingresosMeses),
                                fill: true,
                                backgroundColor: greenGrad,
                                borderColor: '#28a745',
                                tension: 0.4, // Curva suave
                                borderWidth: 3,
                                pointRadius: 4
                            },
                            {
                                label: 'Egresos',
                                data: @json($egresosMeses),
                                fill: true,
                                backgroundColor: redGrad,
                                borderColor: '#dc3545',
                                tension: 0.4,
                                borderWidth: 3,
                                pointRadius: 4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        if (value >= 1000) return 'S/. ' + (value/1000) + 'k';
                                        return 'S/. ' + value;
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': S/. ' + context.raw.toLocaleString('es-PE', {minimumFractionDigits: 2});
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
          </div>
          </div>
    </div>

    <div class="col-md-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Comparativo Mensual</h3>
            </div>
            <div class="card-body">
                <canvas id="myChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
  </div>
@endsection

