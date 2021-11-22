<?php

namespace App\Http\Controllers;

use App\Models\Kirim;
use App\Models\Order;
use App\Models\Produk;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\orderDetail;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = \Cart::getContent();
        $kurirs = Kirim::all();
        return view('cart.index', compact('items', 'kurirs'));
    }

    public function add(Request $request){
        $produk = Produk::find($request->input('idProduk'));
        \Cart::add([
            'id' => $produk->id,
            'name' => $produk->namaProduk,
            'quantity' => $request->input('jumlah'),
            'price' => $produk->hargaProduk
        ]);

        // Cart::add($produk->id, $produk->namaProduk, $request->input('jumlah'), $produk->hargaProduk, $produk->beratProduk);
        return redirect()->back()->with('messageAdd', 'Produk added to cart');
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
        
        if(Auth::check()){

            $items = \Cart::getContent();

            $order = Order::create([
                'orderDate' => Carbon::now(),
                'idCustomer' => Auth::id(),
                'idKirim' => $request->input('kurir')
            ]);


            $orderDetail = new orderDetail();
            
            foreach ($items as $item) {
                $orderDetail->jumlahBarang = $item->quantity;
                $orderDetail->idProduk = $item->id;
                $orderDetail->idOrder = $order->id;
                $orderDetail->totalHarga = $request->input('totalHarga');
            }

            $orderDetail->save();

            \Cart::clear();
            return redirect()->route('shop')->with('messageCheckout', 'Berhasil beli');
        }else{
            \Cart::clear();
            return redirect()->route('user.login');
        }
    }

    public function clear(){
        \Cart::clear();
        return redirect()->back()->with('messageClear', 'Keranjang berhasil dibersihkan');
    }
}
