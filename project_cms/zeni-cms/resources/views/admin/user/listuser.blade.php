@extends('admin.layouts.app')
@section('title') Quản lý thành viên @endsection
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <i class="icon fas fa-check"></i>
                      {{ session('success') }}
                  </div>
                @endif
                <div class="row">
                    <div class="col-2 fix-col">
                        <div class="card">
                            <a href="{{ route('create.user') }}" class="btn btn-primary"><i class="fas fa-plus-circle"> Thêm thành viên !</i></a>
                        </div>
                    </div>
                    <div class="col-2 fix-col">
                      <div class="card">
                          <a href="{{ route('soft.user') }}" class="btn btn-warning"><i class="fas fa-trash-alt"> Thùng rác !</i></a>
                      </div>
                  </div>
                </div>
            
                <div class="col-12">
                    <div class="card">
                  <form id="frm_search" action="{{ route('list.user') }}" method="post">
                    @csrf
                      <div class="card-header">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group fix-form-group">
                                <div class="card-tools">
                                  <div class="input-group input-group-sm" style="width: 250px;">
                                    <input value="{{ old('table_search') }}" type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <input type="hidden" id="frm_order_by" name="order_by" value="{{ old('order_by', 'id') }}">
                                    <input type="hidden" id="frm_order_type" name="order_type" value="{{ old('order_type', 'desc') }}">
                                    <div class="input-group-append">
                                      <button type="submit" name="sbm_search" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group fix-form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="far fa-calendar-alt"></i>
                                    </span>
                                  </div>
                                  <input type="date" id="date" name="date" value="{{ old('date') }}" min="2020-01-01" max="2050-12-31">
                                </div>
                                <!-- /.input group -->
                            </div>
                          </div>
                          <div class="col-sm-2 col-md-2">
                            <div class="dataTables_length" id="example1_length">
                                <select id="mySelect" name="limit_record" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm">
                                  @foreach (__('common.item_pages') as $item)
                                  <option value="{{ $item }}" {{ old('limit_record')==$item?'selected': '' }}>{{ $item }}</option>
                                  @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-md-1">
                          </div>
                          <div class="col-md-2">
                            <button type="button" class="btn btn-primary date"><i class="fas fa-eraser"> Clear bộ lọc</i></button>
                          </div>
                        </div>
                      </div>
                    </form>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table id="selectedColumn" class="table table-hover text-nowrap table-sortable">
                          <thead>
                            <tr class="bg-primary">
                              <th><a href="javascript:void(0)" class="header_column" data-id="id">ID</a></th>
                              <th><a href="javascript:void(0)" class="header_column" data-id="name">NAME</a></th>
                              <th><a href="javascript:void(0)" class="header_column" data-id="email">EMAIL</a></th>
                              <th><a href="javascript:void(0)" class="header_column" data-id="created_at">DATE</a></th>
                              <th><a href="javascript:void(0)" class="header_column" data-id="role">ROLE</a></th>
                              <th>ACTION</th>
                            </tr>
                          </thead>
                          <tbody>
                            {{-- ==================================================== --}}
                            <div id="myModal" class="modal" tabindex="-1" role="dialog">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Thông báo !</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{ route('del.user') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                      <input type="hidden" name="delete_id" id="delete_id">
                                      <p>Bạn có muốn xóa thành viên <span id="trash"></span>.</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            {{-- ==================================================== --}}
                            @foreach ($users as $item)
                              <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td><span class="tag tag-danger">{{ $item->created_at }}</span></td>
                                @if ($item->role == 1)
                                  <td><button class="btn btn-success" ><i class="fas fa-user-shield"></i></button></td>
                                @else
                                  <td><button class="btn btn-danger" style="width: 43.5px" ><i class="fas fa-user"></i></button></td>
                                @endif
                                <td class="fix-active-user">
                                    <a href="{{ route('edit.user', ['id' => $item->id]) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i><i class="fas fa-user-edit"></i> Sửa</a>
                                    <button class="btn btn-danger sbm-delete" name="sbm_delete" value="xóa" type="submit" data-value="{{ $item->name }}" data-id="{{ $item->id }}"><i class="fas fa-user-times"></i> Xóa</button>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            
                <div class="fix-col-7">
                    <ul class="pagination">
                      {{ $users->links() }}
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
@push('scripts')
    <script>
      $(document).ready(function () {
          // get order
          $('.header_column').click(function(e){
              $('#frm_order_by').val($(this).attr('data-id'));
              if ($('#frm_order_type').val() == "asc") {
                  $('#frm_order_type').val('desc');
              } else {
                  $('#frm_order_type').val('asc');
              }
              $('#frm_search').submit();
          });

          // show modal
          $(".sbm-delete").on("click", function () {
              $("#myModal").modal('show');
              $('#delete_id').val($(this).attr('data-id'));
              $('#trash').html($(this).attr('data-value'));
          })

          // limit record
          $('#mySelect').on('change', function() {
              this.form.submit()
          });

          // page action
          $('a.page-link').click(function(e) {
              e.preventDefault();
              console.log($(this).attr('href'));
              $('#frm_search').attr('action', $(this).attr('href'));
              $('#frm_search').submit();
              return false;
          });

          // date picker
          $('input#date').on('change', function () {
              console.log($(this).val());
              $('#frm_search').submit();
          });

          // clear input
          $('button.date').on("click", function () {
              $('input.float-right').val('')
              $('input#date').val('')
              $('#frm_search').submit();
          });
      });
    </script>
@endpush