@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'scoreBoard', 'title' => 'Live-Score', 'titlePage' => __('Score Live Match')])

@section('content')
  <div class="container" id="app">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-icon card-header-success">
              <div class="card-icon">
                  <i class="material-icons">ondemand_video</i>
              </div>
              <h4 class="card-title ">{{ __('Match (Live)') }}</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <td>{{ $match->player_one }}</td>
                      @for ($i = 1; $i < 14; $i++)
                          <td id="p1-{{ $i }}">.</td>
                      @endfor
                      <td class="text-primary" id="total1"></td>
                    </tr>
                    <tr>
                      <td>{{ __('Team') }}</td>
                      @for ($i = 1; $i < 14; $i++)
                          <td style="padding: 0px 20px;">{{ $i }}</td>
                      @endfor
                      <td class="text-primary">{{ __('Total') }}</td>
                    </tr>
                    <tr>
                      <td>{{ $match->player_two }}</td>
                      @for ($i = 1; $i < 14; $i++)
                          <td id="p2-{{ $i }}">.</td>
                      @endfor
                      <td class="text-primary" id="total2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 ml-auto">
        <div class="card card-stats">
          <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon helper-card-icon-right">
              <i class="material-icons">looks_one</i>
            </div>
            <p class="card-category helper-card-text-left h6">{{ __('Point') }}</p>
            <h1 class="card-title helper-card-text-bold-left" id="cardP1">.</h1>
          </div>
          <div class="card-footer">
            <div class="stats h6">
              <i class="material-icons text-rose">person</i> {{ $match->player_one }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 mr-auto">
        <div class="card card-stats">
          <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
              <i class="material-icons">looks_two</i>
            </div>
            <p class="card-category helper-card-text-right h6">{{ __('Point') }}</p>
            <h1 class="card-title" id="cardP2">.</h1>
          </div>
          <div class="card-footer">
            <div class="stats h6">
              <i class="material-icons text-danger">person</i> {{ $match->player_two }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 ml-auto">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon helper-card-icon-right">
              <i class="material-icons">sports_baseball</i>
            </div>
            <p class="card-category helper-card-text-left h6">{{ __('Match Status') }}</p>
            <h3 class="card-title helper-card-text-bold-left" id="cardStatus">{{ strtoupper($match->status) }}
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats h6">
              <i class="material-icons text-warning">golf_course</i>
              <a href="#pablo"></a>{{ __('field') }} : {{ $match->field }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 mr-auto">
        <div class="card card-stats">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="fa fa-user"></i>
            </div>
            <p class="card-category h6">{{ __('Arbitre') }}</p>
            <h3 class="card-title">{{ strtok($match->arbitreRef->fullname, " ") }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats h6p">
              <i class="material-icons text-info">star</i>{{ $match->arbitreRef->fullname }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
  <script>
    var id = ('{{ $id }}')
    var arrScore = JSON.parse('{!! $score !!}');
    
    $(function() { 
      // initialize recorded data if any point exist
      ball = '<i class="material-icons text-primary">sports_baseball</i>'
      badge1 = '<span class="badge badge-primary h6">'
      badge2 = '</span>'
      if(arrScore.n != 0){
        arrScore.n.forEach((element, index) => {
          element.score = (element.score > 12 ? 13 : element.score)
          $('#p'+element.player+'-'+element.score).html(ball+'/'+(index+1))
        });

        $('#total1').html(badge1+arrScore.total[arrScore.total.length-1][0]+badge2)
        $('#total2').html(badge1+arrScore.total[arrScore.total.length-1][1]+badge2)
        $('#cardP1').html(arrScore.total[arrScore.total.length-1][0])
        $('#cardP2').html(arrScore.total[arrScore.total.length-1][1])
      }
    });

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('9c8a8efcc5afa43e4666', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('match-'+id);
    channel.bind('App\\Events\\ScoreEvent', function(data) {
      //reset table
      for (let index = 1; index < 14; index++) {
        $('#p1-'+index).html('')
        $('#p2-'+index).html('')
      }

      //init ball
      var ball = '<i class="material-icons text-primary">sports_baseball</i>'
      var badge1 = '<span class="badge badge-primary h6">'
      var badge2 = '</span>'

      var arrScore2 = data.data.match.score;
      if(arrScore2.n != 0){
        arrScore2.n.forEach((element, index) => {
          element.score = (element.score > 12 ? 13 : element.score)
          $('#p'+element.player+'-'+element.score).html(ball+'/'+(index+1))
        });
        $('#total1').html(badge1+arrScore2.total[arrScore2.total.length-1][0]+badge2)
        $('#total2').html(badge1+arrScore2.total[arrScore2.total.length-1][1]+badge2)
        $('#cardP1').html(arrScore2.total[arrScore2.total.length-1][0])
        $('#cardP2').html(arrScore2.total[arrScore2.total.length-1][1])
      } else {
        $('#total1').html(0); $('#total2').html(0); $('#cardP1').html(0); $('#cardP2').html(0);
      }
       $('#cardStatus').html(data.data.match.match_ref.status).css('text-transform', 'capitalize')
      
    });
  </script>
@endpush
