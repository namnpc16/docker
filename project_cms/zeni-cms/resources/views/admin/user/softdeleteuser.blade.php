@extends('admin.layouts.app')
@section('title') Những thành viên bị xóa gần đây ! @endsection
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-body">
                {{-- Thông báo --}}
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
                            <a href="{{ route('list.user') }}" class="btn btn-warning"><i class="fas fa-undo"></i> Thoát</a>
                        </div>
                    </div>
                </div>
            
                <div class="col-12">
                    <div class="card">
                  <form id="frm_search" action="{{ route('soft.user') }}" method="post">
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
                        {{-- <button type="button" class="btn btn-primary date">Clear bộ lọc</button> --}}
                        <div class="col-2 ">
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
                              {{-- class="th-sort-desc" --}}
                              <th><a href="javascript:void(0)" class="header_column" data-id="id">ID</a></th>
                              <th><a href="javascript:void(0)" class="header_column" data-id="name">NAME</a></th>
                              <th><a href="javascript:void(0)" class="header_column" data-id="email">EMAIL</a></th>
                              <th><a href="javascript:void(0)" class="header_column" data-id="created_at">DATE - DELETE</a></th>
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
                                  <form action="{{ route('restore.user') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                      <input type="hidden" name="restore_id" id="restore_id">
                                      <input type="hidden" name="delete_id" id="delete_id">
                                      <p>Bạn có muốn <span id="value1"></span> thành viên <span id="value"></span>.</p>
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
                            @foreach ($trashUser as $item)
                              <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td><span class="tag tag-danger">{{ $item->deleted_at }}</span></td>
                                @if ($item->role == 1)
                                  {{-- <td><a href="#" class="btn btn-outline-danger">Admin</a></td>     --}}
                                  <td><button class="btn btn-success" ><i class="fas fa-user-shield"></i></button></td>
                                @else
                                  {{-- <td><a href="#" class="btn btn-outline-dark">User<i class="fad fa-user"></i></a></td> --}}
                                  <td><button class="btn btn-danger" style="width: 43.5px" ><i class="fas fa-user"></i></button></td>
                                @endif
                                <td class="fix-active-user">
                                    {{-- <a href="{{ route('edit.user', ['id' => $item->id]) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>Khôi phục</a> --}}
                                    <button class="btn btn-warning sbm-restore" name="sbm_restore" value="khôi phục" type="submit" data-value="{{ $item->name }}" data-id="{{ $item->id }}"><i class="far fa-window-restore"></i> Khôi phục</button>
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
                      {{ $trashUser->links() }}
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

          $('.header_column').click(function(e){
            $('#frm_order_by').val($(this).attr('data-id'));
            if ($('#frm_order_type').val() == "asc") {
                $('#frm_order_type').val('desc');
            } else {
                $('#frm_order_type').val('asc');
            }
            $('#frm_search').submit();
          });

          // show modal delete
          $(".sbm-delete").on("click", function () {
            $("#myModal").modal('show');
            $('span#value1').html($(this).attr('value'));
            $('span#value').html($(this).attr('data-value'));
            $('#delete_id').val($(this).attr('data-id'));
          })

        // show modal delete
        $(".sbm-restore").on("click", function () {
            $("#myModal").modal('show');
            $('span#value1').html($(this).attr('value'));
            $('span#value').html($(this).attr('data-value'));
            $('#restore_id').val($(this).attr('data-id'));
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

      });

      // date picker
      $('input#date').on('change', function () {
        console.log($(this).val());
        $('#frm_search').submit();
      })

      // clear input
      $('button.date').on("click", function () {
        $('input.float-right').val('')
        $('input#date').val('')
        $('#frm_search').submit();
      })
     
    </script>
@endpush