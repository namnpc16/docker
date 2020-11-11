@extends('admin.layouts.app')
@section('title') Danh Mục Bài Viết @endsection
@section('content')
    <section class="content">
    <div class="card card-primary">
        <div class="card-body">
        @if(session()->has('thongbao'))
        <div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i> Thông Báo!</h4>
            <p>{{ session()->get('thongbao') }}</p>
        </div>
        @endif
        <div class="row">
        <a href="{{ route('cate.addview') }}" class="btn btn-success float-right" style="margin-bottom: 20px;">Thêm mới</a>
        </div>
        <div class="row">
        
            <div class="col-sm-12">
                <div class="card card-primary">
                <div class="card-header">
                <form id="frm_search" action="{{ route('cate.listcate') }}" method="post">
                    <div class="row">
                        
                        <div class="col-sm-4">  
                            <select class="custom-select" name="limit_record" id="mySelect">
                            @foreach ( __('common.item_pages') as $item)
                            <option value="{{ $item }}" {{ old('limit_record')==$item?'selected': '' }}>{{ $item }}</option>
                            @endforeach

                            </select>
                        </div>  
                        
                        <div class="col-sm-4">
                            <input type="date" name="daySearch" value="{{ old('daySearch') }}" class="form-control" id="daySearchs">
                        </div>  
                        <div class="col-sm-4">
                            <div class="input-group input-group-sm float-right" style="width: 150px;">
                                @csrf
                                <input type="text" value="{{ old('keysearch') }}" name="keysearch" class="form-control inpusearch" placeholder="Search">
                                <input type="hidden" id="frm_order_by" name="order_by" value="{{ old('order_by', 'id') }}">
                                <input type="hidden" id="frm_order_type" name="order_type" value="{{ old('order_type', 'desc') }}">

                                <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>  
                        
                    
                    </div> 
                    <!-- endrow -->
                </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                    <thead>
                        <tr class="" >
                        <th><a  href="javascript:void(0)" class="header_column" data-id="id">ID</th>
                        <th><a  href="javascript:void(0)" class="header_column" data-id="name">Tên danh mục</th>
                        <th><a  href="javascript:void(0)" class="header_column" data-id="slug">Slug name</th>
                        <th><a  href="javascript:void(0)" class="header_column" data-id="created_at">Ngày Tạo</th>
                        <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cate as $ct)
                        <tr>
                            <td width="10%">{{ $ct->id }}</td>
                            <td width="25%">{{ $ct->name }}</td>
                            <td width="25%">{{ $ct->slug }}</td>
                            <td width="20%">{{ $ct->created_at }}</td>
                            <td width="50%">
                                <a href="{{ route('cate.getidcate', ['id_edit' => $ct->id]) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Sửa</a>
                                <a href="" class="btn btn-danger delcate" data-id="{{$ct->id}}"><i class="fas fa-trash"></i> Xóa</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <form id="form_delete" action="{{ route('cate.delcate') }}" method="post">
                @csrf
                    <input type="hidden" name="delete_id" id="delete_id">
                </form>
                </div>
                <!-- /.card --> 
            </div>
            
        </div>
        
        <ul class="pagination">
        {{ $cate->links() }}
        </ul> 
        </div><!--  end card body -->
        </div>
    </section>
@endsection
@push('head')
<link rel="stylesheet" href="{{ asset('back/mycss/listviewadmin.css') }}">
@endpush

@push('scripts')
<script>
    function deleteData(event){
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
                
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                $('#delete_id').val($(this).attr('data-id'))
                $('#form_delete').submit();
            }
        })
    }
    $(function () {
        $(document).on('click', '.delcate', deleteData);
    });

    $(document).ready(function () {

        // limit record mySelect
        $('#mySelect').on('change', function() {
            $('#frm_search').submit();
          });
          
        $('#daySearchs').on('change', function() {
            $('#frm_search').submit();
          });

        //page action
        $('a.page-link').click(function(e) {
              e.preventDefault();
              console.log($(this).attr('href'));
              $('#frm_search').attr('action', $(this).attr('href'));
              $('#frm_search').submit();
              return false;
          });
        //sort
        $('.header_column').click(function(e){
            $('#frm_order_by').val($(this).attr('data-id'));
            if ($('#frm_order_type').val() == "asc") {
                $('#frm_order_type').val('desc');
            } else {
                $('#frm_order_type').val('asc');
            }
            $('#frm_search').submit();
          });

    })
</script>
@endpush