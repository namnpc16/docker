@extends('admin.layouts.app')
@section('title') Danh Sách Tin @endsection
@section('content')
    <section class="content">
        <div class="row">
          <div class="col-12">
            @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible">
              <h4><i class="icon fa fa-check"></i> Thông Báo!</h4>
              <p>{{ session()->get('success') }}</p>
          </div>
          @endif
          @if(session()->has('error'))
          <div class="alert alert-danger alert-dismissible">
              <h4><i class="icon fa fa-remove"></i> Thông Báo!</h4>
              <p>{{ session()->get('error') }}</p>
          </div>
          @endif
            <a href="{{route('addView.posts')}}" class="btn btn-outline-success"><i class="fas fa-plus-square"></i> Thêm bài viết mới</a>
            <a href="{{route('listView.posts')}}" class="btn btn-outline-primary"><i class="fas fa-retweet"></i> Reload</a>
            <a href="{{route('tras.posts')}}" class="btn btn-outline-warning float-right"><i class="fas fa-recycle"></i> Thùng rác</a>
            <hr>
            <div class="card card-default">
            
              <div class="card-header">
                <form id="frm_search" action="{{ route('listView.posts') }}" method="post">
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
                <table class="table table-hover table-bordered text-nowrap">
                  <thead>
                    <tr class="bg-primary" >
                      <th width="5%"><a href="javascript:void(0)" class="header_column" data-id="id" style="color:white;"> ID</a></th>
                      <th width="27%"><a href="javascript:void(0)" class="header_column" data-id="title" style="color:white;">Tiêu Đề</a></th>
                      <th width="20%"><a href="javascript:void(0)" class="header_column" data-id="img" style="color:white;">Ảnh</a></th>
                      <th width="14%"><a href="javascript:void(0)" class="header_column" data-id="created_at" style="color:white;">Ngày tạo</a></th>
                      <th width="20%"><a href="javascript:void(0)" style="color:white;">Thuộc danh mục</a></th>
                      <th width="18%">Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($post as $p)
                    <tr>
                      <td width="5%">{{ $p->id }}</td>
                      <td width="27%"><p class="textstr">{{ Str::limit($p->title, $limit = 40, $end = '...')}}</p></td>
                      
                      <td width="20%"><img src="{{asset('/storage/posts') }}/{{$p->img}}" alt="" width="100%"></td>
                      <td width="14%">{{ $p->created_at }}</td>
                      <td width="20%">
                      <div width="100%" height="100px">
                      @php
                      $a = $p->rolesPostCate()->pluck('categories.id');
                      @endphp
                      
                        @foreach($cate as $ct)
                          @if($a->contains($ct->id) == true)
                          <i class="btn btn-outline-success">{{$ct->name}}</i> <br> <br>
                          @endif
                        @endforeach
                      
                      </div>
                      </td>
                      <td width="18%">
                        <a href="{{ route('editview.posts', ['id'=>$p->id]) }}" class="btn btn-outline-warning"><i class="fas fa-edit"></i> Chi tiết</a>
                        <a href="" data-id="{{$p->id}}" class="btn btn-outline-danger delpost"><i class="far fa-minus-square"></i> Xóa</a> 
                      </td>
                    </tr>
                  @endforeach
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <form id="form_delete" action="{{ route('del.posts') }}" method="post">
                @csrf
                <input type="hidden" name="delete_id" id="delete_id">
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        <ul class="pagination">
        {{ $post->links() }}
        </ul> 

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
              // var id =$(this).attr('data-id')
              //     console.log(id)
              $('#delete_id').val($(this).attr('data-id'))
              $('#form_delete').submit();
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
        })
    }
    $(function () {
        $(document).on('click', '.delpost', deleteData);
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