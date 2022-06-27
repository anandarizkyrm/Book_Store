<?php

namespace App\Http\Controllers;
use App\Notifications\StatusNotification;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Shipping;
use Carbon\Carbon;
use App\Models\User;
use PDF;
use Notification;
use Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::orderBy('id','ASC')->where('status' , '!=', 'cancelled')->get();
        return view('admin.order.index')->with('orders',$orders);
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

    public function store(Request $request){
     
        $this->validate($request,[
            'first_name'=>'string|required',
            'last_name'=>'string|required',
            'address'=>'string|required',
            'transfer_evidence'=>'image|file|max:2048',
            'city' =>'required',
            'ongkir'=>'string|required',
            'phone'=>'numeric|required',
            'post_code'=>'string|nullable',
            'email'=>'string|required'
        ]);
        
     
        if(empty(Cart::where('user_id',auth()->user()->id)->where('order_id',null)->first())){
            request()->session()->flash('error','Cart is Empty !');
            return back();
        }
     
        $order=new Order();
      
        $order_data=$request->all();
      
        $order_data['order_number']='ORD-'.strtoupper(Str::random(10));
        $order_data['user_id']=$request->user()->id;
   
        // return session('coupon')['value'];
        $order_data['sub_total']=Helper::totalCartPrice();
        $order_data['quantity']=Helper::cartCount();
        $order_data['ongkir']=$request->ongkir;
        $order_data['city']=$request->city;
        $order_data['total_amount']=Helper::totalCartPrice() + $request->ongkir;
        if($request->file('transfer_evidence')){
            $order_data['transfer_evidence'] = $request->file('transfer_evidence')->store('transfer_evidence');    
        }


        
        // return $order_data['total_amount'];
        $order_data['status']="new";
        $order_data['payment_status']='paid';
        $order->fill($order_data);
        $status=$order->save();
        if($order)
        // dd($order->id);
            $users=User::where('role','admin')->first();
            $details=[
                'title'=>'New order created',
                'actionURL'=>route('order.show',$order->id),
                'fas'=>'fa-file-alt'
            ];
        Notification::send($users, new StatusNotification($details));
      
            session()->forget('cart');
            session()->forget('coupon');

        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $order->id]);
        

        // dd($users);        
        request()->session()->flash('success','Your product successfully placed in order');
        return redirect()->route('home');
    }

    public function cancelOrderView($id){
        return view('user-dashboard.layouts.order.cancel')->with('id' , $id);
    }

    public function canceledOrderViewAdmin(){
        $orders=Order::orderBy('id','ASC')->where('status' , '=', 'cancelled')->get();

        return view('admin.order.cancel')->with('orders', $orders);
    }

    public function cancelOrder(Request $request, $id){

        $order=Order::find($id);
        $this->validate($request,[
            'cancel_reason'=>'string|required'
        ]);
    
        $order_data=$request->all();
        $order_data['cancel_reason'] = $request->cancel_reason;
        $order_data['status'] = 'cancelled';

        session()->forget('cart');
        $status=$order->fill($order_data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated order');
        }
        else{
            request()->session()->flash('error','Error while updating order');
        }
       

        // dd($users);        
        request()->session()->flash('success','Your Order Cancelled');
        return redirect()->route('user.order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find($id);
        // return $order;
        return view('admin.order.show')->with('order',$order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $order=Order::find($id);
        return view('admin.order.edit')->with('order',$order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order=Order::find($id);
        $this->validate($request,[
            'status'=>'required|in:new,processing,delivered,cancelled'
        ]);
        $data=$request->all();
        // return $request->status;
        if($request->status=='delivered'){
            foreach($order->cart as $cart){
                $product=$cart->book;
                // return $product;
                $product->stock -=$cart->quantity;
                $product->save();
            }
        }
        $status=$order->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated order');
        }
        else{
            request()->session()->flash('error','Error while updating order');
        }
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function incomeChart(Request $request){
        $year=\Carbon\Carbon::now()->year;
        // dd($year);
        $items=Order::with(['cart'])->whereYear('created_at',$year)->where('status','delivered')->get()
            ->groupBy(function($d){
                return \Carbon\Carbon::parse($d->created_at)->format('m');
            });
            // dd($items);
        $result=[];
        foreach($items as $month=>$item_collections){
            foreach($item_collections as $item){
                $amount=$item->cart->sum('amount');
                // dd($amount);
                $m=intval($month);
                // return $m;
                isset($result[$m]) ? $result[$m] += $amount :$result[$m]=$amount;
            }
        }
        $data=[];
        for($i=1; $i <=12; $i++){
            $monthName=date('F', mktime(0,0,0,$i,1));
            $data[$monthName] = (!empty($result[$i]))? number_format((float)($result[$i]), 2, '.', '') : 0.0;
        }
        
        return $data;

    }

    public function check_ongkir(Request $request){
       
        $response = Http::withHeaders([
            'key' => 'ae86c96ad91b3b085792b8345dca809c'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => '36',
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => 'jne'
        ]);

    

        return $response->json();
    }
    public function pdf(User $user, Request $request)
    {
        $order=Order::getOrder($request->id);
        // return $order;
        $file_name=$order->order_number.'-'.$order->first_name.'.pdf';
        // return $file_name;
        $pdf=PDF::loadview('client.layout.print.invoice',compact('order'));
        return $pdf->stream('invoice.pdf');

    }

    public function all_order_pdf(User $user, Request $request)
    {
        $order=Order::getAllOrder( $request->start, $request->end);
        $pdf=PDF::loadview('client.layout.print.allorders',compact('order'), ['start' => $request->start, 'end' => $request->end]);
        return $pdf->stream('allorders.pdf');

    }

    public function cancelOrderPdf(User $user, Request $request)
    {
        $order=Order::getAllOrderCanceled( $request->start, $request->end);
        $pdf=PDF::loadview('client.layout.print.allcancell',compact('order'), ['start' => $request->start, 'end' => $request->end]);
        return $pdf->stream('allcancell.pdf');

    }

    

    public function chart_income_pdf(Request $request)
    {
        $year=\Carbon\Carbon::now()->year;
        // dd($year);
        $items=Order::with(['cart'])->whereYear('created_at',$year)->where('status','delivered')->get()
            ->groupBy(function($d){
                return \Carbon\Carbon::parse($d->created_at)->format('m');
            });
            // dd($items);
        $result=[];
        foreach($items as $month=>$item_collections){
            foreach($item_collections as $item){
                $amount=$item->cart->sum('amount');
                // dd($amount);
                $m=intval($month);
                // return $m;
                isset($result[$m]) ? $result[$m] += $amount :$result[$m]=$amount;
            }
        }
        $data=[];
        for($i=1; $i <=12; $i++){
            $monthName=date('F', mktime(0,0,0,$i,1));
            $data[$monthName] = (!empty($result[$i]))? number_format((float)($result[$i]), 2, '.', '') : 0.0;
        }
       
        $pdf=PDF::loadview('client.layout.print.chart',compact('data'));
        return $pdf->stream('chart.pdf');

    }

}
