<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function config()
    {
        return view('user.config');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:100', 'unique:users,nick,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ]);

        if (!empty($request->input('new-password'))) {
            $validate = $this->validate($request, [
                'new-password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $newPass = $request->input('new-password');
            $user->password = bcrypt($newPass);
        }
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        $user->update();

        return redirect()->route('config')->with('mensaje', 'Se ha actualizado');
    }
}
