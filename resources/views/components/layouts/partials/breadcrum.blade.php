<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav class="mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ $route }}">{{auth()->user()->hasRole('general-admin') ? 'Usuarios' : request()->user()->person->name}}</a>
            </li>
            <li class="breadcrumb-item active">{{ $itemActive }}</li>
        </ol>
    </nav>
</div>
