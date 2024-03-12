<x-layouts.app>

    <div class="pagetitle">
        <h1>Usuarios</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('clients.company.users.index') }}">{{ request()->user()->person->name }}</a>
                </li>
                <li class="breadcrumb-item active"> {{ $person->name }} </li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Usuario {{ $person->name }} </h5>

            <form class="row g-3" method="POST" action="{{ route('clients.company.users.update', $person->token) }}">
                @csrf @method('PATCH')
                <div class="col-md-6">
                    <label for="name"
                        class="form-label @error('name') text-danger fw-bold @enderror">Nombre(s)</label>
                    <div class="input-group @error('name') text-danger @enderror">
                        <span class="input-group-text @error('name') border border-danger @enderror">
                            <i class="bi bi-person @error('name') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Nombres..." id="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name', $person->name) }}">
                    </div>

                    @error('name')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="lastName"
                        class="form-label  @error('lastname') text-danger fw-bold @enderror">Apellido(s)</label>
                    <div class="input-group @error('lastname') text-danger @enderror">
                        <span class="input-group-text @error('lastname') border border-danger @enderror">
                            <i class="bi bi-person @error('lastname') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Apellidos..." id="lastName" type="text"
                            class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                            value="{{ old('lastname', $person->lastname) }}">
                    </div>

                    @error('lastname')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="identification"
                        class="form-label  @error('identification') text-danger fw-bold @enderror">Indentificación</label>
                    <div class="input-group @error('identification') text-danger @enderror">
                        <span class="input-group-text @error('identification') border border-danger @enderror">
                            <i class="bi bi-card-heading @error('identification') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Indentificación..." id="identification" type="text"
                            class="form-control @error('identification') is-invalid @enderror" name="identification"
                            value="{{ old('identification', $person->identification) }}">
                    </div>

                    @error('identification')
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
                            value="{{ old('phone', $person->phone) }}">
                    </div>

                    @error('phone')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label  @error('email') text-danger fw-bold @enderror">Correo
                        electrónico</label>
                    <div class="input-group @error('email') text-danger @enderror">
                        <span class="input-group-text @error('email') border border-danger @enderror">
                            <i class="bi bi-envelope @error('email') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Correo electrónico..." id="email" type="text"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email', $person->email) }}">
                    </div>

                    @error('email')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Cambiar contraseña de {{ $person->name }}</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-building"></i>
                        </span>
                        <input id="password" placeholder="Contraseña" type="password" class="form-control"
                            name="password">
                    </div>
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
