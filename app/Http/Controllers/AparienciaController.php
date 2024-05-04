<?php


namespace App\Http\Controllers;

use App\Models\Apariencia;
use Illuminate\Http\Request;

class AparienciaController extends Controller
{
    public function index()
    {
        $apariencia = Apariencia::first();
        $isLogoActive = $apariencia ? $apariencia->is_logo_active : false;

        return view('apariencia', compact('isLogoActive'));
    }
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = 'logo'.'.'.$request->logo->extension();
        $request->logo->move(public_path('logos'), $imageName);
    
        $apariencia = Apariencia::firstOrCreate(); // Obtener o crear la instancia de Apariencia
        $apariencia->logo = $imageName;
        $apariencia->save();
    
        return back()
            ->with('success', 'Has subido correctamente el logo.')
            ->with('logo', $imageName);
    }


    public function toggleLogo(Request $request)
    {
        $apariencia = Apariencia::firstOrCreate(); // Obtener o crear la instancia de Apariencia
        $apariencia->is_logo_active = $request->has('logo_active');
        $apariencia->save();
    
        return back()->with('status', 'La configuración del logo ha sido actualizada.');
    }


}