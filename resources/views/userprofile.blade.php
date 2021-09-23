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

            {{-- Profile --}}
                <div class="tab-content " id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <div class="titlebox">
                            <h2 class="titleprofile">User Profile </h2>
                        </div>

                        <div class="profile-content">

                            <div class="teacher-des">

                                <div class="content">

                                    <ul style="list-style-type:none;">
                                        <li><b>EMAIL &nbsp; &nbsp; &nbsp; &nbsp;:</b> &nbsp;
                                            &nbsp;{{ Auth::user()->email }}</li><br>
                                        <li><b>ADDRESS &nbsp;:</b> &nbsp; &nbsp;{{ Auth::user()->userprofile->address1 }}
                                        </li>
                                        <br>
                                        <li><b>COUNTRY&nbsp;:</b> &nbsp; &nbsp;{{ Auth::user()->userprofile->country }}</li>
                                        <br>
                                        <li><b>CITY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;:</b>
                                            &nbsp; &nbsp;{{ Auth::user()->userprofile->city }}</li><br>
                                        <li><b>ZIP CODE &nbsp;:</b> &nbsp; &nbsp;{{ Auth::user()->userprofile->zip }}</li>
                                        <li><b></b></li>

                                    </ul>
                                    <!-- <div style="padding-top:20px;">
                                        <a class="btn btn-secondary btn-sm" href="#" role="button"><Span>Edit
                                                Profile</Span></a>
                                    </div> -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade show " id="v-pills-editprofile" role="tabpanel"
                        aria-labelledby="v-pills-editprofile-tab">
                        <div class="titlebox">
                            <h2 class="titleprofile">Edit User Profile </h2>
                        </div>

                        <form class="pt-5" method="POST" action="{{route('profile.updatesave')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4 ">

                                    <label for="image">Image</label>
                                     <input type="file" accept="image/*" class="form-control-file" name="imagePath" id="image">

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender" class="form-control">
                                        <option selected>Choose...</option>
                                        <option {{Auth::user()->userprofile->gender=="male" ?'selected':''}} value="male">Male</option>
                                        <option {{Auth::user()->userprofile->gender=="female" ?'selected':''}} value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control"  name="phone" id="phone" value="{{ Auth::user()->userprofile->phone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" name="address1" placeholder="1234 Main St" value="{{ Auth::user()->userprofile->address1 }}">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2"> Shipping Address</label>
                                <input type="text" class="form-control" id="inputAddress2" name="shipping_address" placeholder="Apartment, studio, or floor" value="{{ Auth::user()->userprofile->shipping_address }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="country">Country</label>
                                    <select id="country" name="country" class="form-control">
                                        <option >Choose...</option>
                                        <option selected value="bangladesh">Bangladesh</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" name="city" id="inputCity" value="{{ Auth::user()->userprofile->city }}">
                                </div>

                                <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" name="zip" id="inputZip" value="{{ Auth::user()->userprofile->zip }}">
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Check me out
                                </label>
                                </div>
                            </div> -->
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                </div>


        {{-- order --}}
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <div class="titlebox">
                            <h2 class="titleprofile"> All Order </h2>
                        </div>
                        <!-- card start -->
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title"></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-sm table-responsive-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th>Order Id</th>
                                        <th>Payment Type</th>
                                        <th>Transaction Id</th>
                                        <th>Card Type</th>

                                        <th>Bank Transaction Id</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Order Date</th>
                                        <th>Action</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $item)
                                            <tr>
                                                <td>{{$item->order_unique_id}}</td>
                                                <td>{{$item->payment_type}}</td>
                                                <td>{{$item->transaction_id}}</td>
                                                @if($item->payment_type =="digital_pay")
                                                <td>{{$item->order->card_type}}</td>
                                                <td>{{$item->order->bank_tran_id}}</td>
                                                @else
                                                <td>--</td>
                                                <td>--</td>
                                                @endif

                                                <td>{{ $item->created_at->diffForhumans()}}</td>
                                                <!-- <td>{{ Carbon\Carbon::now()}}</td> -->
                                                <td>

                                                    <a href="{{route('user.invoice',['id'=>$item->id])}}" target="_blank" class="btn btn-warning btn-xs"> Invoice </a>
                                                </td>
                                            </tr>



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
                    <!-- <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                        aria-labelledby="v-pills-messages-tab">fbdb</div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                        aria-labelledby="v-pills-settings-tab">fbdfb</div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- user deshboard end -->

@endsection
