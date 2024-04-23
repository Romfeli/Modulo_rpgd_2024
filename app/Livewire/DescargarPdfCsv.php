<?php

namespace App\Livewire;

use Livewire\Component;
use PDF;
use League\Csv\Writer;
use App\Models\Participante;

class DescargarPdfCsv extends Component
{
    public $fechaInicio;
    public $fechaFin;

    public function descargarPdf()
    {
        // Validar fechas
        $this->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
        ]);
    
        // Consultar datos de participantes
        $datos = Participante::whereBetween('created_at', [$this->fechaInicio, $this->fechaFin])->get();
    
        // Generar PDF a partir de la vista
        $pdf = PDF::loadView('livewire.descargar', compact('datos'));
    
        // Descargar PDF
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
            }, 'name.pdf');    }


public function downloadCSV()
{
    // Validar fechas
    $this->validate([
        'fechaInicio' => 'required|date',
        'fechaFin' => 'required|date|after_or_equal:fechaInicio',
    ]);

    // Consultar datos de participantes
    $datos = Participante::whereBetween('created_at', [$this->fechaInicio, $this->fechaFin])->get();

    // Crear CSV con punto y coma como delimitador
    $csv = Writer::createFromString('');
    $csv->setDelimiter(';'); // Establecer el delimitador como punto y coma

    // Insertar encabezado
    $csv->insertOne(['ID', 'Nombre y Apellido', 'Email', 'Firma']);

    // Insertar datos
    foreach ($datos as $dato) {
        // Generar la URL de la imagen de la firma
        $signatureBase64 = asset($dato->signatureBase64); // Suponiendo que has guardado las firmas en una carpeta accesible desde la web

        // Insertar datos en el CSV
        $csv->insertOne([
            $dato->id,
            $dato->name_and_last_name,
            $dato->email,
            $dato ->signatureBase64, // Insertar URL de la firma en lugar de la representación Base64
        ]);
    }

    // Obtener contenido CSV
    $csvContent = $csv->toString();

    // Descargar CSV
    return response()->streamDownload(function () use ($csvContent) {
        echo $csvContent;
    }, 'reporte.csv');
}

public function render()
{
    return view('livewire.descargar-pdf-csv'); // Reemplaza 'livewire.descargar-pdf-csv' con la ruta de tu vista Livewire
}
}

