<x-layouts.app>

    <x-layouts.partials.breadcrum :title="'Cotizaciones'" :sub-title="'Cotizacion'" :route="'quotations.index'" :item-active="$quotation->code"/>

    <x-quotation.form :quotation="$quotation" :currencies="$currencies" :routeSend="'quotations.update'"/>

    @role('general-admin')
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
    @endrole

</x-layouts.app>
