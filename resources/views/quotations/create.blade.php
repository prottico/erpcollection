<x-layouts.app>

    <div class="pagetitle">
        <h1>Cotizaciones</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('lawyers.index')}}">Cotaziones</a>
                </li>
                <li class="breadcrumb-item active">Nuevo</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Formulario de Cotización</h5>

            <form class="row g-3" method="POST" action="{{route('quotations.store')}}" enctype="multipart/form-data">
                @csrf @method('PATCH')
                <div class="col-md-4">
                    <label for="creditStartDate"
                        class="form-label @error('credit_start_date') text-danger fw-bold @enderror">Fecha de Inicio del
                        Crédito</label>
                    <div class="input-group @error('credit_start_date') text-danger @enderror">
                        {{-- <span class="input-group-text @error('credit_start_date') border border-danger @enderror">
                            <i class="bi bi-person @error('credit_start_date') text-danger @enderror"></i>
                        </span> --}}
                        <input id="creditStartDate" type="date"
                            class="form-control @error('credit_start_date') is-invalid @enderror"
                            name="credit_start_date" value="{{old('credit_start_date')}}">
                    </div>

                    @error('credit_start_date')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="debtCapital"
                        class="form-label  @error('debt_capital') text-danger fw-bold @enderror">Capital
                        Adeudado</label>
                    <div class="input-group @error('debt_capital') text-danger @enderror">
                        {{-- <span class="input-group-text @error('debt_capital') border border-danger @enderror">
                            <i class="bi bi-person @error('debt_capital') text-danger @enderror"></i>
                        </span> --}}
                        <input placeholder="Capital Adeudado" id="debtCapital" type="text"
                            class="form-control @error('debt_capital') is-invalid @enderror" name="debt_capital"
                            value="{{old('debt_capital')}}">
                    </div>

                    @error('debt_capital')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="term" class="form-label  @error('term') text-danger fw-bold @enderror">Plazo</label>
                    <div class="input-group @error('term') text-danger @enderror">
                        {{-- <span class="input-group-text @error('term') border border-danger @enderror">
                            <i class="bi bi-card-heading @error('term') text-danger @enderror"></i>
                        </span> --}}
                        <input placeholder="Plazo" id="term" type="text"
                            class="form-control @error('term') is-invalid @enderror" name="term"
                            value="{{old('term')}}">
                    </div>

                    @error('term')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="currentInterestRate"
                        class="form-label  @error('current_interest_rate') text-danger fw-bold @enderror">Tasa de
                        Interés Corriente</label>
                    <div class="input-group @error('current_interest_rate') text-danger @enderror">
                        {{-- <span
                            class="input-group-text @error('current_interest_rate') border border-danger @enderror">
                            <i class="bi bi-envelope @error('current_interest_rate') text-danger @enderror"></i>
                        </span> --}}
                        <input placeholder="Tasa de Interés Corriente" id="currentInterestRate" type="text"
                            class="form-control @error('current_interest_rate') is-invalid @enderror"
                            name="current_interest_rate" value="{{old('current_interest_rate')}}">
                    </div>

                    @error('current_interest_rate')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="defaultInterestRate"
                        class="form-label @error('default_interest_rate') text-danger fw-bold @enderror">Tasa de Interés
                        Moratoria</label>
                    <div class="input-group @error('default_interest_rate') text-danger @enderror">
                        {{-- <span
                            class="input-group-text @error('default_interest_rate') border border-danger @enderror">
                            <i class="bi bi-envelope @error('default_interest_rate') text-danger @enderror"></i>
                        </span> --}}
                        <input placeholder="Tasa de Interés Moratoria" id="defaultInterestRate" type="text"
                            class="form-control @error('default_interest_rate') is-invalid @enderror"
                            name="default_interest_rate" value="{{old('default_interest_rate')}}">
                    </div>

                    @error('default_interest_rate')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="interestOwed"
                        class="form-label @error('interest_owed') text-danger fw-bold @enderror">Intereses
                        Adeudados</label>
                    <div class="input-group @error('interest_owed') text-danger @enderror">
                        {{-- <span class="input-group-text @error('interest_owed') border border-danger @enderror">
                            <i class="bi bi-envelope @error('interest_owed') text-danger @enderror"></i>
                        </span> --}}
                        <input placeholder="Tasa de Interés Moratoria" id="interestOwed" type="text"
                            class="form-control @error('interest_owed') is-invalid @enderror" name="interest_owed"
                            value="{{old('interest_owed')}}">
                    </div>

                    @error('interest_owed')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="lastPaymentDay"
                        class="form-label @error('last_payment_day') text-danger fw-bold @enderror">Dia del último
                        pago</label>
                    <div class="input-group @error('last_payment_day') text-danger @enderror">
                        {{-- <span class="input-group-text @error('last_payment_day') border border-danger @enderror">
                            <i class="bi bi-person @error('last_payment_day') text-danger @enderror"></i>
                        </span> --}}
                        <input id="lastPaymentDay" type="date"
                            class="form-control @error('last_payment_day') is-invalid @enderror" name="last_payment_day"
                            value="{{old('last_payment_day')}}">
                    </div>

                    @error('last_payment_day')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="currency"
                        class="form-label @error('currency') text-danger fw-bold @enderror">Moneda</label>
                    <div class="input-group @error('currency') text-danger @enderror">
                        {{-- <span class="input-group-text @error('currency') border border-danger @enderror">
                            <i class="bi bi-person @error('currency') text-danger @enderror"></i>
                        </span> --}}
                        <input id="currency" type="text" placeholder="Moneda"
                            class="form-control @error('currency') is-invalid @enderror" name="currency"
                            value="{{old('currency')}}">
                    </div>

                    @error('currency')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="baseExecutionDocument"
                        class="form-label @error('base_execution_document') text-danger fw-bold @enderror">Documento
                        Base de Ejecucion</label>
                    <div class="input-group @error('base_execution_document') text-danger @enderror">
                        {{-- <span
                            class="input-group-text @error('base_execution_document') border border-danger @enderror">
                            <i class="bi bi-person @error('base_execution_document') text-danger @enderror"></i>
                        </span> --}}
                        <input id="base_execution_document" type="file"
                            class="form-control @error('base_execution_document') is-invalid @enderror"
                            name="base_execution_document" multiple value="{{old('base_execution_document')}}">
                    </div>

                    @error('base_execution_document')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="description"
                        class="form-label @error('description') text-danger fw-bold @enderror">Breve descripción del
                        caso</label>
                    <div class="input-group @error('description') text-danger @enderror">
                        {{-- <span class="input-group-text @error('description') border border-danger @enderror">
                            <i class="bi bi-person @error('description') text-danger @enderror"></i>
                        </span> --}}
                        {{-- <input id="description" type="file"
                            class="form-control @error('description') is-invalid @enderror" name="description"
                            value="{{old('description')}}"> --}}
                        <textarea placeholder="Agregue una breve descripción del caso..." name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>

                    @error('description')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type_payment_id" id="inlineRadio1"
                            value="1">
                        <label class="form-check-label" for="inlineRadio1">Cobro Judicial</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type_payment_id" id="inlineRadio2"
                            value="2">
                        <label class="form-check-label" for="inlineRadio2">Cobro Extrajudicial</label>
                    </div>

                    @error('type_payment_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="col-md-12">
                    <label for="comments"
                        class="form-label @error('comments') text-danger fw-bold @enderror">Comentarios</label>
                    <div class="input-group @error('comments') text-danger @enderror">
                        {{-- <span class="input-group-text @error('comments') border border-danger @enderror">
                            <i class="bi bi-person @error('comments') text-danger @enderror"></i>
                        </span> --}}
                        {{-- <input id="comments" type="file"
                            class="form-control @error('comments') is-invalid @enderror" name="comments"
                            value="{{old('comments')}}"> --}}
                        <textarea placeholder="Agregue una breve descripción del caso..." name="comments"
                            class="form-control @error('comments') is-invalid @enderror"
                            id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>

                    @error('comments')
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
