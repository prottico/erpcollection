<x-layouts.app>

    <div class="pagetitle">
        <h1>Cotizaciones</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('quotations.index') }}">Cotizaciones</a>
                </li>
                <li class="breadcrumb-item active"> {{ $quotation->client->person->name }} - {{ $quotation->code }}</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Cotización <strong>{{ $quotation->code }}</strong></h5>

            <form class="row g-3" method="POST" action="{{ route('lawyers.quotations.update', $quotation->token) }}"
                enctype="multipart/form-data">
                @csrf @method('PATCH')

                <div class="col-md-12">
                    <label for="tipo_pago" class="mb-2"><strong>Tipo de Cobro</strong></label> <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" disabled @if ($quotation->type_payment_id == 1) checked @endif
                            type="radio" name="type_payment_id" readonly id="inlineRadio1" value="1">
                        <label class="form-check-label text-dark" for="inlineRadio1">Cobro Judicial</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input disabled class="form-check-input" @if ($quotation->type_payment_id == 2) checked @endif
                            type="radio" name="type_payment_id" id="inlineRadio2" value="2">
                        <label class="form-check-label" for="inlineRadio2">Cobro Extrajudicial</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input disabled class="form-check-input" @if ($quotation->type_payment_id == 3) checked @endif
                            type="radio" name="type_payment_id" id="inlineRadio2" value="2">
                        <label class="form-check-label" for="inlineRadio2">Estudio de
                            Factibilidad</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="creditStartDate"
                        class="form-label @error('credit_start_date') text-danger fw-bold @enderror"><strong>Fecha de
                            Inicio del
                            Crédito</strong></label>
                    <div class="input-group @error('credit_start_date') text-danger @enderror">
                        <span class="input-group-text @error('credit_start_date') border border-danger @enderror">
                            <i class="bi bi-calendar-date @error('credit_start_date') text-danger @enderror"></i>
                        </span>
                        <input id="creditStartDate" type="date" readonly
                            class="form-control @error('credit_start_date') is-invalid @enderror"
                            name="credit_start_date"
                            value="{{ old('credit_start_date', $quotation->credit_start_date) }}">
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
                        class="form-label  @error('debt_capital') text-danger fw-bold @enderror"><strong>Capital
                            Adeudado</strong></label>
                    <div class="input-group @error('debt_capital') text-danger @enderror">
                        <span class="input-group-text @error('debt_capital') border border-danger @enderror">
                            <i class="bi bi-cash @error('debt_capital') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Capital Adeudado" id="debtCapital" type="text" readonly
                            class="form-control @error('debt_capital') is-invalid @enderror" name="debt_capital"
                            value="{{ old('debt_capital', $quotation->debt_capital) }}">
                    </div>

                    @error('debt_capital')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="term"
                        class="form-label  @error('term') text-danger fw-bold @enderror"><strong>Plazo</strong></label>
                    <div class="input-group @error('term') text-danger @enderror">
                        <span class="input-group-text @error('term') border border-danger @enderror">
                            <i class="bx bxs-calendar @error('term') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Plazo" id="term" type="text" readonly
                            class="form-control @error('term') is-invalid @enderror" name="term"
                            value="{{ old('term', $quotation->term) }}">
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
                        class="form-label  @error('current_interest_rate') text-danger fw-bold @enderror"><strong>Tasa
                            de
                            Interés Corriente</strong></label>
                    <div class="input-group @error('current_interest_rate') text-danger @enderror">
                        <span class="input-group-text @error('current_interest_rate') border border-danger @enderror">
                            <i class="bx bx-money @error('current_interest_rate') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Tasa de Interés Corriente" id="currentInterestRate" type="text" readonly
                            class="form-control @error('current_interest_rate') is-invalid @enderror"
                            name="current_interest_rate"
                            value="{{ old('current_interest_rate', $quotation->current_interest_rate) }}">
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
                        class="form-label @error('default_interest_rate') text-danger fw-bold @enderror"><strong>Tasa
                            de
                            Interés
                            Moratoria</strong></label>
                    <div class="input-group @error('default_interest_rate') text-danger @enderror">
                        <span class="input-group-text @error('default_interest_rate') border border-danger @enderror">
                            <i class="bi bi-piggy-bank @error('default_interest_rate') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Tasa de Interés Moratoria" id="defaultInterestRate" type="text"
                            readonly class="form-control @error('default_interest_rate') is-invalid @enderror"
                            name="default_interest_rate"
                            value="{{ old('default_interest_rate', $quotation->default_interest_rate) }}">
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
                        class="form-label @error('interest_owed') text-danger fw-bold @enderror"><strong>Intereses
                            Adeudados</strong></label>
                    <div class="input-group @error('interest_owed') text-danger @enderror">
                        <span class="input-group-text @error('interest_owed') border border-danger @enderror">
                            <i class="bi bi-currency-exchange @error('interest_owed') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Tasa de Interés Moratoria" id="interestOwed" type="text" readonly
                            class="form-control @error('interest_owed') is-invalid @enderror" name="interest_owed"
                            value="{{ old('interest_owed', $quotation->interest_owed) }}">
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
                        class="form-label @error('last_payment_day') text-danger fw-bold @enderror"><strong>Dia del
                            último
                            pago</strong></label>
                    <div class="input-group @error('last_payment_day') text-danger @enderror">
                        <span class="input-group-text @error('last_payment_day') border border-danger @enderror">
                            <i class="bi bi-calendar-date @error('last_payment_day') text-danger @enderror"></i>
                        </span>
                        <input id="lastPaymentDay" type="date" readonly
                            class="form-control @error('last_payment_day') is-invalid @enderror"
                            name="last_payment_day"
                            value="{{ old('last_payment_day', $quotation->last_payment_day) }}">
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
                        class="form-label @error('currency') text-danger fw-bold @enderror"><strong>Moneda</strong></label>
                    <div class="input-group @error('currency') text-danger @enderror">
                        <span class="input-group-text @error('currency') border border-danger @enderror">
                            <i class="ri ri-currency-fill @error('currency') text-danger @enderror"></i>
                        </span>
                        <input id="currency" type="text" placeholder="Moneda" readonly
                            class="form-control @error('currency') is-invalid @enderror" name="currency"
                            value="{{ $currency->name }}">
                    </div>

                    @error('currency')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- <div class="col-md-12">
                    <label for="baseExecutionDocument"
                        class="form-label @error('base_execution_document') text-danger fw-bold @enderror"><strong>Documento
                            Base de Ejecucion</strong></label>
                    <div class="input-group @error('base_execution_document') text-danger @enderror">
                        <span class="input-group-text @error('base_execution_document') border border-danger @enderror">
                            <i class="bi bi-person @error('base_execution_document') text-danger @enderror"></i>
                        </span>
                        <input id="base_execution_document" type="file"
                            class="form-control @error('base_execution_document') is-invalid @enderror"
                            name="base_execution_document" multiple
                            value="{{old('base_execution_document', $quotation->base_execution_document)}}">
                    </div>

                    @error('base_execution_document')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div> --}}

                @if ($quotation->base_execution_document)
                    <div class="col-md-12">
                        <label for="baseExecutionDocument" class="form-label"><strong>Documento
                                Base de Ejecucion</strong></label>
                        <div class="input-group">
                            <input id="base_execution_document" type="text" class="form-control border-none"
                                name="base_execution_document_prev" readonly
                                value="{{ $quotation->base_execution_document }}">
                        </div>
                    </div>
                @endif

                <div class="col-md-12">
                    <label for="description"
                        class="form-label @error('description') text-danger fw-bold @enderror"><strong>Breve
                            descripción
                            del
                            caso</strong></label>
                    <div class="input-group @error('description') text-danger @enderror">
                        <span class="input-group-text @error('description') border border-danger @enderror">
                            <i class="bi bi-pencil @error('description') text-danger @enderror"></i>
                        </span>
                        <input id="description" type="text"
                            placeholder="Breve descripción del
                        caso"
                            class="form-control @error('description') is-invalid @enderror" name="description"
                            readonly value="{{ old('description', $quotation->description) }}">
                    </div>

                    @error('description')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <style>
                    /* Estilo personalizado para elementos deshabilitados */
                    .form-check-input[disabled]+.form-check-label {
                        color: #6c757d !important;
                        /* Color de texto para elementos deshabilitados */
                        pointer-events: none !important;
                        /* Evitar eventos de puntero en elementos deshabilitados */
                    }

                    /* Estilo personalizado para input tipo radio deshabilitado */
                    .form-check-input[disabled] {
                        opacity: 1 !important;
                        /* Hacer que el radio button sea visible */
                        cursor: not-allowed !important;
                        /* Cambiar el cursor para indicar que el elemento no está disponible */
                    }
                </style>

                <div class="col-md-12">
                    <label for="comments" class="form-label"><strong>Comentarios</strong></label>
                    <div class="input-group ">
                        <span class="input-group-text">
                            <i class="bi bi-chat-left-dots "></i>
                        </span>
                        <input id="comments" type="text" placeholder="Comentarios" readonly class="form-control"
                            name="comments" value="{{ old('comments', $quotation->comments) }}">
                    </div>
                </div>
                {{--
                <hr class="border-bottom border-1 border-grey"> --}}

                <div class="border-top border-4 mt-4"></div>

                <div class="col-md-6">
                    <label for="cost"
                        class="form-label @error('cost') text-danger fw-bold @enderror"><strong>Costo</strong></label>
                    <div class="input-group @error('cost') text-danger @enderror">
                        <span class="input-group-text @error('cost') border border-danger @enderror">
                            <i class="ri ri-exchange-dollar-line @error('cost') text-danger @enderror"></i>
                        </span>
                        <input id="cost" type="text" placeholder="Determina el costo"
                            class="form-control @error('cost') is-invalid @enderror" name="cost"
                            value="{{ old('cost', $quotation->cost) }}">
                    </div>

                    @error('cost')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="typeCase"
                        class="form-label @error('type_case_id') text-danger fw-bold @enderror"><strong>Determinar
                            tipo
                            de Caso</strong></label>
                    <div class="input-group @error('type_case_id') text-danger @enderror">
                        <span class="input-group-text @error('type_case_id') border border-danger @enderror">
                            <i class="ri ri-suitcase-line @error('type_case_id') text-danger @enderror"></i>
                        </span>
                        <select name="type_case_id"
                            class="form-select @error('type_case_id') border border-danger @enderror" id="">
                            <option value="">Seleccione</option>
                            @foreach ($typeCases as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('type_case_id', $quotation->type_case_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @error('cost')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="lawyer_commet"
                        class="form-label @error('lawyer_commet') text-danger fw-bold @enderror"><strong>Dejar un
                            comentario al cliente</strong></label>
                    <div class="input-group @error('lawyer_commet') text-danger @enderror">
                        <span class="input-group-text @error('lawyer_commet') border border-danger @enderror">
                            <i class="ri ri-chat-1-fill @error('lawyer_commet') text-danger @enderror"></i>
                        </span>
                        <input id="lawyer_commet" type="text" placeholder="Dejarle un comentario al cliente"
                            class="form-control @error('lawyer_commet') is-invalid @enderror" name="lawyer_commet"
                            value="{{ old('lawyer_commet', $quotation->lawyer_commet) }}">
                    </div>

                    @error('lawyer_commet')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="text-end">
                    @role('lawyer')
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check"></i>
                            Enviar propuesta
                        </button>
                    @endrole
                    <button type="reset" class="btn btn-danger">
                        <i class="bi bi-arrow-return-left"></i>
                        Regresar
                    </button>
                </div>
            </form>

        </div>
    </div>

</x-layouts.app>
