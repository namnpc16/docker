@extends('admin.layouts.app')
@section('title') Thêm mới danh mục @endsection
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-body">
            <div class="col-sm-12 col-xs-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thêm mới </h3>
                    </div>
                    
                    
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" id="quickForm" action="{{route('cate.addcate')}}" method="post">
                        @csrf
                        <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInput1">Tên danh mục</label>
                            <input type="text" name="namecate" value="{{ old('namecate')}}" class="form-control @error('namecate') is-invalid @enderror" id="name" placeholder="Nhập tên danh mục...">
                            @if($errors->has('namecate'))
                            <i><span class="text-danger"> {{$errors->first('namecate')}}</span></i>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInput1">Slug name</label>
                            <input readonly type="text" name="slugcate" value="{{ old('slugcate')}}" class="form-control @error('slugcate') is-invalid @enderror" id="slug" placeholder="Nhập slug name...">
                            @if($errors->has('slugcate'))
                            <i><span class="text-danger"> {{$errors->first('slugcate')}}</span></i>
                            @endif
                        </div>
                        <div class="form-group">
                            <input class="form-control btn btn-outline-success" type="submit" name="" value="Thêm mới">
                        </div>
                        </div>
                    </form>
                </div>  
            </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection

@push('scripts')
<script src="{{ asset('back/js/slug.js') }}"></script>
@endpush





