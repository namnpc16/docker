@extends('admin.layouts.app')
@section('title') Sửa danh mục @endsection
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form sửa danh mục </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="quickForm" action="{{ route('cate.editcate') }}" method="post">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <input  type="hidden" name="idcate" value = "{{$cate->id}}" class="form-control">
                    <label for="exampleInput1">Tên danh mục bài viết</label>
                    <input type="text" name="namecate" value = "{{$cate->name}}" class="form-control @error('namecate') is-invalid @enderror" id="name" placeholder="Nhập tên danh mục...">
                    @if($errors->has('namecate'))
                    <i><span class="text-danger">{{$errors->first('namecate')}}</span></i>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="exampleInput1">Slug name</label>
                    <input readonly type="text" name="slugcate" value = "{{$cate->slug}}" class="form-control @error('slugcate') is-invalid @enderror" id="slug" placeholder="Nhập slug name...">
                    @if($errors->has('slugcate'))
                    <i>
                    <span class="text-danger">{{$errors->first('slugcate')}}</span>
                    </i>
                    @endif
                </div>
                

                <div class="form-group">
                    <input class="form-control btn btn-outline-primary" type="submit" name="" value="Lưu">
                </div>
                </div>
            </form>
        </div>  
        <!-- /.card -->
    </section>
@endsection
@push('scripts')
<script src="{{ asset('back/js/slug.js') }}"></script>
@endpush