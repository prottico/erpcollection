<x-layouts.app>

    <div class="pagetitle">
        <h1>Clientes</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('company.client.index')}}">Empresas</a>
                </li>
                <li class="breadcrumb-item active">Nuevo</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Registro de Cliente Empresa</h5>

            <form class="row g-3" method="POST" action="{{route('company.client.store')}}">
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
                            class="form-select @error('identity_type_id') border border-danger @enderror" id="">
                            <option value="">Seleccione</option>
                            @foreach($identityTypes as $it)
                            <option value="{{ $it->id}}" {{ old('identity_type_id')==$it->id ? 'selected' : '' }}>
                                {{ $it->name }}
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
                            value="{{old('identification')}}">
                    </div>

                    @error('identification')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="name" class="form-label @error('name') text-danger fw-bold @enderror">Nombre</label>
                    <div class="input-group @error('name') text-danger @enderror">
                        <span class="input-group-text @error('name') border border-danger @enderror">
                            <i class="bi bi-person @error('name') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Nombres..." id="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{old('name')}}">
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
                            value="{{old('comercial_name')}}">
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
                            value="{{old('phone')}}">
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
                            value="{{old('email')}}">
                    </div>

                    @error('email')
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
