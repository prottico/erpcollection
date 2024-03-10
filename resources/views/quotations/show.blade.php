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

            <form class="row g-3" method="POST" action="{{ route('quotations.store') }}" enctype="multipart/form-data">
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
                        <input id="creditDueDate" type="date"
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

                <div class="col-md-6">
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
                        <input id="amountLastPayment" type="text" placeholder="Monto del último pago"
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
                            <span
                                class="input-group-text @error('base_execution_document') border border-danger @enderror">
                                <i
                                    class="ri ri-file-upload-line @error('base_execution_document') text-danger @enderror"></i>
                            </span>
                            <input id="base_execution_document" type="text" class="form-control border-none"
                                name="base_execution_document_prev" readonly
                                value="{{ $quotation->base_execution_document }}">
                        </div>
                    </div>
                @endif

                {{-- <div class="col-md-12">
                    <label for="description"
                        class="form-label @error('description') text-danger fw-bold @enderror">Breve descripción del
                        caso</label>
                    <div class="input-group @error('description') text-danger @enderror">
                        <span class="input-group-text @error('description') border border-danger @enderror">
                            <i class="bi bi-person @error('description') text-danger @enderror"></i>
                        </span>
                        <input id="description" type="file"
                            class="form-control @error('description') is-invalid @enderror" name="description"
                            value="{{old('description')}}">
                        <textarea placeholder="Agregue una breve descripción del caso..." name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            id="exampleFormControlTextarea1" rows="2">
                            {{old('description', $quotation->description)}}
                        </textarea>

                        <textarea placeholder="Agregue una breve descripción del caso..." name="description"
                            class="form-control txt @error('description') is-invalid @enderror"
                            id="exampleFormControlTextarea" rows="2" style="resize: none !important;">
                            {{trim(old('description', $quotation->description)) }}
                        </textarea>


                    </div>

                    @error('description')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div> --}}

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

                {{-- <div class="col-md-12">
                    <label for="comments"
                        class="form-label @error('comments') text-danger fw-bold @enderror">Comentarios</label>
                    <div class="input-group @error('comments') text-danger @enderror">
                        <span class="input-group-text @error('comments') border border-danger @enderror">
                            <i class="bi bi-person @error('comments') text-danger @enderror"></i>
                        </span>
                        <input id="comments" type="file" class="form-control @error('comments') is-invalid @enderror"
                            name="comments" value="{{old('comments')}}">
                        <textarea placeholder="Agregue una breve descripción del caso..." name="comments"
                            class="form-control txt @error('comments') is-invalid @enderror"
                            id="exampleFormControlTextarea1" rows="2">
                            {{old('description', $quotation->comments) }}
                        </textarea>
                        <script>
                            $('.txt').autogrow({vertical: true, horizontal: false});
                        </script>
                    </div>

                    @error('comments')
                    <div class="text-danger p-2 mt-1 rounded">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div> --}}

                <div class="col-md-12">
                    <label for="comments"
                        class="form-label @error('comments') text-danger fw-bold @enderror"><strong>Comentarios</strong></label>
                    <div class="input-group @error('comments') text-danger @enderror">
                        <span class="input-group-text @error('comments') border border-danger @enderror">
                            <i class="bi bi-chat-left-dots @error('comments') text-danger @enderror"></i>
                        </span>
                        <input id="comments" type="text" placeholder="Comentarios" readonly
                            class="form-control @error('comments') is-invalid @enderror" name="comments"
                            value="{{ old('comments', $quotation->comments) }}">
                    </div>

                    @error('comments')
                        <div class="text-danger p-2 mt-1 rounded">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @role('independent-client')
                    @if ($quotation->cost && $quotation->typeCase && $quotation->typeCase->name)
                        <div class="col-md-6">
                            <label for="cost" class="form-label "><strong>Costo</strong></label>
                            <div class="input-group ">
                                <span class="input-group-text">
                                    <i class="ri ri-exchange-dollar-line "></i>
                                </span>
                                <input id="cost" type="text" placeholder="Determina el costo" readonly
                                    class="form-control" name="cost" value="{{ old('cost', $quotation->cost) }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="cost" class="form-label"><strong>Tipo
                                    de Caso determinado</strong></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ri ri-suitcase-line"></i>
                                </span>
                                <input id="cost" type="text" placeholder="Determina el costo" readonly
                                    class="form-control" name="cost" value="{{ $quotation->typeCase->name }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="lawyer_commet" class="form-label"><strong>Comentario del Abogado
                                    asignado</strong></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ri ri-chat-1-fill"></i>
                                </span>
                                <input id="lawyer_commet" type="text" placeholder="Dejarle un comentario al cliente"
                                    readonly class="form-control" name="lawyer_commet"
                                    value="{{ $quotation->lawyer_commet }}">
                            </div>
                        </div>
                    @endif

                @endrole

                @role('general-admin')
                    <div class="col-md-12">
                        <label for="comments" class="form-label"><strong>Abogado
                                Asignado</strong></label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="ri ri-user-add-line"></i>
                            </span>
                            <input class="form-control"
                                value="{{ $quotation->lawyer ? $quotation->lawyer->name : 'Sin asignar' }}" readonly>
                        </div>
                    </div>
                @endrole

                <div class="text-end">
                    @role('independent-client')
                        @if ($quotation->cost && $quotation->typeCase && $quotation->typeCase->name)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" disabled
                                data-bs-target="#modalAssignLawyer" id="modalReferenceTarget">
                                <i class="bi bi-check"></i>
                                Aceptar y Abrir el caso
                            </button>
                        @endif
                    @endrole

                    @role('general-admin')
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#modalAssignLawyer" id="modalReferenceTarget">
                            <i class="ri ri-user-add-line"></i>
                            Asignar Abogado
                        </button>
                    @endrole
                    @role('independent')
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check"></i>
                            Enviar
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

    <!-- Modal -->
    <div class="modal fade" id="modalAssignLawyer" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Asignar Abogado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('quotations.assign.lawyer') }}" id="dataFormSend" method="POST">
                                @csrf
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ri ri-user-add-line"></i>
                                    </span>

                                    @php
                                        $encryptedId = base64_encode($quotation->id); // Cifra el valor utilizando base64
                                    @endphp

                                    <input type="hidden" name="quotationId" data-req-send
                                        value="{{ $encryptedId }}">

                                    <select name="lawyerId" class="form-select" id="asignLawyer">
                                        <option value="">Seleccione</option>
                                        @foreach ($lawyers as $lawyer)
                                            <option value="{{ $lawyer->id }}">
                                                {{ $lawyer->person->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check"></i>
                                        Asignar
                                    </button>
                                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">
                                        <i class="bi bi-arrow-return-left"></i>
                                        Regresar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Desencriptar el ID de la quotation
        function decryptId(encryptedId) {
            return atob(encryptedId);
        }

        $(document).ready(function() {
            // Evento que se ejecuta cuando el modal se oculta
            $('#modalAssignLawyer').on('hidden.bs.modal', function() {
                // Limpiar el valor del select
                $('#asignLawyer').val('');
            });

            let idToSend = null;

            // Evento de clic en el botón para abrir el modal
            $('form').on('click', '#modalReferenceTarget', function() {
                // Obtener el ID
                const encryptedId = $('input[name="quotationId"]').val();


                idToSend = decryptId(encryptedId);
                console.log(idToSend);
                // Asignar el ID al campo oculto
                $('#dataFormSend input[data-req-send]').val(idToSend);
                // Mostrar el modal
                $('#modalAssignLawyer').modal('show');
            });

            // Evento de envío del formulario
            $('#dataFormSend').submit(function() {
                // Asignar el ID al campo oculto antes de enviar el formulario
                $('#dataFormSend input[data-req-send]').val(idToSend);
                return true;
            });
        });
    </script>




</x-layouts.app>
