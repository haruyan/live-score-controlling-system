@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">menu_open</i>
              </div>
              <p class="card-category">Waiting</p>
              <h3 class="card-title">{{ $matches->where('status', 'waiting')->count() }}
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">play_arrow</i>
              </div>
              <p class="card-category">Ongoing</p>
              <h3 class="card-title">{{ $matches->where('status', 'ongoing')->count() }}
            </div>
            <div class="card-footer">
              <div class="stats"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">access_time</i>
              </div>
              <p class="card-category">Pending</p>
              <h3 class="card-title">{{ $matches->where('status', 'pending')->count() }}
            </div>
            <div class="card-footer">
              <div class="stats"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">done</i>
              </div>
              <p class="card-category">Finished</p>
              <h3 class="card-title">{{ $matches->where('status', 'finished')->count() }}
            </div>
            <div class="card-footer">
              <div class="stats"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush