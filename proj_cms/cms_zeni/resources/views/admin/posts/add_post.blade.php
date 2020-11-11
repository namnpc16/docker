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
                            <input type="file" name="img" class="form-control @error('img') is-invalid @enderror">
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
    $(function () {

        // Summernote
        $('.textarea').summernote();
    })
</script>
<script src="{{ asset('back/js/slug.js') }}"></script>
@endpush

