@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
        @foreach ($matches as $m => $match)    
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-header card-header-{{ $match->badge }}">
                        <h4 class="card-title">{{ ucfirst($match->status) }}</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                <td>
                                    <p class="text-primary h6 mb-0">{{ $match->player_one }}</p>
                                    vs
                                    <p class="text-primary h6 mb-0 mt-1">{{ $match->player_two }}</p>
                                </td>
                                <td class="td-actions text-right">
                                    <a href="{{ route('score.viewControl', $match->id) }}">
                                        <button type="button" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="{{ $match->status == 'finished' ? 'View' : 'Start' }} Match">
                                        <i class="material-icons">event_seat</i>{{ $match->status == 'finished' ? ' View' : ' Play' }}
                                        </button>
                                    </a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                        <i class="material-icons">date_range</i> {{ __('Field: ').$match->field }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
  </div>
</div>
@endsection