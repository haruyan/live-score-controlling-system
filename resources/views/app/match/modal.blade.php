<!-- MODAL CREATE LAPANGAN-->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('ADD MATCH') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="formAdd">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            {{ __('Player One') }}
                        </label>
                        <input type="text" class="form-control" name="player_one">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            {{ __('Player Two') }}
                        </label>
                        <input type="text" class="form-control" name="player_two">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            {{ __('Field') }}
                        </label>
                        <input type="text" class="form-control" name="field">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            {{ __('Arbitre') }}
                        </label>
                        {{-- <input type="text" class="form-control" name="arbitre"> --}}

                        <select name="arbitre" class="form-control" data-style="btn btn-link" >
                            <option value="" selected disabled>{{ __('Select Arbitre') }}</option>
                            @foreach ($arbitres as $arbitre)
                                @if ($arbitre->id != Auth::user()->id)
                                    <option value="{{ $arbitre->id }}">{{ $arbitre->fullname }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            {{ __('Date') }}
                        </label>
                        <input type="date" class="form-control" name="date">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            {{ __('Duration (minutes)') }}
                        </label>
                        <input type="number" class="form-control" name="duration">
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="button" class="btn btn-success" onclick="btnCreate()">{{  __('Create') }}</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDIT LAPANGAN-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{  __('EDIT MATCH') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form role="form" id="formEdit">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="edit_id"/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">
                                {{ __('Player One') }}
                            </label>
                            <input type="text" class="form-control" name="player_one" id="edit_player_one">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">
                                {{ __('Player Two') }}
                            </label>
                            <input type="text" class="form-control" name="player_two" id="edit_player_two">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">
                                {{ __('Field') }}
                            </label>
                            <input type="text" class="form-control" name="field" id="edit_field">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">
                                {{ __('Arbitre') }}
                            </label>
                            <select name="arbitre" id="edit_arbitre" class="form-control">
                                <option value="" selected disabled>{{ __('Select Arbitre') }}</option>
                                @foreach ($arbitres as $arbitre)
                                    @if ($arbitre->id != Auth::user()->id)
                                        <option value="{{ $arbitre->id }}">{{ $arbitre->fullname }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">
                                {{ __('Date') }}
                            </label>
                            <input type="date" class="form-control" name="date" id="edit_date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">
                                {{ __('Duration (minutes)') }}
                            </label>
                            <input type="number" class="form-control" name="duration" id="edit_duration">
                        </div>
                    </div>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="button" class="btn btn-info" onclick="btnUpdate()">{{  __('Update') }}</button>
      </div>
    </div>
  </div>
</div>
