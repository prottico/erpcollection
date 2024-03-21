<x-layouts.app>

    <x-layouts.partials.breadcrum :title="'Usuarios'" :route="'admin.users.index'" :itemActive="'Nuevo'"/>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Registro de Usuario</h5>
            <x-user.create-form :sendRoute="'admin.users.store'"/>
        </div>
    </div>


</x-layouts.app>
