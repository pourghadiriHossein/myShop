<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use function Symfony\Component\Console\Style\section;

class UserController extends Controller
{
    public function login()
    {
        return view('public.login.loginIndex');
    }

    public function register()
    {
        return view('public.register.registerIndex');
    }

    public function postLogin(LoginRequest $request)
    {
        $user = User::where('phone', $request->input('phone'))->first();
        if ($user)
        {
            if(Hash::check($request->input('password'), $user->password))
            {
                Auth::login($user,true);
                return redirect(route('adminVisitUser'));
            }else
                return redirect()->back()->with('danger', 'رمز عبور صحیح نیست');
        }else
            return redirect()->back()->with('success', 'کاربر مورد نظر وجود ندارد! لطفا ثبت نام کنید');
    }

    public function postRegister(RegisterRequest $request)
    {
        $newUser = array_merge(
            ['name' => $request->input('name')],
            ['phone' => $request->input('phone')],
            ['email' => $request->input('email')],
            ['password' => Hash::make($request->input('password'))]
            );
        $checkUser = User::where('phone',$request->input('phone'))
            ->orWhere('email',$request->input('email'))->first();
        if (!$checkUser)
        {
            $user = User::create($newUser);
            $user->assignRole(Role::findByName('user'));
            Auth::login($user,true);
            return redirect(route('adminVisitUser'));
        }else
            return redirect()->back()->with('danger','کاربری با این شماره تماس یا پست الکترونیک وجود دارد!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect(route('publicHome'));
    }
}
