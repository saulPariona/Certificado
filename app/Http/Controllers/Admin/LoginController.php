<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where("email", $request->email)->first(); // el first() me trae el primer registro, el usuario ingresa una email como un request
        if (!$user) { // aqui se verifica si el usuario existe con el email compara con la base de datos en sql es asi SELECT * FROM users WHERE email = $request->email LIMIT 1 (por la funcion first()) 
            return view('admin.login', ['error' => 'Email incorrecto']);
        }
        if (!Hash::check($request->password, $user->password)) { // aqui se verifica si la contraseña es correcta compara con la base de datos en sql es asi SELECT * FROM users WHERE password = $request->password
            return view('admin.login', ['error' => 'Contraseña incorrecta']);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) { // aqui se verifica si el usuario esta autenticado en sql es asi SELECT * FROM users WHERE email = $request->email AND password = $request->password
            $request->session()->regenerate(); // el auth::attempt() me autentica el usuario y el session()->regenerate() me genera una sesion nueva
            return redirect()->route('dashboard'); // redirige al dashboard
        }
        return view('admin.login', ['error' => 'Error desconocido']); // si no se cumple ninguna de las anteriores
    }
    public function getLogin()
    {
        return view('admin.login');
    }
}
