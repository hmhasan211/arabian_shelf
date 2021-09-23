@extends('layouts.master')

@section('content')

    <!-- user deshboard Begin-->
    <div class="container  spad ordertable">
        <div class="row profile">
            <div class="col-sm-12 col-md-3 col-lg-2">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profiles-userpic">
                        <img src="{{asset('/userImage/'. Auth::user()->userprofile->imagePath)}}" onerror="this.src='{{asset('/userImage/profile.png')}}'" class="img-responsive rounded-circle">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                        {{ Auth::user()->name }} <br>
                        <b> User Point:{{Auth::user()->userprofile->user_point}}</b>
                        </div>

                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                            <form  action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                @csrf


                                <button type="submit" class="btn badge-dark btn-sm">Logout</button>
                            </form>

                        <!-- <button type="button" class="btn btn-link btn-sm">Message</button> -->
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">

                        <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                role="tab" aria-controls="v-pills-home" aria-selected="true">USER PROFILE</a>
                            <a class="nav-link " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-editprofile"
                                role="tab" aria-controls="v-pills-home" aria-selected="true">Edit PROFILE</a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                                role="tab" aria-controls="v-pills-profile" aria-selected="false">Order</a>
                            <!-- <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages"
                                role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings"
                                role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a> -->

                        </div>

                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-10">

                <section class="content" style="border: 1px solid black">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-12">
                          <div class="callout callout-info">
                            <h1 style=" margin-left: 38%;" ><i"></i> Invoice</h1>
                          </div>


                          <!-- Main content -->
                          <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                              <div class="col-12">
                                <h4>
                                     <img src="{{ URL::asset('/assets/frontend/img/logo_fa.jpg')}}" alt="" style=" width:150px">
                                     <span style="display:inline"></span>
                                     <img  src="{{ URL::asset('/assets/frontend/img/logo1.png')}}" alt="" style="height: 80px; width:70px; margin-left: 28%; margin-bottom: 30px;
                                     ">
                                  <small style="padding: 66px;" class="float-right"> Issue Date : {{$orders->created_at->format('d-m-Y')}}</small>
                                </h4>
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                              <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                  <strong>Arabian Shelf.</strong><br>
                                  <small>(BIN: 001851575-0101 )</small><br>
                                  Aisha Tower 205/1, <br>
                                  Bir Uttam Mir Shawkat Sarak,<br> Dhaka 1208 <br>
                                  Phone: (+880) 197 0034044<br>
                                  Email: info@arabianshelf.com
                                </address>
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                  <strong>
                                      @if($orders->user_id == Null)
                                         Guest
                                        @else
                                        {{$orders->user->name}}
                                        @endif
                                </strong><br>
                                {{$orders->shipping_address}}<br>
                                {{$orders->city}}<br>
                                {{$orders->country}}<br>
                                  Phone: {{$orders->phone}}<br>
                                  Email: {{isset($orders->user->email) ? $orders->user->email:' n/a'}}
                                </address>
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-4 invoice-col">
                                <table border="1px">
                                    <tr>
                                        <th>Invoice no: </th>
                                        <td>{{$orders->order_unique_id}} </td>
                                    </tr>
                                </table>
                                {{-- <b>Transection ID : </b> {{ isset($orders->transaction_id) ?  $orders->transaction_id: n/a }} <br>
                                <b>Invoice no: {{$orders->order_unique_id}}</b><br>
                                <b >Status:</b><i class="badge badge-warning"> {{$orders->status}} </i> --}}
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                              <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                  <tr>
                                    <th> Sl.</th>
                                    <th>product Name</th>
                                    <th>Qty</th>
                                    <th>Unit price</th>
                                    <th>Amount</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    @php
                                    $i=0
                                    @endphp
                                    @foreach($orders->orderitems as $orderitem)
                                    @php $i=$i+1 @endphp
                                        <tr>
                                            <td>#{{$i}}</td>
                                            <td>{{$orderitem->name}}</td>
                                            <td>{{$orderitem->qty}}</td>
                                            <td>{{$orderitem->price}}</td>
                                            <td>{{$orderitem->totalprice}}</td>
                                        </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                              <!-- accepted payments column -->
                              <div class="col-6">
                                <p class="lead">Payment Method:</p>
                                @if ($orders->payment_type == 'cash_on')
                                    <img src="{{ URL::asset('/assets/frontend/img/cashondelivery.png')}}" width="80px"  style="margin-left: 30px;" alt="cashondelivery">
                                @else
                                    <img src="{{ URL::asset('/assets/frontend/img/digital.jpeg')}}" width="80px" style="margin-left: 30px;"  alt="digitalpay">
                                @endif

                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                  Note: By purchasing this product(s), you agree to the terms and condition, Privacy Policy and Return/Refund policy of <a href="https://arabianshelf.com/">arabianshelf.com</a>
                                </p>

                              </div>
                              <!-- /.col -->
                              <div class="col-6">
                                {{-- <p class="lead">Amount Due 2/22/2014</p> --}} <br>

                                <div class="table-responsive">
                                  <table class="table">
                                    <tr>
                                      <th style="width:50%">Subtotal:</th>
                                      <td>&#2547;{{$orders->total_amount_before_cupon_point}}</td>
                                    </tr>
                                    @if($orders->coupon != "null")
                                    <tr>
                                      <th>Coupon:</th>
                                      <td>&#2547;{{$orders->coupon_price}}</td>
                                    </tr>
                                    @endif
                                    @if($orders->digital_pay_charge != "no")
                                    <tr>
                                      <th>Transaction charge:</th>
                                      <td>&#2547;{{$orders->digital_pay_charge_amount}}</td>
                                    </tr>
                                    @endif
                                    @if($orders->point != "not_apply")
                                    <tr>
                                      <th> Congratulation! For Point (15%) Reduce</th>
                                      <td>&#2547;{{$orders->total_amount}}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                      <th> Delivery charge:</th>
                                      <td>&#2547;{{$orders->delivery_charge}}</td>
                                    </tr>
                                    <tr>
                                      <th>Total Amount(VAT Inc.)</th>
                                      <td>&#2547;{{$orders->total_amount}}</td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                              <div class="col-12">
                                {{-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                  Payment
                                </button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                  <i class="fas fa-download"></i> Generate PDF
                                </button> --}}
                                {{-- <form action="{{route('super.view-order-invoice-print',['id'=>$orders->id])}}" method="POST">
                                  @csrf
                                  <button type="submit" target="_blank" style="margin-left: 44%;" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                                </form> --}}

                              </div>
                            </div>
                          </div>
                          <!-- /.invoice -->
                        </div><!-- /.col -->
                      </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                  </section>
            </div>
        </div>
    </div>
    <!-- user deshboard end -->

@endsection
