<?php

namespace App\Http\Controllers;

use App\Models\Kirim;
use App\Models\Order;
use App\Models\Produk;
use App\Models\orderDetail;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = session('cart');
        // dd($items);
        $kurirs = Kirim::all();
        return view('cart.index', compact('items', 'kurirs'));
    }

    public function add(Request $request, $id){
        $produk = Produk::find($id);
        if(!$produk){
            return abort(404);
        }
        // dd($id);
        $cart = session()->get('cart');

        if(!$cart){
            $cart = [
                $id => [
                    'idProduk' => $id,
                    'jumlah' => $request->input('jumlah'),
                    'namaProduk' => $produk->namaProduk,
                    'hargaProduk' => $produk->hargaProduk,
                    'idKategori' => $produk->idKategori,
                    'beratProduk' => $produk->beratProduk
                ]
            ];

            session()->put('cart', $cart);
            return redirect()->back();
        }

        // dd($cart);

        if(isset($cart[$id])){
            $cart[$id]['jumlah'] += $request->input('jumlah');
            session()->put('cart', $cart);
            return redirect()->back();
        }

        $cart[$id] = [
            'idProduk' => $id,
            'jumlah' => $request->input('jumlah'),
            'namaProduk' => $produk->namaProduk,
            'hargaProduk' => $produk->hargaProduk,
            'idKategori' => $produk->idKategori,
            'beratProduk' => $produk->beratProduk
        ];

        session()->put('cart', $cart);
        return redirect()->back();


        // \Cart::add([
        //     'id' => $produk->id,
        //     'name' => $produk->namaProduk,
        //     'quantity' => $request->input('jumlah'),
        //     'price' => $produk->hargaProduk
        // ]);

        // Cart::add($produk->id, $produk->namaProduk, $request->input('jumlah'), $produk->hargaProduk, $produk->beratProduk);
        // return redirect()->back()->with('messageAdd', 'Produk added to cart');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        \Cart::update(
            $request->input('idProduk'),
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->input('jumlah')
                ],
            ]
        );

        return redirect()->back()->with('messageUpdate', 'Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        \Cart::remove($request->id);
        return redirect()->back()->with('messageDelete', 'Delete success');
    }

    public function checkout(Request $request){
        $items = session('cart');
        if(Auth::check()){

            // $items = \Cart::getContent();

            $order = Order::create([
                'orderDate' => Carbon::now(),
                'idCustomer' => Auth::id(),
                'idKirim' => $request->input('kurir')
            ]);


            $orderDetail = new orderDetail();
            
            foreach ($items as $id => $detail) {
                // dd($order->id);
                $orderDetail->jumlahBarang = $detail['jumlah'];
                $orderDetail->idProduk = $detail['idProduk'];
                $orderDetail->idOrder = $order->id;
                $orderDetail->totalHarga = $request->input('totalHarga');
            }

            // dd($orderDetail);

            $orderDetail->save();

            // session('cart')->flush();
            foreach ($items as $id => $value) {
                unset($items[$id]);
                session()->put('cart', $items);
            }
            return redirect()->route('shop')->with('messageCheckout', 'Berhasil beli');
        }else{

            foreach ($items as $id => $value) {
                unset($items[$id]);
                session()->put('cart', $items);
            }
            return redirect()->route('user.login');
        }
    }

    public function clear(){
        \Cart::clear();
        return redirect()->back()->with('messageClear', 'Keranjang berhasil dibersihkan');
    }
}
