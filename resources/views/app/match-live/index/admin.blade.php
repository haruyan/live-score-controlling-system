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
                          <a rel="tooltip" class="btn btn-info btn-link" href="{{ route('score.viewLive', $match->id) }}" data-original-title="{{ __('Live Score') }}" title="">
                              <i class="material-icons">ondemand_video</i>
                              <div class="ripple-container"></div>
                          </a>
                          <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('score.viewControl', $match->id) }}" data-original-title="{{ __('Control') }}" title="">
                              <i class="material-icons">event_seat</i>
                              <div class="ripple-container"></div>
                          </a>
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
      </script>
@endpush