<x-layouts.app>

    <div class="pagetitle">
        <h1>Cotizaciones</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Cotizaciones</a>
                </li>
                <li class="breadcrumb-item active">Todas</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header mb-2 fw-bold">
                    <div class="row mt-2 px-2">
                        <div class="col-md-9 col-sm-10 col-lg-11 col-xl-11">
                            <h5 class="card-title">Listado de Cotizaciones</h5>
                        </div>
                        @role('independent-client|general-admin')
                            <div class="col-md-3 col-lg-1 col-xl-1 text-center">
                                <a href="{{ route('quotations.create') }}" role="button"
                                    class="btn btn-primary w-lg-100">Nuevo</a>
                            </div>
                        @endrole
                    </div>
                </div>
                <div class="card-body">
                    @if (count($data) > 0)
                        <div class="table-responsive">
                            <table class="table table-responsive table-borderless datatable" id="adminUsersTable">
                                <thead>
                                    <tr>
                                        <th title="Cliente">Cliente</th>
                                        <th title="Codigo">Código</th>
                                        <th title="Fecha de Inicio de crédito">Fecha Inicio</th>
                                        <th title="Plazo">Plazo</th>
                                        <th title="Tasa de Interés corriente">Tasa Int. Corriente</th>
                                        <th title="Tasa de Interés moratoria">Tasa Int. Moratoria</th>
                                        <th title="Interés adeudado">Interés adeudado</th>
                                        <th title="Día del último pago">Últ. Pago</th>
                                        <th title="Acciones">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>
                                                {{ $item->client->person->name }}
                                            </td>
                                            <td>
                                                {{ $item->code }}
                                            </td>

                                            <td>
                                                {{ \Carbon\Carbon::parse($item->credit_start_date)->format('d-m-Y') }}
                                                {{-- {{ $item->credit_start_date->format('d-m-Y')}} --}}
                                            </td>
                                            <td>
                                                {{ $item->term }}
                                                {{-- {{ \Carbon\Carbon::parse($item->term)->format('d-m-Y') }} --}}
                                            </td>
                                            <td>
                                                {{ $item->current_interest_rate }}
                                            </td>
                                            <td>
                                                {{ $item->default_interest_rate }}
                                            </td>
                                            <td>
                                                {{ $item->interest_owed }}
                                            </td>
                                            <td>

                                                {{ \Carbon\Carbon::parse($item->last_payment_day)->format('d-m-Y') }}
                                                {{-- {{ $item->last_payment_day->format('d-m-Y') }} --}}
                                            </td>

                                                <td class="row">
                                                    @role('independent-client')
                                                        <div class="col-4 p-0 px-md-1">
                                                            <a href="{{ route('quotations.show', $item->token) }}"
                                                                role="button" class="btn btn-info"><i
                                                                    class="bi bi-eye"></i></a>
                                                        </div>
                                                    @endrole

                                                    @role('general-admin')
                                                        <div class="col-4 p-0 px-md-1">
                                                            <a href="{{ route('quotations.show', $item->token) }}"
                                                                role="button" class="btn btn-info"><i
                                                                    class="bi bi-eye"></i></a>
                                                        </div>

                                                        <div class="col-4 p-0 px-md-1">
                                                            <a href="{{ route('quotations.edit', $item->token) }}"
                                                                role="button" class="btn btn-warning"><i
                                                                    class="bi bi-pencil"></i></a>
                                                        </div>

                                                        <div class="col-4 p-0 px-md-1">
                                                            <form id="deleteForm"
                                                                action="{{ route('quotations.destroy', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endrole

                                                </td>
                                            @role('lawyer')
                                                <td class="row">
                                                    <div class="col-4 p-0 px-md-1">
                                                        <a href="{{ route('lawyers.quotations.show', $item->token) }}"
                                                            role="button" class="btn btn-info"><i
                                                                class="bi bi-eye"></i></a>
                                                    </div>

                                                    <div class="col-4 p-0 px-md-1">
                                                        <a href="{{ route('lawyers.quotations.edit', $item->token) }}"
                                                            role="button" class="btn btn-warning"><i
                                                                class="bi bi-pencil"></i></a>
                                                    </div>
                                                </td>
                                            @endrole
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h4>No hay datos</h4>
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
