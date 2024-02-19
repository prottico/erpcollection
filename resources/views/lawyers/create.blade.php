<x-layouts.app>

    <div class="pagetitle">
        <h1>Abogados</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('lawyers.index')}}">Abogados</a>
                </li>
                <li class="breadcrumb-item active">Nuevo</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Registro de Abogado</h5>
            <form class="row g-3">
                <div class="col-md-12">
                    <label for="inputName5" class="form-label">Your Name</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" class="form-control" id="inputName5">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail5" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" class="form-control" id="inputEmail5">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" class="form-control" id="inputPassword5">
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputAddress5" class="form-label">Address</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-house"></i>
                        </span>
                        <input type="text" class="form-control" id="inputAddress5" placeholder="1234 Main St">
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Address 2</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-building"></i>
                        </span>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-geo-alt"></i>
                        </span>
                        <input type="text" class="form-control" id="inputCity">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">State</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-map"></i>
                        </span>
                        <select id="inputState" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-zip"></i>
                        </span>
                        <input type="text" class="form-control" id="inputZip">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            <i class="bi bi-check-square"></i>
                            Check me out
                        </label>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check"></i>
                        Enviar
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="bi bi-arrow-return-left"></i>
                        Regresar
                    </button>
                </div>
            </form>

        </div>
    </div>

</x-layouts.app>
