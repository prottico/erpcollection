<x-layouts.app>

    <div class="pagetitle">
        <h1>Clientes</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Clientes</a>
                </li>
                <li class="breadcrumb-item active">Empresas</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header mb-2 fw-bold">
                    <div class="row mt-2 px-2">
                        <div class="col-md-9 col-sm-10 col-lg-11 col-xl-11">
                            <h5 class="card-title">Clientes Empresas</h5>
                        </div>
                        <div class="col-md-3 col-lg-1 col-xl-1 text-center">
                            <a href="{{ route('company.client.create') }}" role="button"
                                class="btn btn-primary w-lg-100">Nuevo</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($data) > 0)
                        <div class="table-responsive">
                            <table class="table table-responsive table-striped table-borderless datatable"
                                id="adminUsersTable">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Nombre Comercial</th>
                                        <th>Número Telefónico</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->comercial_name ? $item->comercial_name : '---- NA ----' }}
                                            </td>
                                            <td>
                                                {{ $item->phone }}
                                            </td>
                                            <td>
                                                {{ $item->email }}
                                            </td>
                                            <td class="row w-75">
                                                <div class="col-6">
                                                    <a href="{{route('company.client.show', $item->token)}}" role="button"
                                                        class="btn btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <form id=""
                                                        action="{{route('company.client.destroy', $item->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
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
