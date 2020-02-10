@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-icon card-header-success">
                <div class="card-icon">
                    <i class="material-icons">sports_kabaddi</i>
                </div>
                <h4 class="card-title ">{{ __('Match') }}</h4>
                <div class="text-right">
                    <button class="btn btn-sm btn-success" onclick="showAdd()">{{ __('Add match') }}</button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive material-datatables">
                  <table class="table" id="tableMatch">
                    <thead class=" text-success">
                      <th>{{ __('No') }}</th>
                      <th>{{ __('Player') }}</th>
                      <th>{{ __('Time') }}</th>
                      <th>{{ __('Field') }}</th>
                      <th>{{ __('Referee') }}</th>
                      <th>{{ __('Status') }}</th>
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($matches as $m => $match)
                        <tr>
                          <td>{{ $m+1 }}</td>
                          <td>{{ $match->player_one}}
                              <small>vs</small>
                              <br>
                              {{ $match->player_two }}
                          </td>
                          <td>{{ $match->timer }}</td>
                          <td>{{ $match->field }}</td>
                          <td>{{ $match->arbitreRef->fullname }}</td>
                          <td><span class="badge badge-pill badge-{{ $match->badge }}">{{ strtoupper($match->status) }}</span></td>
                          <td class="td-actions text-right">
                            <form action="{{ route('match.destroy', $match) }}" method="post">
                                @csrf
                                @method('delete')
                                <a rel="tooltip" class="btn btn-info btn-link" href="{{ route('score.viewLive', $match->id) }}" data-original-title="{{ __('Live Score') }}" title="">
                                    <i class="material-icons">ondemand_video</i>
                                    <div class="ripple-container"></div>
                                </a>
                                <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('score.viewControl', $match->id) }}" data-original-title="{{ __('Control') }}" title="">
                                    <i class="material-icons">event_seat</i>
                                    <div class="ripple-container"></div>
                                </a>
                                <a rel="tooltip" class="btn btn-success btn-link" onclick="showEdit({{ $match->id }})" data-original-title="{{ __('Edit') }}" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                </a>
                                <button rel="tooltip" type="button" class="btn btn-danger btn-link" data-original-title="{{ __('Delete') }}" title="" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                    <i class="material-icons">close</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@include('app.match.modal')
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('#tableMatch').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
                ],
                responsive: true,
                autoWidth: false,
                language: {
                search: "_INPUT_",
                searchPlaceholder: "{{ __('Search') }}",
                },
            });            
        });

        // Show Add Modal
        function showAdd(){
            $('#modalAdd').modal('show');
        }

        // Save Data
        function btnCreate(){
            event.preventDefault();
            var form = document.querySelector('#formAdd');
            var data = new FormData(form);

            axios.post('/match', data)
                .then(function (response) {
                    toast.fire({
                        type: 'success',
                        title: '{{ __('Data has been Created') }}'
                    });
                    $('#formAdd').trigger('reset');
                    $('#modalAdd').modal('hide');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        // Show Edit Modal and Fill Form
        function showEdit(id){
            event.preventDefault();
            var form = document.querySelector('#formEdit');

            axios.get('/match/'+id)
                .then(function (response) {
                    form.reset();
                    $('#edit_id').val(response.data.id);
                    $('#edit_player_one').val(response.data.player_one);
                    $('#edit_player_two').val(response.data.player_two);
                    $('#edit_field').val(response.data.field);
                    $('#edit_arbitre').val(response.data.arbitre);

                    var duration = response.data.duration;
                    var spliteDuration = duration.split(":")
                    var duration = (parseInt(spliteDuration[0])*60)+(parseInt(spliteDuration[1]))
                    $('#edit_duration').val(duration);
                    $('#modalEdit').modal('show');
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        // Update Data
        function btnUpdate(){
            event.preventDefault();
            var form = document.querySelector('#formEdit');
            var data = new FormData(form);
            var id = $('#edit_id').val();

            axios.post('/match/'+id, data)
                .then(function (response) {
                    toast.fire({
                        type: 'success',
                        title: '{{ __('Data has been Changed') }}'
                    });
                    $('#formEdit').trigger('reset');
                    $('#modalEdit').modal('hide');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        </script>
@endpush