<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Petshop;
use App\OrderProduct;
use Session;
use DB;

class PetshopController extends Controller
{
    public function show_register()
    {
        return view('petshop.sign-up');
    }

    public function show_login()
    {
        return view('petshop.sign-in');
    }

    public function create(Request $request)
    {
        $petshop = new Petshop([
            'name' => $request->get('name'),
            'telephone_number' => $request->get('telephone_number'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'password' => md5($request->get('password'))
        ]);

        $petshop->save();

        return redirect('petshop/login')->with('success','Registration Success');
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = md5($request->get('password'));
        $petshop_temp = Petshop::where('email',$email)->first();
        if($petshop_temp->password == $password)
        {
            Session::put('type-petshop','petshop');
            Session::put('type-petshop-id',$petshop_temp->id);
            Session::put('type-petshop-name',$petshop_temp->name);
            return redirect('/index');
        }
        else
        {
            return back()->withInput();
        }
    }

    public function logout()
    {
        Session::forget('type-petshop');
        Session::forget('type-petshop-id');
        Session::forget('type-petshop-name');
        return redirect('/index');
    }

    public function show_profile()
    {
        $profile = DB::table('petshop')->where('petshop.id','=',Session::get('type-petshop-id'))->first();
        return view('profile',['profile'=>$profile]);
    }
}