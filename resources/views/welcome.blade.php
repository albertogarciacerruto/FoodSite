<!DOCTYPE html>
<html class="no-js"  lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>FoodSite</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ url('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url('css/animate.css') }}">
    <link rel="stylesheet" href="{{ url('css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>

<body>

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-5 col-lg-5">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="{{url('/')}}" class="colortext">Home</a></li>
                                        <li><a href="{{url('login')}}" class="colortext">Entrar Administrador</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="index.html">
                                    <img src="{{ url('img/logo.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <div class="best_burgers_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <span>Menu</span>
                    </div>
                </div>
            </div>
            @foreach($categories as $category)
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <h3>{{$category->name}}</h3>
                    </div>
                </div>
            </div>
            
            <div class="row">
            @foreach($menu as $item)
                @if($item->category_id == $category->id)
                <div class="col-xl-6 col-md-6 col-lg-6">
                    <div class="single_delicious d-flex align-items-center">
                        <div class="thumb">
                            @if($item->video != 'public/product.jpg')
                            <video src="../storage/app/{{$item->video}}" autoplay muted loop height="120" width="120"></video>
                            @else
                            <img height="120" width="120" src="../storage/app/{{$item->image}}" alt="{{ $item->image }}">
                            @endif
                        </div>
                        <div class="info">
                            <h3>{{ $item->name }}</h3>
                            <p>{{ $item->description }}</p>
                            <?php $allergens = \DB::table('allergen_product')->where('product_id', '=', $item->id)->get();?>
                            <p>
                            @foreach($allergens as $allergen)
                            <?php $aller = \DB::table('allergens')->where('id', '=', $allergen->allergen_id)->first();?>
                            Álergenos: {{ $aller->name }} 
                            @endforeach
                            </p>
                            <span>{{ $item->amount }} €</span>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            @endforeach

        </div>
    </div>

    <footer class="footer">
            <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-lg-6">
                            <div class="footer_widget text-center ">
                                <h3 class="footer_title pos_margin">
                                        New York
                                </h3>
                                <p>Paseo de la castellana 52, <br> 
                                        Madrid - España 28000 <br>
                                        <a href="#">info@email.com</a></p>
                                <a class="number" href="#">+34 378 48 36 78</a>
    
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-lg-6">
                            <div class="footer_widget text-center ">
                                <h3 class="footer_title pos_margin">
                                    California
                                </h3>
                                <p>Calle valdivia numero 10, <br> 
                                        Madrid - España 28000 <br>
                                        <a href="#">info@email.com</a></p>
                                <a class="number" href="#">+34 378 48 36 78</a>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right_text">
                <div class="container">
                    <div class="footer_border"></div>
                    <div class="row">
                        <div class="col-xl-12">
                            <p class="copy_right text-center">
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


    <!-- JS here -->
    <script src="{{ url('js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ url('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ url('js/ajax-form.js') }}"></script>
    <script src="{{ url('js/waypoints.min.js') }}"></script>
    <script src="{{ url('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ url('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ url('js/scrollIt.js') }}"></script>
    <script src="{{ url('js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ url('js/wow.min.js') }}"></script>
    <script src="{{ url('js/nice-select.min.js') }}"></script>
    <script src="{{ url('js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ url('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('js/plugins.js') }}"></script>

    <!--contact js-->
    <script src="{{ url('js/contact.js') }}"></script>
    <script src="{{ url('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ url('js/jquery.form.js') }}"></script>
    <script src="{{ url('js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('js/mail-script.js') }}"></script>

    <script src="{{ url('js/main.js') }}"></script>

</body>

</html>