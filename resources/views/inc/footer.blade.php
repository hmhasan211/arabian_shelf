<!-- Footer Section Begin -->
<footer class="footer-section">
        <div class="container">
            <div class="row ">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img src="{{ URL::asset('/assets/frontend/img/logo.png')}}" alt="" style="width: 150px;height: 150px;"></a>
                        </div>
                        <ul>
                            <li>Aisha Tower 205/1, Bir Uttam Mir Shawkat Sarak, Dhaka 1208</li>
                            <li>Phone: +880 197 0034044 ,<br>
                                +880 171 3034044</li>
                            <li>Email:info@arabianshelf.com</li>
                            <li>BIN: 001851575-0101</li>
                        </ul>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="{{route('about')}}">About Us</a></li>
                            <li><a href="{{route('terms_condition')}}">Terms & Conditions</a></li>
                            <li><a href="{{route('terms_condition')}}">Privacy Policy</a></li>
                            <li><a href="{{route('terms_condition')}}">Return Refund Policy</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Service</a></li>
                        </ul>
                        {{-- subscription --}}
                    <div class="footer-widget" >
                        <h5>Subscribe </h5>
                        <ul>
                            <div class="">
                                <form  method="post" action="{{route('subscriber.store')}}">
                                    @csrf
                                    <input style="width: 100%"  class="search" name="email" type="email" placeholder="Enter your mail">
                                    <button class="btn btn-sm btn-dark" type="submit"><i></i>Click </button>
                                </form>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>Our Facebook Page</h5>
                        <ul>
                            {{-- <li><a href="https://www.facebook.com/arabianshelf/">Facebook</a></li> --}}
                            <li><div class="fb-page" data-href="https://www.facebook.com/arabianshelf/" data-tabs="timeline" data-width="" data-height="242px" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/arabianshelf/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/arabianshelf/">Arabian Shelf</a></blockquote></div></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Payment Methods</h5>
                        <!-- <p>Get E-mail updates about our latest shop and special offers.</p> -->
                        <!-- <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">Subscribe</button>
                        </form> -->
                        <img src="{{ URL::asset('/assets/frontend/img/ssl.png')}}" alt="" style="width: 380px;height: 400px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="copyright-text ">
                        Website developed by NXGIT.
                            Copyright &copy;
                            2021 all rights reserved by arabianshelf.com an ecommerce platform by FAKHRUDDIN ASSOCIATES.

                        </div>
                        <!-- <script>document.write(new Date().getFullYear());</script> -->
                        <!-- <div class="payment-pic">
                            <img src="img/payment-method.png" alt="">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
