<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where("email", $request->email)->first(); // el first() me trae el primer registro, el usuario ingresa una email como un request
        if ($user->isAn('admin')) { // isAn es un metodo de spatie para verificar si el usuario tiene un rol en este caso admin
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) { // aqui se verifica si el usuario esta autenticado en sql es asi SELECT * FROM users WHERE email = $request->email AND password = $request->password
                $request->session()->regenerate(); // el auth::attempt() me autentica el usuario y el session()->regenerate() me genera una sesion nueva
                return redirect()->route('dashboard'); // redirige al dashboard
            }
            return view('admin.login', ['error' => 'password incorrecto']); // si no se cumple ninguna de las anteriores
        }
        return view('admin.login', ['error' => 'No tienes permiso para acceder al panel de administracion']); // si no se cumple ninguna de las anteriores
    }
    public function getLogin()
    {
        return view('admin.login');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // cierra la sesion

        $request->session()->invalidate(); // invalida la sesion

        $request->session()->regenerateToken(); // regenera el token

        return redirect()->route('login'); // redirige al login
    }
}
