@extends('admin.layouts.app')
@section('title') Thêm Tin Mới @endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            @if(session()->has('tb'))
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Thông Báo!</h4>
                <p>{{ session()->get('tb') }}</p>
            </div>
            @endif
            <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <a href="{{route('getlistView.posts')}}" class="btn btn-outline-primary"><i class="fas fa-arrow-circle-left"></i> Quay lại</a>
                <hr>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thêm Tin Mới</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" id="quickForm" action="{{ route('adddata.posts') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body"> 
                        <div class="form-group">
                            <label for="exampleInput1">Tiêu đề bài viết</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" id="name" placeholder="Nhập tiêu đề...">
                            @if($errors->has('title'))
                            <i class="text-danger">{{$errors->first('title')}}</i>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInput1">Slug Title</label>
                            <input readonly type="text" name="slugtitle" value="{{ old('slugtitle') }}" class="form-control @error('slugtitle') is-invalid @enderror" id="slug" placeholder="Nhập slug title...">
                            @if($errors->has('slugtitle'))
                            <i class="text-danger">{{$errors->first('slugtitle')}}</i>
                            @endif
                        </div>
                        
                         <!-- tools box -->
                        <div class="form-group">
                            <div class="mb-3">
                                <textarea name="txtarea" class="textarea @error('txtarea') is-invalid @enderror" value="" placeholder="Place some text here"
                                    style="width: 100%; height: 200px;important font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                    {{ old('txtarea') }}
                                </textarea>
                            </div>
                            @if($errors->has('txtarea'))
                            <i class="text-danger">{{$errors->first('txtarea')}}</i>
                            @endif
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="exampleInput1">Chọn Ảnh: </label>
                            <input hidden id="img" type="file" name="img" class="form-control" onchange="changeImg(this)">
                            <img id="avatar" class="thumbnail img_select @error('img') is-invalid @enderror" width="300px" src="{{ asset('storage/posts/select_img.png') }}">
                            
                            @if($errors->has('img'))
                            <i class="text-danger">{{$errors->first('img')}}</i>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="my-select">Active</label>
                            <select id="my-select" class="form-control" name="active">
                                <option value="0">N-Active</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="my-select">Chọn danh mục</label>
                            <select name="cate_id[]" class="select2 form-control" multiple="multiple" data-placeholder="Danh mục..." style="width: 100%;">
                                <option value="">option</option>
                                @foreach($cate as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                                @endforeach
                                        
                            </select>
                        </div>
                        

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input class="form-control btn btn-outline-primary" type="submit" name="" value="Thêm">
                        
                        </div>
                        
                    </form>
                </div>
                    <!-- /.card -->
            </div>
            
            </div>
            <!-- /.row -->
            
            </div><!-- /.container-fluid -->
    </section>
@endsection
@push('head')
<link rel="stylesheet" href="{{ asset('back/mycss/listviewadmin.css') }}">
@endpush
@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('.select22').select2();
    });
</script>

<script src="{{ asset('back/mycss/myscript.js') }}"></script>
<script>
  
  $(document).ready(function(){
    
    // Define function to open filemanager window
    var lfm = function(options, cb) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/admin/laravel-filemanager';
      window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
      window.SetUrl = cb;
    };

    // Define LFM summernote button
    var LFMButton = function(context) {
      var ui = $.summernote.ui;
      var button = ui.button({
        contents: '<i class="note-icon-picture"></i> ',
        tooltip: 'Insert image with filemanager',
        click: function() {

          lfm({type: 'image', prefix: '/admin/laravel-filemanager'}, function(lfmItems, path) {
            lfmItems.forEach(function (lfmItem) {
              context.invoke('insertImage', lfmItem.url);
            });
          });
        }
      });
      return button.render();
    };

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    $('.textarea').summernote({
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['popovers', ['lfm']],
      ],
      buttons: {
        lfm: LFMButton
      }
    })
    //var route_prefix = "/admin/laravel-filemanager";
    //$('#img').filemanager('image', {prefix: route_prefix});
  });

</script>


<script src="{{ asset('back/js/slug.js') }}"></script>
@endpush

@push('head')
<style>
    li.select2-selection__choice {
        background: #0b6f43 !important;
    }
</style>
@endpush


