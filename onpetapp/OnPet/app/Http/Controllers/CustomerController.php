<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\OrderProduct;
use Session;
use DB;

class CustomerController extends Controller
{
    public function show_register()
    {
        return view('customer.sign-up');
    }

    public function show_login()
    {
        return view('customer.sign-in');
    }

    public function create(Request $request)
    {
        $customer = new Customer([
            'name' => $request->get('name'),
            'telephone_number' => $request->get('telephone_number'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'password' => md5($request->get('password'))
        ]);

        $customer->save();

        return redirect('customer/login')->with('success','Registration Success');
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = md5($request->get('password'));
        $customer_temp = Customer::where('email',$email)->first();
        if($customer_temp->password == $password)
        {
            Session::put('type-customer','customer');
            Session::put('type-customer-id',$customer_temp->id);
            Session::put('type-customer-name',$customer_temp->name);
            return redirect('/index');
        }
        else
        {
            return back()->withInput();
        }
    }

    public function logout()
    {
        Session::forget('type-customer');
        Session::forget('type-customer-id');
        Session::forget('type-customer-name');
        return redirect('/index');
    }

    public function show_profile()
    {
        $profile = DB::table('customer')->where('customer.id','=',Session::get('type-customer-id'))->first();
        return view('profile',['profile'=>$profile]);
    }
}