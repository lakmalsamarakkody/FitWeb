@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#system').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">System</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    <div class="col-lg-12 dashboard">
      <div class="row">

        <div class="col">
          <div class="card border-0 shadow">
            <div class="card-header">SUBJECTS</div>
            <div class="card-body">
              <div class="card-title">FIT 103</div>
              <div class="card-text">ICT Applications</div>
            </div>
            <div class="card-footer text-right"><button type="button" class="btn btn-primary">Add Subjects</button></div>
          </div>
        </div>


      </div>
    </div>
    <!-- /CONTENT -->



    <!-- HEADING -->
    <div class="col-lg-12 mt-5">
        <div class="row">
          
          <div class="card w-100">
              <div class="card-header">{{ __('Dashboard') }}</div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  {{ __('You are logged in as Staff!') }}
              </div>
          </div>

      </div>
    </div>

@endsection
