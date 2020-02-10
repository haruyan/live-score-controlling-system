<!-- MODAL CREATE LAPANGAN-->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('ADD USER') }}</h5>
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
                            {{ __('Full Name') }}
                        </label>
                        <input type="text" class="form-control" name="fullname">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            {{ __('Username') }}
                        </label>
                        <input type="text" class="form-control" name="username">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            {{ __('Email') }}
                        </label>
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            {{ __('Password') }}
                        </label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            {{ __('Password Confirmation') }}
                        </label>
                        <input type="password" class="form-control" name="password_confirmation">
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
        <h5 class="modal-title">{{  __('EDIT USER') }}</h5>
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
                                {{ __('Full Name') }}
                            </label>
                            <input type="text" class="form-control" name="fullname" id="edit_fullname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">
                                {{ __('Username') }}
                            </label>
                            <input type="text" class="form-control" name="username" id="edit_username">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">
                                {{ __('Email') }}
                            </label>
                            <input type="email" class="form-control" name="email" id="edit_email">
                        </div>
                    </div>
                </div>
                <small id="emailHelp" class="form-text text-muted pt-3">{{ __("(Leave this empty if didn't want to change )") }}</small>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">
                                {{ __('Password') }}
                            </label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">
                                {{ __('Password Confirmation') }}
                            </label>
                            <input type="password" class="form-control" name="password_confirmation">
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
