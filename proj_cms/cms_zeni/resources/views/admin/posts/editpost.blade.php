@extends('admin.layouts.app')
@section('title') Sửa Tin @endsection
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
                        <h3 class="card-title">....</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" id="quickForm" action="{{ route('edit.posts') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body"> 
                        <input type="hidden" name="idpost" value="{{ $post->id }}">
                        <div class="form-group">
                            <label for="exampleInput1">Tiêu đề bài viết</label>
                            <input type="text" name="title" value="{{$post->title}}" class="form-control @error('title') is-invalid @enderror" id="name" placeholder="Nhập tiêu đề...">
                            @if($errors->has('title'))
                            <i class="text-danger">{{$errors->first('title')}}</i>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInput1">Slug Title</label>
                            <input readonly type="text" name="slugtitle" value="{{$post->slug}}" class="form-control @error('slugtitle') is-invalid @enderror" id="slug" placeholder="Nhập slug title...">
                            @if($errors->has('slugtitle'))
                            <i class="text-danger">{{$errors->first('slugtitle')}}</i>
                            @endif
                        </div>
                        
                         <!-- tools box -->
                        <div class="form-group">
                            <div class="mb-3">
                                <textarea name="txtarea" value="{{$post->content}}" class="textarea @error('txtarea') is-invalid @enderror" placeholder="Place some text here"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                    {{$post->content}}
                                </textarea>
                            </div>
                            @if($errors->has('txtarea'))
                            <i class="text-danger">{{$errors->first('txtarea')}}</i>
                            @endif
                        </div>

                        <div class="form-group">
                        <img src="{{asset('/storage/posts') }}/{{$post->img}}" alt="">
                        </div>
                        <div class="form-group">
                            <input readonly type="text" name="img_old" value="{{$post->img}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="file" name="img" class="form-control">
                        </div>
                        @if($errors->has('img'))
                        <p class="alert alert-danger"><i class="icon fa fa-ban"></i> {{$errors->first('img')}}</p>
                        @endif
                        <div class="form-group">
                            <label for="my-select">Active</label>
                            <select id="my-select" class="form-control" name="active">
                                <option value="0" {{ $post->active =='0'?'selected':''}}>No-Active</option>
                                <option value="1" {{ $post->active =='1'?'selected':''}}>Active</option>
                            </select>
                        </div>
                        
                        
                        

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input class="form-control btn btn-outline-primary" type="submit" name="" value="Lưu">
                        
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

