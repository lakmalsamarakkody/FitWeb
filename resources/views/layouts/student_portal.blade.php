<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('img/logo/fav.png') }}">

  <title>FIT -Portal | {{ $title ?? '' }}</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- STYLES -->
    <!-- BOOTSTRAP -->      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- FONT AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/all.css') }}">
    <!-- LINE AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/line-awesome/css/line-awesome.css') }}">
    <!-- ANIMATE -->        <link rel="stylesheet" href="{{ asset('lib/animate/animate.min.css') }}">
    <!-- DROPZONE -->       <link rel="stylesheet" href="{{ asset('lib/dropzone/drop-zone.css') }}">

    <!-- DATATABLE  -->
    <link rel="stylesheet" href="{{ asset('lib/datatables/css/dataTables.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('lib/datatables/css/dataTables.bootstrap4.min.css') }}" >
    <!-- DATATABLE -->

    <!-- PAGES -->
    <link rel="stylesheet" href="{{ asset('css/portal/core.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portal/student/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portal/student/registration.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portal/student/information.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portal/student/exams.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portal/student/results.css') }}">
    <!-- /PAGES -->
  <!-- /STYLES -->

  <!-- SCRIPTS -->
    <script src="{{ asset('js/app.js') }}" differ></script>

    <!-- SWEET ALERT 2 -->
    <script src="{{ asset('lib/sweetalert2/sweetalert2.all.js') }}"></script>
    <!-- /SWEET ALERT 2 -->

    <!-- DATATABLE SCRIPTS -->
    <script src="{{ asset('lib/jquery/jquery.validate.js') }}"></script>
    <script src="{{ asset('lib/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- /DATATABLE SCRIPTS -->

    <script src="{{ asset('js/portal.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>

    {{-- CUSTOM --}}
    <script type="text/javascript">
      function display_c(){
        var refresh=1000; // Refresh rate in milli seconds
        mytime=setTimeout('display_ct()',refresh)
      }
      function display_ct() {
        var dt = new Date()
        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        // SET LEADING ZEROS
        if(dt.getHours() < 10){var hours = "0" +dt.getHours()}else{var hours = dt.getHours()}
        if(dt.getMinutes() < 10){var minutes = "0" + dt.getMinutes()}else{var minutes = dt.getMinutes()}
        if(dt.getSeconds() < 10){var seconds = "0" + dt.getSeconds()}else{var seconds = dt.getSeconds()}
        // /SET LEADING ZEROS

        var date = days[dt.getDay()] + " " + dt.getDate() + " " + months[dt.getMonth()] + " " + dt.getFullYear()
        var time = hours + " : " + minutes + " : " + seconds
        document.getElementById('ct').innerHTML = date + " - " + time;
        display_c();
      }
    </script>
    {{-- /CUSTOM --}}
  <!-- /SCRIPTS -->
</head>

<body onload=display_ct();>

    <!-- Page container-fluid -->
    <div class="container-fluid">
      <div class="row">

        <!-- SIDE BAR -->
        <div class="col-lg-2 sidebar">
          <div class="row">

            <div class="w-100">
              <div class="img mt-3 px-4">
                <a class="float-left" href="/"><img class="mb-3" src="{{ url('img/logo/fit-nav.png') }}" alt="" title="" style="width: 50px;"/></a>
                <a class="float-right" href="/"><img class="mb-3" src="{{ url('img/logo/invert-ucsc.png') }}" alt="" title="" style="width: 45px;"/></a>
              </div>
            </div>

            <!-- USER DETAILS SECTION -->
            <div class="user w-100 text-center">
              <div class="img mt-3 mb-2">
                <img src="{{ asset('storage/portal/avatar'.'/'.Auth::user()->id.'/'.Auth::user()->profile_pic) }}" alt="Avatar" class="avatar" width="50%" onError="this.onerror=null;this.src='{{ asset('img/portal/avatar/default.jpg') }}';">

              </div>
              <p class="mb-0 text-white">Hello! {{ Auth::user()->name }}</p>
              <p class="text-white"><small>{{ Auth::user()->role->name }}</small> </p>
            </div>
            <!-- /USER DETAILS SECTION -->

            <hr width="90%"/>

            <!-- MENU SECTION -->
            <div class="nav-menu w-100">
              <ul>
                @if ( Auth::user()->student == null || Auth::user()->student->reg_no == null )
                  <li id="registration"><a href="{{ route('student.registration') }}">Registration</a></li>
                @endif
                <li id="home"><a href="{{ route('student.home') }}">Home</a></li>
                <li id="information"><a href="{{ route('student.information') }}">Information</a></li>
                    @if ( Auth::user()->student !=Null && Auth::user()->student->current_registration->registration_expire_at !=Null && Auth::user()->student->current_registration->registration_expire_at >= date('Y-m-d') && Auth::user()->student->current_registration->status == 1  )
                  <li id="exams"><a href="{{ route('student.exam') }}">Exams</a></li>
                @endif
                <li id="results"><a href="{{ route('student.results') }}">Results</a></li>
              </ul>

                <div class="logout-menu w-100 text-center " style="display:flex; align-items:flex-end;">
                  <div class="py-3 justify-content-center align-content-center" style="position: absolute; bottom: 0; left: 0; width: 100%;">

                    {{-- <a  title="Logout" data-tooltip="tooltip"  data-placement="bottom"  class="text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="logout fa fa-power-off"></i>
                    </a> --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                  </div>

                </div>

            </div>
            <!-- /MENU SECTION -->

          </div>
        </div>
        <!-- /SIDE BAR -->

        <!-- PAGE AREA -->
        <div class="col-lg-10 page-area">
          <div class="row">

            <!-- NAV BAR -->
            <div class="col-lg-12 nav-bar shadow-sm">
              <div class="row  p-2">

                <div class="col-3">
                  <h4 class=" text-left p-0 m-0"><a href="">FIT | UCSC <br> <small>Student Portal</small></a> </h5>
                </div>

                <div class="col-6 text-center">
                  <span id="ct" class="navbar-text text-white"></span>
                    {{-- <a class=" mr-3" href="/"><img class="mb-3" src="{{ url('img/logo/fit-nav.png') }}" alt="" title="" style="width: 50px;"/></a>


                  <a class="navbar-brand p-0 m-0" href="{{ url('/') }}">
                    <p class="m-0">Foundation of Information Technology<br>
                    <small>University of Colombo School of Computing</small> </p>

                  </a>

                    <a class=" mt-0 ml-3" href="/"><img class="mb-3" src="{{ url('img/logo/invert-ucsc.png') }}" alt="" title="" style="width: 45px;"/></a>
                  --}}
                </div>
                <div class="col-3 text-right">
                  <button onclick="location.replace('{{ route('student.information') }}')" title="Settings" data-tooltip="tooltip"  data-placement="bottom" class="btn btn-link btn-lg nav-item"><i class="fa fa-cog"></i></button>
                  <button title="Logout" data-tooltip="tooltip"  data-placement="bottom" class="btn btn-link btn-lg  pr-5 nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i></button>
                </div>

              </div>
            </div>
            <!-- /NAV BAR -->

            <!-- MOBILE NAV BAR -->
            <div class="col-12 mobile-nav py-2 mb-3">
              <div class="row">
                <div class="col-6"><a href="">FIT | UCSC<small> &nbsp;Student Portal</small></a></div>
                <div class="col-6 text-right align-self-center"><i class="fa fa-bars fa-2x" data-toggle="collapse" data-target="#collapseMobileNav" aria-expanded="false"></i></div>
                <div class="col-12 mt-2 px-0 collapse border-top border-darken-1" id="collapseMobileNav">
                  <ul>
                    @if ( Auth::user()->student == null || Auth::user()->student->reg_no == null )
                      <li id="registration"><a href="{{ route('student.registration') }}">Registration</a></li>

                    @endif
                    <li id="home"><a href="{{ route('student.home') }}">Home</a></li>
                    <li id="information"><a href="{{ route('student.information') }}">Information</a></li>
                    
                    @if ( Auth::user()->student !=Null && Auth::user()->student->current_registration->registration_expire_at !=Null && Auth::user()->student->current_registration->registration_expire_at >= date('Y-m-d') && Auth::user()->student->current_registration->status == 1  )
                      <li id="exams"><a href="{{ route('student.exam') }}">Exams</a></li>
                    @endif
                    <li id="results"><a href="{{ route('student.results') }}">Results</a></li>
                    <li id="logout"><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- /MOBILE NAV BAR -->

            <main class="col-lg-12 py-md-4 px-md-5 min-vh-100">
              <div class="row">
                    @yield('content')
              </div>
              <button title="Go to Top" data-tooltip="tooltip"  data-placement="bottom"  onclick="topFunction()" id="myBtn"><i class="fa fa-chevron-up"></i></button>
            </main>



          </div>
        </div>
        <!-- PAGE AREA -->

        <!-- FOOTER -->
        <div class="col-12 mt-5 foot" style="bottom: 0;">
          <hr class="bg-primary" width="100%"/>
          <div class="row">

          <div class=" w-100 text-right pb-2 pr-3" >
            Copyright &copy;  {{ now()->year }}<strong><a target="_blank" href="https://ucsc.cmb.ac.lk/" > UCSC</a> </strong>. All Rights Reserved |
            Powered by <strong><a target="_blank" href="http://www.e-learning.lk/">e-Learning Center - UCSC </a> </strong>
          </div>
          </div>
        </div>
        <!-- /FOOTER -->
      </div>
    </div>
    <!-- /Page container-fluid -->
</body>
<!-- DROPZONE JS--> <script src="{{ asset('lib/dropzone/drop-zone.js') }}"></script>
@yield('script')

<script type="text/javascript">
//Get the button:
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>
</html>


