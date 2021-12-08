<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use App\Models\Customer;
use App\Models\Kategori;
use App\Models\orderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 0){
            abort(404);
        }else{
            $produks = Produk::all();
            $kategori = Kategori::all();
            return view('admin.index', [
                'produks' => $produks,
                'kategori' => $kategori
            ]);
        }
    }
    
    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function loginPost(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return redirect()->back();
    }

    public function registerPost(Request $request){
        $user = $request->validate([
            'email' => 'required|email|unique:customers',
            'nama' => 'required',
            'password' => 'required',
        ]);

        $user['password'] = bcrypt($user['password']);

        Customer::create($user);
        return redirect()->route('user.login');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {   
        $id = Auth::id();
        $orders = Order::where('idCustomer', $id)->get();
        // dd($orders);
        
        $orderId = [];
        $orderDetails = [];
        foreach ($orders as $order) {
            $orderId[] = array('id' => $order->id);
        }

        foreach ($orderId as $item) {
            $orderDetails[] = orderDetail::where('idOrder', $item)->get();
        }

        return view('profile', [
            'customer' => Auth::user(),
            'orderDetails' => $orderDetails,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
