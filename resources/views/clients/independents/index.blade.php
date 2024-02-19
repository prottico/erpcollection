<x-layouts.app>

    <div class="pagetitle">
        <h1>Clientes</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Clientes</a>
                </li>
                <li class="breadcrumb-item active">Independientes</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header mb-2 fw-bold">
                    <div class="row mt-2 px-2">
                        <div class="col-md-9 col-sm-10 col-lg-11 col-xl-11">
                            <h5>Clientes Independientes</h5>
                        </div>
                        <div class="col-md-3 col-lg-1 col-xl-1 text-center">
                            <a href="{{route('independent.client.create')}}" role="button"
                                class="btn btn-primary w-lg-100">Nuevo</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($data) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless datatable" id="adminUsersTable">
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Número Telefónico</th>
                                    <th>Email</th>
                                    <th>Compañia asociada</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>
                                        {{$item->person->name}}
                                    </td>
                                    <td>
                                        {{$item->person->lastname}}
                                    </td>
                                    <td>
                                        {{$item->person->phone}}
                                    </td>
                                    <td>
                                        {{$item->person->email}}
                                    </td>
                                    <td>
                                        {{$item->person->associated_company}}
                                    </td>
                                    <td>
                                        <a href="#" role="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                    </td>
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
