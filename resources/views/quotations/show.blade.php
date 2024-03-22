<x-layouts.app>
    <x-layouts.partials.breadcrum :title="'Cotizaciones'" :sub-title="'Cotizacion'" :route="'quotations.index'" :item-active="$quotation->code"/>

    <x-quotation.form :quotation="$quotation" :currencies="$currencies" :readonly="true"/>
</x-layouts.app>
