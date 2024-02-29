<?php

namespace Database\Seeders;

use App\Models\Quotation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quotation::factory(20)->create();

        // Obtener todas las citas (quotations) de la base de datos
        $quotations = Quotation::all();

        // Iterar sobre cada cita y actualizar su campo code
        foreach ($quotations as $index => $quotation) {
            // Generar el nuevo código correlativo
            $prefix = 'C-'; // Prefijo para el código de la cotizacion
            $correlative = $index + 1; // Incrementar el índice en 1 para crear un correlativo único
            $newCode = $prefix . str_pad($correlative, 9, '0', STR_PAD_LEFT); // Formato del código
            // Actualizar el campo code en el registro actual
            $quotation->code = $newCode;
            $quotation->save(); // Guardar el cambio en la base de datos
        }
    }
}
