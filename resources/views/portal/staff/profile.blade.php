@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#students').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Students</a></li>
              <li class="breadcrumb-item active" aria-current="page">Student Profile</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->


    <!-- CONTENT -->
    <div class="col-lg-12 student">
      <div class="row">
        <!-- <div class="col-lg-2"></div> -->

        <div class="col-lg-12">

            <div class="card   ">
              <div class="card-header">
                Student Details
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-8">
                      <table class="table">
                          <tr>
                              <th>Registration Number:</th>
                              <td>John John</td>
                          </tr>
                          <tr>
                              <th>Email:</th>
                              <td>John@gmail.com</td>
                          </tr>
                          <tr>
                              <th>Telephone No:</th>
                              <td>+94777156654</td>
                          </tr>
                          <tr>
                              <th>Title:</th>
                              <td id="title">Mr.</td>
                          </tr>
                          <tr>
                              <th>Full Name:</th>
                              <td id="first_name">John John John John John John John John Doe</td>
                          </tr>
                          <tr>
                              <th>Name with Initials:</th>
                              <td id="middle_names">J J J J J J J J Doe</td>
                          </tr>
                      </table>

                  </div>
                  <div class="col-lg-4 ">  
                      <div class="row">                               
                          <div class="img my-2 text-center">
                              <img src="{{ asset('img/portal/avatar') }}/{{ Auth::user()->id }}.png" alt="Avatar" class="avatar" width="60%">
                          </div>

                      </div>   
                  </div>
                  <div class="col-lg-12">
                      <hr>
                      <div class="row">
                          <div class="col-lg-6">
                              <table class="table table-borderless">                        
                                  <tr>
                                      <th>BIT Eligibility:</th>
                                      <td><h4><span class="badge badge-success">Eligible</span></h4></td>
                                      <th>FIT Certificate:</th>
                                      <td><h4><span class="badge badge-danger">Not Eligible</span></h4></td>
                                  </tr>
                              </table>

                          </div>                       

                      </div>
                      <hr>
                      <div class="row">                        
                          <div class="col-lg-12" id="accordion">
                              <h4>Results</h4>
                              <div class="card">
                                <div class="card-header" id="headingOne">
                                  <h5 class="mb-0">
                                    <button class="btn w-100 text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                      2017
                                      <i class="fa fa-chevron-right float-right"></i>
                                    </button>
                                  </h5>
                                </div>
                            
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                  <div class="card-body">
                                      <table class="table w-100">
                                          <thead>
                                              <th>Subject</th>
                                              <th>Exam Type</th>
                                              <th>Result</th>
                                              <th>Medical</th>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <td>FIT103</td>
                                                  <td>E Test</td>
                                                  <td><h4><span class="badge badge-success">P</span></h4></td>
                                                  <td></td>
                                              </tr>
                                              <tr>
                                                  <td>FIT203</td>
                                                  <td>E Test</td>
                                                  <td><h4><span class="badge badge-danger">F</span></h4></td>
                                                  <td></td>
                                              </tr>
                                              <tr>
                                                  <td>FIT303</td>
                                                  <td>E Test</td>
                                                  <td><h4><span class="badge badge-light">N/A</span></h4></td>
                                                  <td><button class="btn btn-sm btn-warning px-32 text-center"><i class="fa fa-eye p-0"></i></button></td>
                                              </tr>
                                          </tbody>
                                      </table>                                
                                  </div>
                                </div>
                              </div>
                              <div class="card">
                                <div class="card-header" id="headingTwo">
                                  <h5 class="mb-0">
                                    <button class="btn  w-100 text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                      2018
                                      <i class="fa fa-chevron-right float-right"></i>
                                    </button>
                                  </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                  <div class="card-body">
                                      <table class="table w-100">
                                          <thead>
                                              <th>Subject</th>
                                              <th>Exam Type</th>
                                              <th>Result</th>
                                              <th>Medical</th>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <td>FIT103</td>
                                                  <td>Practical</td>
                                                  <td><h4><span class="badge badge-success">P</span></h4></td>
                                                  <td></td>
                                              </tr>
                                              <tr>
                                                  <td>FIT203</td>
                                                  <td>E Test</td>
                                                  <td><h4><span class="badge badge-danger">F</span></h4></td>
                                                  <td></td>
                                              </tr>
                                              <tr>
                                                  <td>FIT303</td>
                                                  <td>E Test</td>
                                                  <td><h4><span class="badge badge-light">N/A</span></h4></td>
                                                  <td><button class="btn btn-sm btn-warning px-32 text-center"><i class="fa fa-eye p-0"></i></button></td>
                                              </tr>
                                          </tbody>
                                      </table>                                
                                  </div>
                                </div>
                              </div>
                              <div class="card">
                                <div class="card-header" id="headingThree">
                                  <h5 class="mb-0">
                                    <button class="btn  w-100 text-left collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                      2019
                                      <i class="fa fa-chevron-right float-right"></i>
                                    </button>
                                  </h5>
                                </div>
                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
                                  <div class="card-body">
                                      <table class="table w-100">
                                          <thead>
                                              <th>Subject</th>
                                              <th>Exam Type</th>
                                              <th>Result</th>
                                              <th>Medical</th>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <td>FIT103</td>
                                                  <td>E Test</td>
                                                  <td><h4><span class="badge badge-success">P</span></h4></td>
                                                  <td></td>
                                              </tr>
                                              <tr>
                                                  <td>FIT203</td>
                                                  <td>E Test</td>
                                                  <td><h4><span class="badge badge-danger">F</span></h4></td>
                                                  <td></td>
                                              </tr>
                                              <tr>
                                                  <td>FIT303</td>
                                                  <td>E Test</td>
                                                  <td><h4><span class="badge badge-light">N/A</span></h4></td>
                                                  <td><button class="btn btn-sm btn-warning px-32 text-center"><i class="fa fa-eye p-0"></i></button></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                                </div>
                              </div>
                          </div>

                      </div>

                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>
    </div>
    <!-- /CONTENT -->
<div class="mb-5">&nbsp;</div>

 @include('portal.staff.student.scripts')

@endsection
