<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentType::create([
            'type_doc_id' => 1, // ID único
            'type' => 'Cédula', // Nombre del tipo de documento
        ]);

          DocumentType::create([
            'type_doc_id' => 2, // ID único
            'type' => 'Tarjeta de Identidad', // Nombre del tipo de documento
        ]);
    }
}
