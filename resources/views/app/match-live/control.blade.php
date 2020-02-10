@extends('layouts.app', ['activePage' => 'match-live', 'titlePage' => __('Control Live Match')])

@section('content')
  <div class="content mt-0">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
              <div class="col-md-12">
                <div class="card mb-0">
                  {{-- <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">event_seat</i>
                    </div>
                    <h4 class="card-title ">{{ __('Match (Control)') }}</h4>
                  </div> --}}
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead align="center" class="text-primary">
                          <tr>
                            <td style="width:45%">
                              <small>{{ __('Player One') }}</small>
                              <p class="h5 mb-0">{{ $match->player_one }}</p>
                            </td>
                            <td style="width:45%">
                              <small>{{ __('Player Two') }}</small>
                              <p class="h5 mb-0">{{ $match->player_two }}</p>
                            </td>
                          </tr>
                        </thead>
                        <tbody align="center">
                          @for ($i = 0; $i < 6; $i++)
                              <tr>
                                <td class="p-0">
                                    <button class="btn btn-primary btn-round" id="btnP1-{{ $i }}" onclick="addScore(1, {{ $i+1 }})" {{ $button['point'] ?? '' }}>
                                      <i class="material-icons">looks_{{ $numbers[$i] }}</i> <small>{{ __('Point') }}</small>
                                    <div class="ripple-container"></div></button>
                                </td>
                                <td class="p-0">
                                    <button class="btn btn-primary btn-round" id="btnP2-{{ $i }}" onclick="addScore(2, {{ $i+1 }})" {{ $button['point'] ?? '' }}>
                                      <i class="material-icons">looks_{{ $numbers[$i] }}</i> <small>{{ __('Point') }}</small>
                                    <div class="ripple-container"></div></button>
                                </td>
                              </tr>
                          @endfor
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-12">
              <div class="card card-plain mt-0 mb-0">
                <div class="card-body text-center pb-0">
                    <button onclick="matchStatus('ongoing')" id="btnPlay" class="btn btn-success btn-round" {{ $button['play'] ?? '' }}>
                      <i class="material-icons">play_arrow</i> {{ __('Start') }}
                      <div class="ripple-container"></div>
                    </button>
                    <button onclick="matchStatus('pending')" id="btnPause" class="btn btn-rose btn-round" {{ $button['pause'] ?? '' }}>
                      <i class="material-icons">pause</i> {{ __('Pause') }}
                      <div class="ripple-container"></div>
                    </button>
                    <button onclick="removeScore()" id="btnUndo" class="btn btn-primary btn-round" {{ $button['undo'] ?? '' }}>
                      <i class="material-icons">undo</i> {{ __('Undo') }}
                      <div class="ripple-container"></div>
                    </button>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card card-plain mt-0">
                <div class="card-body text-center pt-0">
                  <button onclick="finishStatus('finished')" id="btnFinish" class="btn btn-info btn-round" {{ $button['finish'] ?? '' }}>
                    <i class="material-icons">done_outline</i> {{ __('Finish') }}
                    <div class="ripple-container"></div>
                  </button>
                  <button class="btn btn-info btn-round">
                    <i class="material-icons pr-1">access_time</i><span id="timer">{{ $match->timer }}</span></h1>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <div class="card card-plain mt-0">
                    <div class="card-body text-center">
                        <a href="{{ route('match.liveIndex') }}">
                            <button id="btnBack" class="btn btn-rose btn-round" hidden>
                                    <i class="material-icons">keyboard_backspace</i> {{ __('Kembali ke Daftar Pertandingan') }}
                                <div class="ripple-container"></div>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
            <div class="card">
              <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">grid_on</i>
                </div>
                <h4 class="card-title ">{{ __('Match (Live Score)') }}</h4>
                <div class="text-right">
                    <a href="{{ route('score.viewLive', $match->id) }}" target="_blank">
                      <button class="btn btn-sm btn-rose pl-3"><i class="material-icons">ondemand_video</i>{{ __('Show') }}</button>
                    </a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead align="center" class="text-rose">
                      <tr>
                        <td style="width:45%">
                          <small>{{ __('Player One') }}</small>
                          <p class="h5 mb-0">{{ $match->player_one }}</p>
                        </td>
                        <td> </td>
                        <td style="width:45%">
                          <small>{{ __('Player Two') }}</small>
                          <p class="h5 mb-0">{{ $match->player_two }}</p>
                        </td>
                      </tr>
                    </thead>
                    <tbody align="center">
                      @for ($i = 0; $i < 13; $i++)
                          <tr>
                            <td class="p-0" id="tableP1-{{ $i+1 }}">.</td>
                            <td class="p-0">{{ $i+1 }}</td>
                            <td class="p-0" id="tableP2-{{ $i+1 }}">.</td>
                          </tr>
                      @endfor
                    </tbody>
                    <tfoot align="center">
                      <tr class="h3 text-rose">
                        <td id="total1">
                          Total
                        </td>
                        <td></td>
                        <td id="total2">
                          Total
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <div class="price">
                    <p class="card-category">
                      <i class="material-icons text-rose">face</i> <span class="badge badge-rose">{{ $match->arbitreRef->fullname }}</span>
                    </p>
                </div>
                <div class="price">
                    <p class="card-category">
                      <span class="badge badge-rose">{{ $match->field }}</span><i class="material-icons text-rose">place</i>
                    </p>
                </div>
            </div>
            </div>
        </div>
      </div>
  </div>
@endsection
@push('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
  <script>
    var id = ('{{ $id }}')
    var arrScore = JSON.parse('{!! $score !!}')
    var checkStatus = '{{ $match->status }}'
    //init back btn
    checkStatus == 'finished' ? $("#btnBack").prop('hidden',false) : '';
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }

    });

    // initialize recorded data if any point exist
    // continue ongoing match
    $(function() { 
      if(arrScore.n != 0){
        arrScore.n.forEach((element, index) => {
          ball = '<i class="material-icons text-rose">sports_baseball</i>'
          element.score > 13 ? element.score = 13 : element.score;
          $('#tableP'+element.player+'-'+element.score).html(ball+'/'+(index+1));
        });

        $('#total1').html(arrScore.total[arrScore.total.length-1][0])
        $('#total2').html(arrScore.total[arrScore.total.length-1][1])
      }

      // function for unexpected closed window
      if (checkStatus == 'ongoing'){
        var getUpdated = new Date('{{ $match->updated_at }}')
        var getCurrent = new Date()
        
        var matchtimer = $('#timer').html();
        var splitted = matchtimer.split(":") // split timer
        hours = parseInt(splitted[0]); minutes = parseInt(splitted[1]); seconds = parseInt(splitted [2]); // splitted

        var res = Math.abs(getCurrent - getUpdated)/1000;
        var sc = hours * 3600;
        sc += minutes * 60;
        sc += seconds;
        res += sc;

        var splitHours = Math.floor(res / 3600) % 24;
        var splitMinutes = Math.floor(res / 60) % 60;
        var splitSeconds = Math.floor(res % 60);
        
        hours = splitHours; minutes = splitMinutes; seconds = splitSeconds; // add split to saved timer
        // set h1 content
        h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
        matchStatus('ongoing');
      }
    });

    function addScore(player, score){
      var updateScore = updateArr(player, score);
      
      if (arrScore.total[arrScore.total.length-1][0] < 13 && arrScore.total[arrScore.total.length-1][1] < 13) {
        setScore(updateScore);
      }
      else{
        matchStatus('pending', updateScore)
        console.log(arrScore);
      }

    }

    function removeScore(){
      var lastN = arrScore.n.length
      if (lastN == 0){ return null } // disable next function if data N/Total = 0
      // enable poin button if max score
      if (arrScore.total[arrScore.total.length-1][0] > 12 || arrScore.total[arrScore.total.length-1][1] > 12){
        for (var b = 0; b < 6; b++) {
          $("#btnP1-"+b).prop('disabled',false);
          $("#btnP2-"+b).prop('disabled',false);
        }
      }
      var undoScore = undoArr(); //undo array
      setScore(undoScore)
    }

    function setScore(score){
      data = {'id':id, 'data':score}
      var url = '{{ route("score.set", $id) }}'
      axios.post(url, data)
        .then((response) => {
          console.log(response)
        })
        .catch((error) => {
          console.log(error)
        })
    }

    // init timer
    var h1 = document.getElementById('timer'), seconds = 0, minutes = 0, hours = 0, t;
    // add seconds to timer
    function add(){
      seconds++;
      if (seconds >= 60) {
          seconds = 0;
          minutes++;
          if (minutes >= 60) {
              minutes = 0;
              hours++;
          }
      }
      
      h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
      // alerts duration exceed
      h1.textContent == '{{ $match->duration }}' ? timesUp() : '';
      timerThis();
    }

    function timerThis() {
        t = setTimeout(add, 1000);
    }

    function timesUp(){
      swal.fire({
        title: "Time's Up",
        text: "{{ __('Batas waktu pertandingan telah selesai') }}",
        type: 'warning'
      })
    }

    function finishStatus(status){
      var lastN = arrScore.n.length
      if (lastN == 0){ return null } // disable next function if data N/Total = 0
      if (arrScore.total[arrScore.total.length-1][0] == arrScore.total[arrScore.total.length-1][1]) {
        swal.fire({
          title: "{{ __('Pertandingan masih imbang!') }}",
          text: "{{ __('Silahkan tambah satu point untuk salah satu pemain') }}",
          type: 'error',
          timer: 3000
        })
      } else {
        swal.fire({
          title: "{{ __('Want to Finish Match?') }}",
          text: "{{ __('Match is still going') }}!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: "{{ __('Yes, Finish Match') }}"
        }).then((result) => {
          if (result.value) {
            swal.fire(
              '{{ __('Finished') }}!',
              '{{ __('Match has been finished') }}',
              'success'
            )
            matchStatus('finished', null)
            
          }
        })
      }
    }

    function getStatus(status){
      if (status == 'ongoing') return {'point' : false, 'play' : true, 'pause' : false, 'finish' : false, 'undo' : false,};  
      else if (status == 'pending') return {'point' : true, 'play' : false, 'pause' : true, 'finish' : false, 'undo' : true,};    
      else if (status == 'finished') return {'point' : true, 'play' : true, 'pause' : true, 'finish' : true, 'undo' : true, 'back' : false,};    
      else return {'point' : true, 'play' : true, 'pause' : true, 'finish' : true, 'undo' : true,} // not used
    }

    function matchStatus(status, scoreUpdate){
      var url = '{{ route("score.status", $id) }}';
      var matchtimer = $('#timer').html();
      var data = {
        'id' : id,
        'status' : status,
        'score'  : scoreUpdate,
        'timer'  : matchtimer,
        'currentTime' : moment().format('YYYY-MM-DD h:mm:ss')
      }

      axios.post(url, data)
        .then(function (response) {
          toast.fire({
              type: 'success',
              title: '{{ __('Match ') }}'+status
          });

          // giving timer for processing to finish match,
          // because swal must not be crash each others
          if (status != 'finish'){
            $("#btnFinish").prop('disabled',true);
            setTimeout(() => {
              $("#btnFinish").prop('disabled',false)
            }, 2500);
          }

          // button seession
          btnStatus = getStatus(status);
          $("#btnUndo").prop('disabled',btnStatus.undo);
          $("#btnPlay").prop('disabled',btnStatus.play);
          $("#btnPause").prop('disabled',btnStatus.pause);
          $("#btnBack").prop('hidden',btnStatus.back);
          for (var b = 0; b < 6; b++) {
            if (arrScore.total.length == 0){
              $("#btnP1-"+b).prop('disabled',btnStatus.point);
              $("#btnP2-"+b).prop('disabled',btnStatus.point);
            } else {
              if (arrScore.total[arrScore.total.length-1][0] > 12 || arrScore.total[arrScore.total.length-1][1] > 12){
                  $("#btnP1-"+b).prop('disabled',true);
                  $("#btnP2-"+b).prop('disabled',true);
              } else {
                $("#btnP1-"+b).prop('disabled',btnStatus.point);
                $("#btnP2-"+b).prop('disabled',btnStatus.point);
              }
            }
          }
          
          // timer session
          var splitted = matchtimer.split(":") // split timer
          hours = parseInt(splitted[0]); minutes = parseInt(splitted[1]); seconds = parseInt(splitted [2]); // splitted
          status == 'ongoing' ? timerThis() : clearTimeout(t);
        })
        .then(function (){
          if(status == 'ongoing' && h1.textContent >= '{{ $match->duration }}'){ 
            setTimeout(timesUp, 2000)
          }
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    function updateArr(player, score){
      // player identification
      indexPlayer = player == 1 ?  0 : 1; //for array
      lengthArr = arrScore.total.length; // last array for n and total

      var total1 = 0;
      var total2 = 0;
      if (arrScore.total.length != 0){
        total1 = arrScore.total[lengthArr-1][0];
        total2 = arrScore.total[lengthArr-1][1];
      }
      total1 += (player == 1 ? score : 0);
      total2 += (player == 2 ? score : 0);
      addTotal = [total1, total2]; 
      arrScore.total.push(addTotal); // update Total

      addN = {'player' : player, 'score' : addTotal[indexPlayer]};
      arrScore.n.push(addN); // update N
      
      pointPosition = addTotal[indexPlayer] > 12 ? 13 : addTotal[indexPlayer]; //check current position of player
      arrScore.log[pointPosition-1][indexPlayer] = score; //update log, -1 because index = 0

      updateTable(arrScore.n)
      return arrScore;
    }

    function updateTable(data){
      ball = '<i class="material-icons text-rose">sports_baseball</i>'
      newData = data[data.length-1]
      pointPosition = (newData.score > 12 ? 13 : newData.score) //check current position of player
      $('#tableP'+newData.player+'-'+pointPosition).html(ball+'/'+data.length);
      $('#total'+newData.player).html(newData.score)
    }

    function undoArr(){
      var popN = arrScore.n.pop() // used to delete log
      var popTotal = arrScore.total.pop()
      popN.score = (popN.score > 12 ? 13 : popN.score) // set max coordinate
      arrScore.log[popN.score-1][popN.player-1] = 0 // return log to 0

      undoTable(popN, popTotal)
      return arrScore;
    }

    function undoTable(dataN, dataTotal){
      pointPosition = (dataN.score > 12 ? 13 : dataN.score)
      $('#tableP'+dataN.player+'-'+pointPosition).html('');
      undoTotal = (arrScore.total.length == 0 ? 0 : arrScore.total[arrScore.total.length-1][dataN.player-1]) // length -1 because last array, player -1 because index array
      $('#total'+dataN.player).html(undoTotal)
    }

  </script>
@endpush
