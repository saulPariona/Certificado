<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Http\Requests\Admin\AddEventoRequest;
use App\Models\User;
use App\Http\Requests\Admin\AddOrganizadorRequest;
use App\Http\Requests\Admin\AddPonenteRequest;
use App\Http\Requests\Admin\AddCertificadoBaseRequest;
use App\Models\Certificado;
use Carbon\Carbon; // para trabajar con fechas
use App\Models\Tipo;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\Admin\AddAsistenteRequest;
//importar las clases de qr code
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrganizadoresExport;
use App\Exports\PonentesExport;
use App\Exports\AsistentesExport;
//use Endroid\QrCode\Logo\Logo;
//use Endroid\QrCode\ErrorCorrectionLevel;
//use Endroid\QrCode\Writer\ValidationException;

class AdminController extends Controller
{
    //  
    public function getDashboard()
    {
        $eventos = Evento::orderBy('fecha', 'desc')->get();
        return view('admin.dashboard', ['eventos' => $eventos]);
    }
    public function evento($evento_id)
    {
        $evento = Evento::findOrFail($evento_id); // el findOrFail es para buscar un evento por su id 
        $organizadores = $evento->organizadores;
        $ponentes = $evento->ponentes()->withPivot('ponencia')->get();
        $asistentes = $evento->asistentes;
        $pre_registrados = $evento->pre_registrados;
        return view('admin.evento', [
            'evento' => $evento,
            'organizadores' => $organizadores,
            'ponentes' => $ponentes,
            'asistentes' => $asistentes,
            'pre_registrados' => $pre_registrados,
            'evento_id' => $evento_id,
        ]);
    }
    public function getAddCertificadoBase($evento_id)
    {

        return view('admin.add_certificado_base', ['evento_id' => $evento_id]);
    }
    public function postAddCertificadoBase($evento_id, AddCertificadoBaseRequest $request)
    {
        $evento = Evento::findOrFail($evento_id); // el findOrFail es para buscar un evento por su id 
        $ext = $request->base->extension(); // el extension es para obtener la extension del archivo
        $name = strval($evento->id) . ".$ext"; // el strval es para convertir el id a string a un tipo de dato string
        $request->base->storeAs('certificados', $name); // el storeAs es para guardar el archivo en la carpeta certificados lo guarda en el storage/app/private/certificados
        $evento->certificado_base = $name; // el certificado base es el nombre del archivo
        $evento->save(); // el save es para guardar el evento en la base de datos
        return redirect()->route('evento', ['evento_id' => $evento_id]); // redirige al evento
    }
    public function getAddEvent()
    {
        return view('admin.add_evento');
    }
    public function postAddEvent(AddEventoRequest $request)
    {
        Evento::create([
            'name' => $request->name,
            'fecha' => $request->fecha,
            'address' => $request->address,
            'url' => $request->url,
        ]);
        return redirect()->route('dashboard');
    }
    public function getAddOrganizador($evento_id)
    {

        $users = User::select('id', 'paternal_surname', 'maternal_surname', 'name')->get();
        return view('admin.add_organizador', ['evento_id' => $evento_id, 'users' => $users]);
    }
    public function postAddOrganizador($evento_id, AddOrganizadorRequest $request)
    {
        $evento = Evento::findOrFail($evento_id); // la funcion findOrFail() busca un registro por su id y si no lo encuentra lanza una excepcion
        $organizador_id = (int)$request->organizador;
        $org = $evento->organizadores()->wherePivot('user_id', $organizador_id)->first(); //el first() es para obtener el primer registro que coincida con la condicion
        if (!$org) {
            $evento->organizadores()->attach([ // la funcion attach() es para agregar un registro a la tabla pivot
                $organizador_id => ['tipo_id' => 4] // el tipo de usuario
            ]);
        }
        return redirect()->route('evento', ['evento_id' => $evento_id]); // redirige al evento
    }
    public function getAddPonente($evento_id)
    {
        $users = User::select('id', 'paternal_surname', 'maternal_surname', 'name')->get();
        return view('admin.add_ponente', ['evento_id' => $evento_id, 'users' => $users]);
    }
    public function postAddPonente($evento_id, AddPonenteRequest $request)
    {
        $evento = Evento::findOrFail($evento_id); // la funcion findOrFail() busca un registro por su id y si no lo encuentra lanza una excepcion
        $ponente_id = (int)$request->ponente;
        $ponente = $evento->ponentes()->wherePivot('user_id', $ponente_id)->first(); //el first() es para obtener el primer registro que coincida con la condicion
        if (!$ponente) {
            $evento->ponentes()->attach([ // la funcion attach() es para agregar un registro a la tabla pivot
                $ponente_id => ['tipo_id' => 3, 'ponencia' => $request->ponencia] // el tipo de usuario
            ]);
        }
        return redirect()->route('evento', ['evento_id' => $evento_id]); // redirige al evento
    }
    //controlador de asistentes get y post
    public function getAddAsistente($evento_id)
    {
        $users = User::select('id', 'paternal_surname', 'maternal_surname', 'name')->get();
        return view('admin.add_asistente', ['evento_id' => $evento_id, 'users' => $users]);
    }
    public function postAddAsistente($evento_id, AddAsistenteRequest $request)
    {
        $evento = Evento::findOrFail($evento_id); // la funcion findOrFail() busca un registro por su id y si no lo encuentra lanza una excepcion
        $asistente_id = (int)$request->asistente;
        $asistente = $evento->asistentes()->wherePivot('user_id', $asistente_id)->first(); //el first() es para obtener el primer registro que coincida con la condicion
        if (!$asistente) {
            $evento->asistentes()->attach([ // la funcion attach() es para agregar un registro a la tabla pivot
                $asistente_id => ['tipo_id' => 2] // el tipo de usuario
            ]);
        }
        return redirect()->route('evento', ['evento_id' => $evento_id]); // redirige al evento
    }
    public function certificados($evento_id)
    {
        $evento = Evento::findOrFail($evento_id); // la funcion findOrFail() busca un registro por su id y si no lo encuentra lanza una excepcion
        $organizadores = $evento->organizadores()->withPivot('certificado_creado')->get();
        $certificados = $evento->certificado;
        $ponentes = $evento->ponentes()->withPivot('ponencia', 'certificado_creado')->get();
        $asistentes = $evento->asistentes()->withPivot('certificado_creado')->get();
        return view('admin.certificados', [
            'evento' => $evento,
            'organizadores' => $organizadores,
            'certificados' => $certificados,
            'ponentes' => $ponentes,
            'asistentes' => $asistentes,
            'evento_id' => $evento_id,
        ]);
    }
    public function generarCertificadoOrganizadores($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $organizadores = $evento->organizadores()->wherePivot('certificado_creado', false)->get();
        foreach ($organizadores as $organizador) {
            Certificado::updateOrCreate([ //esto hace que si existe el certificado, lo actualice, si no existe, lo cree
                'tipo_id' => 4,
                'user_id' => $organizador->id,
                'evento_id' => $evento_id,
            ]);
            $evento->organizadores()->updateExistingPivot($organizador->id, ['certificado_creado' => true]);
        }
        return redirect()->route('admin-certificados', ['evento_id' => $evento_id]);
    }
    public function generarCertificadoPonentes($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $ponentes = $evento->ponentes()->wherePivot('certificado_creado', false)->get();
        foreach ($ponentes as $ponente) {
            Certificado::updateOrCreate([ // esto hace que si existe el certificado, lo actualice, si no existe, lo cree
                'tipo_id' => 3,
                'user_id' => $ponente->id,
                'evento_id' => $evento_id,
            ]);
            $evento->ponentes()->updateExistingPivot($ponente->id, ['certificado_creado' => true]);
        }
        return redirect()->route('admin-certificados', ['evento_id' => $evento_id]);
    }
    //rutas de asistentes para generar certificados de asistentes
    public function generarCertificadoAsistentes($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $asistentes = $evento->asistentes()->wherePivot('certificado_creado', false)->get();
        foreach ($asistentes as $asistente) {
            Certificado::updateOrCreate([ // esto hace que si existe el certificado, lo actualice, si no existe, lo cree
                'tipo_id' => 2,
                'user_id' => $asistente->id,
                'evento_id' => $evento_id,
            ]);
            $evento->asistentes()->updateExistingPivot($asistente->id, ['certificado_creado' => true]);
        }
        return redirect()->route('admin-certificados', ['evento_id' => $evento_id]);
    }

    public function desacertificarOrganizadores($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $organizadores = $evento->organizadores()->wherePivot('certificado_creado', true)->get();
        foreach ($organizadores as $organizador) {
            $evento->organizadores()->updateExistingPivot($organizador->id, ['certificado_creado' => false]);
        }
        return redirect()->route('admin-certificados', ['evento_id' => $evento_id]);
    }
    public function desacertificarPonentes($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $ponentes = $evento->ponentes()->wherePivot('certificado_creado', true)->get();
        foreach ($ponentes as $ponente) {
            $evento->ponentes()->updateExistingPivot($ponente->id, ['certificado_creado' => false]);
        }
        return redirect()->route('admin-certificados', ['evento_id' => $evento_id]);
    }
    public function desacertificarAsistentes($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $asistentes = $evento->asistentes()->wherePivot('certificado_creado', true)->get();
        foreach ($asistentes as $asistente) {
            $evento->asistentes()->updateExistingPivot($asistente->id, ['certificado_creado' => false]);
        }
        return redirect()->route('admin-certificados', ['evento_id' => $evento_id]);
    }
    public function documento($certificado_id)
    {
        $certificado = Certificado::findOrFail($certificado_id);
        $evento = $certificado->evento;
        $user = $certificado->user;
        $tipo = $certificado->tipo;
        $ruta = storage_path('app/private/certificados/' . $evento->certificado_base);
        $fecha = Carbon::parse($evento->fecha); // la funcion parse() es para poder obtener el dia, mes y año de la fecha y carbon es una libreria para poder obtener el dia, mes y año de la fecha
        $meses = ['', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        $dia = $fecha->day < 10 ? '0' . $fecha->day : $fecha->day;
        $base64 = "data:image/png;base64," . base64_encode(file_get_contents($ruta));
        $url_certificado = route('documento', ['certificado_id' => $certificado->id]);
        $qr_code = new QrCode(
            data: $url_certificado,
            encoding: new Encoding('UTF-8'),
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin, // el roundBlockSizeMode es para que el cuadrado del qr code sea redondo
            foregroundColor: new Color(0, 0, 0), // el foregroundColor es para que el color del qr code sea negro
            backgroundColor: new Color(255, 255, 255), // el backgroundColor es para que el color del cuadrado del qr code sea blanco

        );
        $writer = new PngWriter();
        $result = $writer->write($qr_code);
        $qr_code = $result->getDataUri(); // el getDataUri() es para obtener el qr code en base64 y lo pasa a un string
        $pdf = PDF::loadView(
            'admin.plantillas.certificado_academico',
            [
                'evento' => $evento,
                'user' => $user,
                'tipo' => $tipo,
                'base64' => $base64,
                'meses' => $meses,
                'dia' => $dia,
                'fecha' => $fecha,
                'qr_code' => $qr_code,
                'url_certificado' => $url_certificado,
            ]
        )->setPaper('a4', 'landscape')->setOption('dpi', 120)->setOption('image_pdi', 300); // forma en como quieres que se vea la imagen
        return $pdf->stream('certificado.pdf'); // forma en como quieres que se vea el pdf download es para descargar y stream es para ver
    }
    public function exportOrganizadores($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $organizadores = $evento->organizadores()->select('paternal_surname', 'maternal_surname', 'name', 'email')->get();
        return Excel::download(new OrganizadoresExport($organizadores), 'organizadores.xlsx'); // el organizaodres.xlsx es el nombre del archivo que se va a descargar
    }

    public function exportPonentes($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $ponentes = $evento->ponentes()->select('paternal_surname', 'maternal_surname', 'name', 'email')->get();
        return Excel::download(new PonentesExport($ponentes), 'ponentes.xlsx'); // el organizaodres.xlsx es el nombre del archivo que se va a descargar
    }

    public function exportAsistentes($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        $asistentes = $evento->asistentes()->select('paternal_surname', 'maternal_surname', 'name', 'email')->get();
        return Excel::download(new AsistentesExport($asistentes), 'asistentes.xlsx'); // el organizaodres.xlsx es el nombre del archivo que se va a descargar
    }
}
