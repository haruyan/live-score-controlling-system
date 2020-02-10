@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-icon card-header-success">
                <div class="card-icon">
                    <i class="material-icons">people</i>
                </div>
                <h4 class="card-title ">{{ __('Users') }}</h4>
                <div class="text-right">
                    <button class="btn btn-sm btn-success" onclick="showAdd()">{{ __('Add user') }}</button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive material-datatables">
                  <table class="table" id="tableUser">
                    <thead class=" text-success">
                      <th>
                          {{ __('No') }}
                      </th>
                      <th>
                          {{ __('Name') }}
                      </th>
                      <th>
                        {{ __('Email') }}
                      </th>
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($users as $u => $user)
                        <tr>
                          <td>{{ $u+1 }}</td>
                          <td>{{ $user->fullname }}</td>
                          <td>{{ $user->email }}</td>
                          <td class="td-actions text-right">
                            @if ($user->id != auth()->id())
                              <form action="{{ route('user.destroy', $user) }}" method="post">
                                  @csrf
                                  @method('delete')
                              
                                  <a rel="tooltip" class="btn btn-success btn-link" onclick="showEdit({{ $user->id }})" data-original-title="{{ __('Edit') }}" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button rel="tooltip" type="button" class="btn btn-danger btn-link" data-original-title="{{ __('Delete') }}" title="" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                              </form>
                            @else
                              <a rel="tooltip" class="btn btn-success btn-link" onclick="showEdit({{ $user->id }})" data-original-title="{{ __('Edit') }}" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                            @endif
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
@include('app.user.modal')
@endsection
@push('js')
    <script>
        var table;
        $(document).ready(function(){
            table = $('#tableUser').DataTable({
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

            axios.post('/user', data)
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
                    // console.log(error);
                    swal({
                        title: "Gagal",
                        text:error,
                        type: 'error'
                    });
                });
        }

        // Show Edit Modal and Fill Form
        function showEdit(id){
            event.preventDefault();
            var form = document.querySelector('#formEdit');

            axios.get('/user/'+id)
                .then(function (response) {
                    form.reset();
                    $('#edit_id').val(response.data.id);
                    $('#edit_fullname').val(response.data.fullname);
                    $('#edit_username').val(response.data.username);
                    $('#edit_email').val(response.data.email);
                    $('#modalEdit').modal('show');
                    
                })
                .catch(function (error) {
                    swal({
                        title: "Gagal",
                        text:error,
                        type: 'error'
                    });
                });
        }

        // Update Data
        function btnUpdate(){
            event.preventDefault();
            var form = document.querySelector('#formEdit');
            var data = new FormData(form);
            var id = $('#edit_id').val();

            axios.post('/user/'+id, data)
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