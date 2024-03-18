<x-layouts.app>

    <div class="pagetitle">
        <h1>Clientes</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('company.client.index') }}">Empresas</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ $client->comercial_name ? $client->comercial_name : $client->name }} </li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detalle de Cliente
                {{ $client->comercial_name ? $client->comercial_name : $client->name }}</h5>

            <form class="row g-3" method="POST" action="{{ route('company.client.update', $client) }}">
                @csrf @method('PATCH')
                <div class="col-md-4">
                    <label for="physicalClient"
                        class="form-label @error('identity_type_id') text-danger fw-bold @enderror">Cliente
                        Físico</label>
                    <div class="input-group  @error('identity_type_id') text-danger @enderror">
                        <span class="input-group-text  @error('identity_type_id') border border-danger @enderror">
                            <i class="bi bi-map  @error('identity_type_id') text-danger @enderror"></i>
                        </span>

                        <select name="identity_type_id"
                            class="form-select @error('identity_type_id') border border-danger @enderror"
                            id="">
                            <option value="">Seleccione</option>
                            @foreach ($identityTypes as $identityType)
                                <option value="{{ $identityType->id }}"
                                    {{ old('identity_type_id', $client->person ? $client->identity_type_id : null) == $identityType->id
                                        ? 'selected'
                                        : '' }}>
                                    {{ $identityType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @error('identity_type_id')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="identification"
                        class="form-label  @error('identification') text-danger fw-bold @enderror">Indentificación</label>
                    <div class="input-group @error('identification') text-danger @enderror">
                        <span class="input-group-text @error('identification') border border-danger @enderror">
                            <i class="bi bi-card-heading @error('identification') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Indentificación..." id="identification" type="text"
                            class="form-control @error('identification') is-invalid @enderror" name="identification"
                            value="{{ old('identification', $client->identification) }}">
                    </div>

                    @error('identification')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="name"
                        class="form-label @error('name') text-danger fw-bold @enderror">Nombre</label>
                    <div class="input-group @error('name') text-danger @enderror">
                        <span class="input-group-text @error('name') border border-danger @enderror">
                            <i class="bi bi-person @error('name') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Nombres..." id="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name', $client->name) }}">
                    </div>

                    @error('name')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="comercialName"
                        class="form-label  @error('comercial_name') text-danger fw-bold @enderror">Nombre
                        comercial</label>
                    <div class="input-group @error('comercial_name') text-danger @enderror">
                        <span class="input-group-text @error('comercial_name') border border-danger @enderror">
                            <i class="bi bi-person @error('comercial_name') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Nombre comercial..." id="comercialName" type="text"
                            class="form-control @error('comercial_name') is-invalid @enderror" name="comercial_name"
                            value="{{ old('comercial_name', $client->comercial_name) }}">
                    </div>

                    @error('comercial_name')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label @error('phone') text-danger fw-bold @enderror">Número
                        Telefónico</label>
                    <div class="input-group @error('phone') text-danger @enderror">
                        <span class="input-group-text @error('phone') border border-danger @enderror">
                            <i class="bi bi-envelope @error('phone') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Número Telefónico..." id="phone" type="text"
                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone', $client->phone) }}">
                    </div>

                    @error('phone')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="email" class="form-label  @error('email') text-danger fw-bold @enderror">Correo
                        electrónico</label>
                    <div class="input-group @error('email') text-danger @enderror">
                        <span class="input-group-text @error('email') border border-danger @enderror">
                            <i class="bi bi-envelope @error('email') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Correo electrónico..." id="email" type="text"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email', $client->email) }}">
                    </div>

                    @error('email')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="border-top border-4 mt-4"></div>

                <div class="col-md-12">
                    <h6 class="card-title">Responsable de Empresa</h5>
                </div>

                <div class="col-md-6">
                    <label for="responsibleName"
                        class="form-label  @error('responsible_name') text-danger fw-bold @enderror">Nombres
                        del Responsable</label>
                    <div class="input-group @error('responsible_name') text-danger @enderror">
                        <span class="input-group-text @error('responsible_name') border border-danger @enderror">
                            <i class="bi bi-envelope @error('responsible_name') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Nombres del Responsable" id="responsibleName" type="text"
                            class="form-control @error('responsible_name') is-invalid @enderror"
                            name="responsible_name" value="{{ old('responsible_name', $responsible->name) }}">
                    </div>

                    @error('responsible_name')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="responsibleLastname"
                        class="form-label  @error('responsible_lastname') text-danger fw-bold @enderror">Apellidos
                        del Responsable</label>
                    <div class="input-group @error('responsible_lastname') text-danger @enderror">
                        <span class="input-group-text @error('responsible_lastname') border border-danger @enderror">
                            <i class="bi bi-envelope @error('responsible_lastname') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Apellidos del responsable" id="responsibleLastname" type="text"
                            class="form-control @error('responsible_lastname') is-invalid @enderror"
                            name="responsible_lastname"
                            value="{{ old('responsible_lastname', $responsible->lastname) }}">
                    </div>

                    @error('responsible_lastname')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="responsibleEmail"
                        class="form-label  @error('responsible_email') text-danger fw-bold @enderror">Email
                        del Responsable</label>
                    <div class="input-group @error('responsible_email') text-danger @enderror">
                        <span class="input-group-text @error('responsible_email') border border-danger @enderror">
                            <i class="bi bi-envelope @error('responsible_email') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Correo del responsable" id="responsibleEmail" type="text"
                            class="form-control @error('responsible_email') is-invalid @enderror"
                            name="responsible_email" value="{{ old('responsible_email', $responsible->email) }}">
                    </div>

                    @error('responsible_email')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="responsiblePassword"
                        class="form-label @error('responsible_password') text-danger fw-bold @enderror">Cambiar
                        contraseña
                        del responsable</label>
                    <div class="input-group @error('responsible_password') text-danger @enderror">
                        <span class="input-group-text @error('responsible_password') border border-danger @enderror">
                            <i class="ri ri-key-2-line @error('responsible_password') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Contraseña del responsable" id="responsiblePassword" type="password"
                            class="form-control @error('responsible_password') is-invalid @enderror"
                            name="responsible_password" value="{{ old('responsible_password') }}">
                    </div>

                    @error('responsible_password')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>



                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check"></i>
                        Enviar
                    </button>
                    <button type="reset" class="btn btn-danger">
                        <i class="bi bi-arrow-return-left"></i>
                        Regresar
                    </button>
                </div>
            </form>

        </div>
    </div>

</x-layouts.app>
