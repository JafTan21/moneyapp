<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function login_to_user(Request $request)
    {
        $user = User::where('id', $request->user_id)
            ->firstOrFail();

        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        return redirect()->back();
    }

    public function delete_user(Request $request)
    {
        $user = User::where('id', $request->user_id)
            ->firstOrFail();

        if ($user) {
            $user->delete();
        }

        return redirect()->back();
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function update_profile(Request $request)
    {

        $user = User::where('id', $request->user_id)
            ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users,email,' . $user->id . ',id'],
            'password' => ['required'],
            'name' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        if (!Hash::check($request->password, $user->password)) {
            dd($user);
            return redirect()->back()
                ->with('error', 'Wrong Password');
        }

        $user->update([
            'email' => $request->email,
            'name' => $request->name
        ]);


        return redirect()->back();
    }

    public function change_password(Request $request)
    {

        $user = User::where('id', $request->user_id)
            ->firstOrFail();

        if ($request->new_password != $request->confirm_password) {
            return redirect()->back()
                ->with('password_error', 'Passwords did not match');
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()
                ->with('password_error', 'Wrong password');
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back();
    }
}