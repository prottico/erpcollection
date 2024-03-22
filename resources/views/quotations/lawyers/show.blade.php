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
                    <label for="creditDueDate"
                        class="form-label @error('credit_due_date') text-danger fw-bold @enderror"><strong>Fecha de
                            vencimiento del Crédito</strong></label>
                    <div class="input-group @error('credit_due_date') text-danger @enderror">
                        <span class="input-group-text @error('credit_due_date') border border-danger @enderror">
                            <i class="bi bi-calendar-date @error('credit_due_date') text-danger @enderror"></i>
                        </span>
                        <input id="creditDueDate" type="date" readonly
                            class="form-control @error('credit_due_date') is-invalid @enderror" name="credit_due_date"
                            value="{{ old('credit_due_date', $quotation->credit_due_date) }}">
                    </div>

                    @error('credit_due_date')
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
                <div class="col-md-3">
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
                <div class="col-md-3">
                    <label for="currentInterestRate"
                        class="form-label  @error('current_interest_rate') text-danger fw-bold @enderror"><strong>Tasa
                            de
                            Interés Corriente</strong></label>
                    <div class="input-group @error('current_interest_rate') text-danger @enderror">
                        <span class="input-group-text @error('current_interest_rate') border border-danger @enderror">
                            <i class="bx bx-money @error('current_interest_rate') text-danger @enderror"></i>
                        </span>
                        <input placeholder="Tasa de Interés Corriente" id="currentInterestRate" type="text"
                            readonly class="form-control @error('current_interest_rate') is-invalid @enderror"
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
                <div class="col-md-3">
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

                <div class="col-md-3">
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

                <div class="col-md-8">
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

                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <div class="form-check mt-4">
                        <input class="form-check-input" name="noApply" disabled type="checkbox" value="1"
                            id="flexCheckDefault" @if ($quotation->no_apply_last_payment_day == 1) checked @endif>
                        <label class="form-check-label" for="flexCheckDefault" style="color: black !important;">
                            <strong>No aplica (Dia del último pago)</strong>
                        </label>
                    </div>

                    @error('noApply')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="amountLastPayment"
                        class="form-label @error('amount_last_payment') text-danger fw-bold @enderror"><strong>Monto
                            del
                            último
                            pago</strong></label>
                    <div class="input-group @error('amount_last_payment') text-danger @enderror">
                        <span class="input-group-text @error('amount_last_payment') border border-danger @enderror">
                            <i class="bi bi-calendar-date @error('amount_last_payment') text-danger @enderror"></i>
                        </span>
                        <input id="amountLastPayment" type="text" placeholder="Monto del último pago" readonly
                            class="form-control @error('amount_last_payment') is-invalid @enderror"
                            name="amount_last_payment" value="{{ $quotation->amount_last_payment }}">
                    </div>
                </div>



                <div class="col-md-6">
                    <label for="currency"
                        class="form-label @error('currency') text-danger fw-bold @enderror"><strong>Moneda</strong></label>
                    <div class="input-group @error('currency') text-danger @enderror">
                        <span class="input-group-text @error('currency') border border-danger @enderror">
                            <i class="ri ri-currency-fill @error('currency') text-danger @enderror"></i>
                        </span>
                        {{-- <input id="currency" type="text" placeholder="Moneda" readonly
                            class="form-control @error('currency') is-invalid @enderror" name="currency"
                            value="{{ $currency->name }}"> --}}
                            <select name="currency_id" @if (!auth()->user()->hasRole(['general-admin', 'lawyer']) ) disabled @endif class="form-select @error('currency_id') border border-danger @enderror" id="currency_id">
                                <option value="">Seleccione</option>
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}"
                                        {{ old('currency_id', $quotation->currency_id ?? null) == $currency->id
                                            ? 'selected'
                                            : '' }}>
                                        {{ $currency->name }}
                                    </option>
                                @endforeach
                        </select>
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

                <div class="col-md-12">
                    <label for="typeCase"
                        class="form-label @error('type_case_id') text-danger fw-bold @enderror"><strong>Determinar
                            tipo
                            de Caso</strong></label>
                    <div class="input-group @error('type_case_id') text-danger @enderror">
                        <span class="input-group-text @error('type_case_id') border border-danger @enderror">
                            <i class="ri ri-suitcase-line @error('type_case_id') text-danger @enderror"></i>
                        </span>

                        @if ($quotation->budget)
                            <input id="honorary1" type="text" placeholder="Honorario"
                                @if ($quotation->budget) readonly @endif
                                class="form-control @error('honorary1') is-invalid @enderror" name="honorary1"
                                value="{{ $quotation->typeCase->name }}">
                        @else
                            <select name="type_case_id" @if ($quotation->budget) readonly @endif
                                class="form-select @error('type_case_id') border border-danger @enderror"
                                id="">
                                <option value="">Seleccione</option>
                                @foreach ($typeCases as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('type_case_id', $quotation->type_case_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    @error('type_case_id')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- HONORARIOS --}}

                <div class="col-md-5">
                    <label for="honorary1"
                        class="form-label @error('honorary1') text-danger fw-bold @enderror"><strong>Honorario
                            #1</strong></label>
                    <div class="input-group @error('honorary1') text-danger @enderror">
                        <span class="input-group-text @error('honorary1') border border-danger @enderror">
                            <i class="ri ri-checkbox-circle-fill @error('honorary1') text-danger @enderror"></i>
                        </span>
                        <input id="honorary1" type="text" placeholder="Honorario"
                            @if ($quotation->budget) readonly @endif
                            class="form-control @error('honorary1') is-invalid @enderror" name="honorary1"
                            value="{{ old('honorary1', $quotation->budget && $quotation->budget->product ? $quotation->budget->product->name : '') }}">
                    </div>

                    @error('honorary1')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-5">
                    <label for="description_honorary_1"
                        class="form-label @error('description_honorary_1') text-danger fw-bold @enderror"><strong>Descripción</strong></label>
                    <div class="input-group @error('description_honorary_1') text-danger @enderror">
                        <span
                            class="input-group-text @error('description_honorary_1') border border-danger @enderror">
                            <i class="ri ri-pencil-fill @error('description_honorary_1') text-danger @enderror"></i>
                        </span>
                        <input id="description_honorary_1" type="text" placeholder="Descripción"
                            @if ($quotation->budget) readonly @endif
                            class="form-control @error('description_honorary_1') is-invalid @enderror"
                            name="description_honorary_1"
                            value="{{ old('description_honorary_1', $quotation->budget && $quotation->budget->product ? $quotation->budget->product->description : '') }}">
                    </div>

                    @error('description_honorary_1')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="price_honorary_1"
                        class="form-label @error('price_honorary_1') text-danger fw-bold @enderror"><strong>Precio</strong></label>
                    <div class="input-group @error('price_honorary_1') text-danger @enderror">
                        <span class="input-group-text @error('price_honorary_1') border border-danger @enderror">
                            <i
                                class="ri ri-money-dollar-circle-fill @error('price_honorary_1') text-danger @enderror"></i>
                        </span>
                        <input id="price_honorary_1" type="text" placeholder="Precio"
                            @if ($quotation->budget) readonly @endif
                            class="form-control @error('price_honorary_1') is-invalid @enderror"
                            name="price_honorary_1"
                            value="{{ old('price_honorary_1', $quotation->budget && $quotation->budget->product ? $quotation->budget->product->price : '') }}">
                    </div>

                    @error('price_honorary_1')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- <div class="col-md-5">
                    <label for="honorary2"
                        class="form-label @error('honorary2') text-danger fw-bold @enderror"><strong>Honorario
                            #2</strong></label>
                    <div class="input-group @error('honorary2') text-danger @enderror">
                        <span class="input-group-text @error('honorary2') border border-danger @enderror">
                            <i class="ri ri-checkbox-circle-fill @error('honorary2') text-danger @enderror"></i>
                        </span>
                        <input id="honorary2" type="text" placeholder="Honorario"
                            class="form-control @error('honorary2') is-invalid @enderror" name="honorary2"
                            value="{{ old('honorary2') }}">
                    </div>

                    @error('honorary2')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-5">
                    <label for="description_honorary_2"
                        class="form-label @error('description_honorary_2') text-danger fw-bold @enderror"><strong>Descripción</strong></label>
                    <div class="input-group @error('description_honorary_2') text-danger @enderror">
                        <span
                            class="input-group-text @error('description_honorary_2') border border-danger @enderror">
                            <i class="ri ri-pencil-fill @error('description_honorary_2') text-danger @enderror"></i>
                        </span>
                        <input id="description_honorary_2" type="text" placeholder="Descripción"
                            class="form-control @error('description_honorary_2') is-invalid @enderror"
                            name="description_honorary_2" value="{{ old('description_honorary_2') }}">
                    </div>

                    @error('description_honorary_2')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="price_honorary_2"
                        class="form-label @error('price_honorary_2') text-danger fw-bold @enderror"><strong>Precio</strong></label>
                    <div class="input-group @error('price_honorary_2') text-danger @enderror">
                        <span class="input-group-text @error('price_honorary_2') border border-danger @enderror">
                            <i
                                class="ri ri-money-dollar-circle-fill @error('price_honorary_2') text-danger @enderror"></i>
                        </span>
                        <input id="price_honorary_2" type="text" placeholder="Precio"
                            class="form-control @error('price_honorary_2') is-invalid @enderror"
                            name="price_honorary_2" value="{{ old('price_honorary_2') }}">
                    </div>

                    @error('price_honorary_2')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-5">
                    <label for="honorary2"
                        class="form-label @error('honorary2') text-danger fw-bold @enderror"><strong>Honorario
                            #3</strong></label>
                    <div class="input-group @error('honorary2') text-danger @enderror">
                        <span class="input-group-text @error('honorary2') border border-danger @enderror">
                            <i class="ri ri-checkbox-circle-fill @error('honorary2') text-danger @enderror"></i>
                        </span>
                        <input id="honorary2" type="text" placeholder="Honorario"
                            class="form-control @error('honorary2') is-invalid @enderror" name="honorary3"
                            value="{{ old('honorary2') }}">
                    </div>

                    @error('honorary2')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-5">
                    <label for="description_honorary_3"
                        class="form-label @error('description_honorary_3') text-danger fw-bold @enderror"><strong>Descripción</strong></label>
                    <div class="input-group @error('description_honorary_3') text-danger @enderror">
                        <span
                            class="input-group-text @error('description_honorary_3') border border-danger @enderror">
                            <i class="ri ri-pencil-fill @error('description_honorary_3') text-danger @enderror"></i>
                        </span>
                        <input id="description_honorary_3" type="text" placeholder="Descripción"
                            class="form-control @error('description_honorary_3') is-invalid @enderror"
                            name="description_honorary_3" value="{{ old('description_honorary_3') }}">
                    </div>

                    @error('description_honorary_2')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="price_honorary_3"
                        class="form-label @error('price_honorary_3') text-danger fw-bold @enderror"><strong>Precio</strong></label>
                    <div class="input-group @error('price_honorary_3') text-danger @enderror">
                        <span class="input-group-text @error('price_honorary_3') border border-danger @enderror">
                            <i
                                class="ri ri-money-dollar-circle-fill @error('price_honorary_3') text-danger @enderror"></i>
                        </span>
                        <input id="price_honorary_3" type="text" placeholder="Precio"
                            class="form-control @error('price_honorary_3') is-invalid @enderror"
                            name="price_honorary_3" value="{{ old('price_honorary_1') }}">
                    </div>

                    @error('price_honorary_3')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}


                <div class="col-md-4">
                    <label for="iva"
                        class="form-label @error('iva') text-danger fw-bold @enderror"><strong>IVA</strong></label>
                    <div class="input-group @error('iva') text-danger @enderror">
                        <span class="input-group-text @error('iva') border border-danger @enderror">
                            <i class="ri ri-exchange-dollar-line @error('iva') text-danger @enderror"></i>
                        </span>
                        <input id="iva" type="text" placeholder="Determina el iva"
                            @if ($quotation->budget) readonly @endif
                            class="form-control @error('iva') is-invalid @enderror" name="iva"
                            value="{{ old('iva', $quotation->budget ? $quotation->budget->iva : '') }}">
                    </div>

                    @error('iva')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="subtotal"
                        class="form-label @error('subtotal') text-danger fw-bold @enderror"><strong>Subtotal</strong></label>
                    <div class="input-group @error('subtotal') text-danger @enderror">
                        <span class="input-group-text @error('subtotal') border border-danger @enderror">
                            <i class="ri ri-exchange-dollar-line @error('subtotal') text-danger @enderror"></i>
                        </span>
                        <input id="subtotal" type="text" placeholder="Determina el subtotal"
                            @if ($quotation->budget) readonly @endif
                            class="form-control @error('subtotal') is-invalid @enderror" name="subtotal"
                            value="{{ old('subtotal', $quotation->budget ? $quotation->budget->subtotal : '') }}">
                    </div>

                    @error('subtotal')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="total"
                        class="form-label @error('total') text-danger fw-bold @enderror"><strong>Total</strong></label>
                    <div class="input-group @error('total') text-danger @enderror">
                        <span class="input-group-text @error('total') border border-danger @enderror">
                            <i class="ri ri-exchange-dollar-line @error('total') text-danger @enderror"></i>
                        </span>
                        <input id="total" type="text" placeholder="Determina el total"
                            @if ($quotation->budget) readonly @endif
                            class="form-control @error('total') is-invalid @enderror" name="total"
                            value="{{ old('total', $quotation->budget ? $quotation->budget->total : '') }}">
                    </div>

                    @error('total')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="col-md-12">
                    <label for="comment"
                        class="form-label @error('comment') text-danger fw-bold @enderror"><strong>Dejar un
                            comentario al cliente</strong></label>
                    <div class="input-group @error('comment') text-danger @enderror">
                        <span class="input-group-text @error('comment') border border-danger @enderror">
                            <i class="ri ri-chat-1-fill @error('comment') text-danger @enderror"></i>
                        </span>
                        <input id="comment" type="text" placeholder="Dejarle un comentario al cliente"
                            @if ($quotation->budget) readonly @endif
                            class="form-control @error('comment') is-invalid @enderror" name="comment"
                            value="{{ old('comment', $quotation->budget ? $quotation->budget->comment : '') }}">
                    </div>

                    @error('comment')
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
