<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @role('general-admin')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('lawyers.index')}}">
                <i class="bi bi-people"></i>
                <span>Abogados</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person"></i><span>Clientes</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('company.client.index')}}">
                        <i class="bi bi-circle"></i><span>Clientes Empresa</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('independent.client.index')}}">
                        <i class="bi bi-circle"></i><span>Clientes Independientes</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Icons Nav -->
        @endrole

        @role('general-admin')
        <li class="nav-heading">Cotizaciones</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('quotations.index')}}">
                <i class="bi bi-coin"></i>
                <span>Cotizaciones</span>
            </a>
        </li>

        @endrole

        @role('independent-client')
        <li class="nav-heading">Cotizaciones</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('clients.quotations.index')}}">
                <i class="bi bi-coin"></i>
                <span>Cotizaciones</span>
            </a>
        </li>

        @endrole

        @role('lawyer')
        <li class="nav-heading">Cotizaciones</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('lawyers.quotations.index')}}">
                <i class="bi bi-coin"></i>
                <span>Cotizaciones</span>
            </a>
        </li>

        @endrole

    </ul>

</aside><!-- End Sidebar-->
