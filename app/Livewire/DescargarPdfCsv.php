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

    public function downloadPDF()
    {
        // Validar fechas
        $this->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
        ]);

        // Consultar datos de participantes
        $datos = Participante::whereBetween('created_at', [
            $this->fechaInicio,
            $this->fechaFin
        ])->get();

        // Verificar si hay datos disponibles
        if ($datos->isEmpty()) {
            return response()->json(['error' => 'No hay datos disponibles para generar el PDF'], 404);
        }

        // Generar el PDF
        $pdf = PDF::loadView('descargar', compact('datos'));

        // Verificar si el PDF se generó correctamente
        if ($pdf) {
            return $pdf->download('participantes.pdf');
        } else {
            return response()->json(['error' => 'Error al generar el PDF'], 500);
        }
    }

    public function downloadCSV()
    {
        // Validar fechas
        $this->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
        ]);

        // Consultar datos de participantes
        $datos = Participante::whereBetween('created_at', [$this->fechaInicio, $this->fechaFin])->get();

        // Crear CSV
        $csv = Writer::createFromString('');
        $csv->insertOne(['ID', 'Nombre y Apellido', 'Email']);

        foreach ($datos as $dato) {
            $csv->insertOne([
                $dato->id,
                $dato->name_and_last_name,
                $dato->email,
                $dato->signatureBase64,
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
        return view('livewire.descargar-pdf-csv');
    }
}
