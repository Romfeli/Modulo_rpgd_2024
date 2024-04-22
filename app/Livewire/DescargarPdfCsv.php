<?php

namespace App\Livewire;

// app/Http/Livewire/DownloadData.php

use Livewire\Component;
use PDF;
use League\Csv\Writer;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Participante;

class DescargarPdfCsv extends Component
{
    public $fechaInicio;
    public $fechaFin;

    public function downloadPDF()
{
    try {
        $datos = Participante::whereBetween('created_at', [$this->fechaInicio, $this->fechaFin])->get();
        $pdf = PDF::loadView('descargar', compact('datos'));

        // Verifica si el PDF se generó correctamente
        if ($pdf) {
            return $pdf->download('participantes.pdf');
        } else {
            return response()->json(['error' => 'Error al generar el PDF'], 500);
        }
    } catch (\Exception $e) {
        // Captura cualquier excepción y registra el mensaje de error
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function downloadCSV()
    {
        $datos = Participante::whereBetween('created_at', [$this->fechaInicio, $this->fechaFin])->get();
        $csv = Writer::createFromString('');
        $csv->insertOne(['ID', 'Nombre y Apellido', 'Email']);

        foreach ($datos as $dato) {
            $csv->insertOne([
                $dato->id,
                $dato->name_and_last_name,
                $dato->email,
            ]);
        }

        $csvContent = $csv->toString();
        return response()->streamDownload(function () use ($csvContent) {
            echo $csvContent;
        }, 'reporte.csv');
    }

    public function render()
    {
        return view('livewire.descargar-pdf-csv');
    }
}
