<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Order;
use App\Models\Volume;
use App\Models\Product;
use App\Models\Oderitem;

use Illuminate\Http\Request;

use App\Models\Orderinternal;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orderinternal::orderBy('created_at','DESC')->get();
        return view('admin.order.order')->with('orders', $orders);
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
    public function update(Request $request, $id)
    {
        //
    }
    // status change
    public function status_change(Request $request, $id)
    {
        // $ordervolume= Volume::where('name','=','100 ml')->first()->id;
        // dd($ordervolume);
        // dd($id,$request->all());
        $orders = Orderinternal::find($id);
        // dd($orders);
        if ($request->changestatus == "cancelled") {
            foreach ($orders->orderitems as $item) {
                // dd($orders->orderitems);
                if ($item->size != null && $item->volumename == null) {
                    $orderitem = Product::find($item->product_id);
                    if ($item->size == 's') {
                        $orderitemtemp = $orderitem->s + $item->qty;
                        $orderitemtotaltemp = $orderitem->total + $item->qty;
                        $orderitem->s = $orderitemtemp;
                        $orderitem->total = $orderitemtotaltemp;
                    } elseif ($item->size == 'm') {
                        $orderitemtemp = $orderitem->m + $item->qty;
                        $orderitemtotaltemp = $orderitem->total + $item->qty;
                        $orderitem->m = $orderitemtemp;
                        $orderitem->total = $orderitemtotaltemp;
                    } elseif ($item->size == 'l') {
                        $orderitemtemp = $orderitem->l + $item->qty;
                        $orderitemtotaltemp = $orderitem->total + $item->qty;
                        $orderitem->l = $orderitemtemp;
                        $orderitem->total = $orderitemtotaltemp;
                    } elseif ($item->size == 'xl') {
                        $orderitemtemp = $orderitem->xl + $item->qty;
                        $orderitemtotaltemp = $orderitem->total + $item->qty;
                        $orderitem->xl = $orderitemtemp;
                        $orderitem->total = $orderitemtotaltemp;
                    } elseif ($item->size == 'xxl') {
                        $orderitemtemp = $orderitem->xxl + $item->qty;
                        $orderitemtotaltemp = $orderitem->total + $item->qty;
                        $orderitem->xxl = $orderitemtemp;
                        $orderitem->total = $orderitemtotaltemp;
                    }

                    $orderitem->save();
                }
                if ($item->size == null && $item->volumename != null) {
                    $ordervolume = Volume::where('name', '=', $item->volumename)->first()->id;
                    $orderitem = Product::find($item->product_id);
                    $qty1 = $orderitem->volumes()->where('product_id', '=', $orderitem->id)->where('volume_id', '=', $ordervolume)->first()->pivot->qty;

                    $voulumetotalqtytemp = (int)$orderitem->total + (int)$qty1;

                    $volumeqtytemp = (int)$qty1 + (int)$item->qty;

                    $orderitem->total = $voulumetotalqtytemp;
                    $orderitem->save();
                    $orderitem->volumes()->updateExistingPivot($ordervolume, ['qty' => $volumeqtytemp]);
                }
            }

            $orders->status = "cancelled";
            $orders->save();
        } elseif ($request->changestatus == "pending") {
            $orders->status = "pending";
            $orders->save();
        } elseif ($request->changestatus == "processing") {
            $orders->status = "processing";
            $orders->save();
        } elseif ($request->changestatus == "completed") {
            $orders->status = "completed";
            $orders->save();

            $data['app'] = Orderinternal::find($id);
            $pdf = PDF::loadView('invoicepdf', $data)->setPaper('A4', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
            // $app=Orderinternal::find($id);

            $dat["email"] = $data['app']->email;
            $dat["subject"] = "invoice mail";
            $dat['pdf'] = $pdf->output();

            Mail::send([], $dat,  function ($message) use ($dat) {
                $message->to($dat["email"])
                    ->bcc('info@arabianshelf.com', 'Invoice')
                    ->subject($dat["subject"])
                    ->attachData($dat['pdf'], 'invoice.pdf', [
                        'mime' => 'application/pdf',
                    ])
                    ->setBody('
                    Dear Sir / Madam,
                    Thank you for purchase product from ARABIAN SHELF.

                    ');
            });
        }

        Toastr::info('Order Status Update Successfully', '', ["positionClass" => "toast-top-center", 'progressBar' => true, 'showDuration' => 20,]);
        return back();
    }

    //email sent customer

    public function email_sent(Request $request)
    {
        $data['app'] = Orderinternal::find($request->order_id_for_email_sent);

        $dat["email"] = $data['app']->email;
        $dat["subject"] = $request->email_subject;
        $dat["body"]  = $request->email_body;

        Mail::send([], $dat,  function ($message) use ($dat) {
            $message->to($dat["email"])

                ->subject($dat["subject"])

                ->setBody($dat["body"]);
        });
        return "Mail sent successfully!";
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


    // invoice generate
    public function viewOrderInvoice($id)
   {
       $orders = Orderinternal::find($id);

//       $total = OrderDetails::all()->where('order_id',$order->id)->sum(function ($t){
//           return $t->product_price * $t->product_quantity;
//       });
        return view('admin.order.invoice_order',compact('orders'));
   }

      // invoice pdf generate
      public function viewOrderInvoiceprint($id)
      {
          $orders = Orderinternal::find($id);
           return view('admin.order.invoice_order_pdf',compact('orders'));
      }

    //pdf generate
    // public function orderpdf($id)
    // {
    //     $data['app'] = Orderinternal::find($id);
    //     $pdf = PDF::loadView('invoicepdf', $data)->setPaper('A4', 'Potrait')->setOptions(['defaultFont' => 'sans-serif']);

    //     return $pdf->stream('invoice.pdf');
    // }


}
