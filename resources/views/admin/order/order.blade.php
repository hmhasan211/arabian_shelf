@extends('admin.master')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-xs-12 col-sm-12 col-md-12">


                <div class="card card-danger" >
                    <div class="card-header card-danger">
                        <h3 class="card-title">All Orders</h3>
                        <div class="card-tools ">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body box-body" style="display:none">
                        <table id="example2" class="table table-sm table-responsive-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Order Id</th>
                                <th> Name </th>
                                <th>Address</th>
                                <th>Payment Type</th>
                                <th>Transaction Id</th>
                                <th>Card Type</th>
                                <th>Bank Transaction Id</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $item)
                                    <tr>
                                        <td>{{$item->order_unique_id}}</td>
                                        <td>
                                            @if ($item->user != NULL )
                                                {{$item->user->name}}
                                            @else
                                                Guest
                                            @endif
                                        </td>
                                        <td>{{ \Illuminate\Support\Str::limit($item->shipping_address,'15')}}</td>
                                        <td>{{$item->payment_type}}</td>
                                        <td>{{$item->transaction_id}}</td>
                                        @if($item->payment_type =="digital_pay")
                                        <td>{{$item->order->card_type}}</td>
                                        <td>{{\Illuminate\Support\Str::limit($item->order->bank_tran_id,'5')}}</td>
                                        @else
                                        <td>--</td>
                                        <td>--</td>
                                        @endif
                                        <td>
                                        <form  action="{{route('super.order.order_status_change',$item->id)}}" method="post">
                                            @csrf


                                            <select name="changestatus" >
                                                <option {{$item->status == "pending"?'selected':''}} value="pending">Pending</option>
                                                <option  {{$item->status == "processing"?'selected':''}} value="processing">Processing</option>
                                                <option {{$item->status == "completed"?'selected':''}} value="completed">Completed</option>
                                                <option {{$item->status == "cancelled"?'selected':''}} value="cancelled">cancelled</option>
                                            </select>
                                            @if($item->status !="cancelled" && $item->status !="completed" )
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-xs btn-warning" type="submit">update</button>
                                            <!-- <a class="btn btn-xs btn-warning" type="submit" style="text-decoration:none;">Active</a> -->
                                            @endif
                                        </form>
                                        </td>
                                        <td>{{ $item->created_at->diffForhumans()}}</td>
                                        <!-- <td>{{ Carbon\Carbon::now()}}</td> -->
                                        <td>
                                        {{-- <button type="button" class="btn btn-sm btn-primary " data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}">
                                            View
                                        </button> --}}
                                        <a href="{{route('super.view-order-invoice',['id'=>$item->id])}}" target="_blank" class="btn btn-warning btn-xs"> Invoice </a>
                                        <a  data-toggle="modal" data-target="#exampleModalCenteremail{{$item->id}}"><i class="far fa-comment-dots"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Modal for email section -->
                                    <div class="modal fade" id="exampleModalCenteremail{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Send Email</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <form name="email_form">
                                                    <div class="form-group">
                                                        <label for="email_subject">Email Subject</label>
                                                        <input type="text" class="form-control" id="email_subject{{$item->id}}" >
                                                    </div>
                                                    <input type="hidden" id="order_id_for_email_sent{{$item->id}}" value="{{$item->id}}">
                                                    <div class="form-group">
                                                        <label for="email_body">Email Body</label>
                                                        <textarea class="form-control" id="email_body{{$item->id}}" rows="10"></textarea>
                                                    </div>
                                                    <button onclick="SendData(this)" value="{{$item->id}}" type="button" class="btn btn-primary">Save changes</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Action</th>
                                    <th>hh</th>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
