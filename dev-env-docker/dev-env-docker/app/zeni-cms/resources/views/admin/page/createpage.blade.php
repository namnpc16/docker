@extends('admin.layouts.app')
@section('title') Thêm mới Pages @endsection
@section('content')
<section class="content">
    <!-- Default box -->
    <div class="card card-primary">
        <div class="card-body">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">{{ config('app.name') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('store.page') }}">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tiêu đề</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                        @error('title')
                            <small class="error-validation">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mô tả chi tiết</label>
                        <div class="mb-3">
                            <textarea class="textarea" name="content" placeholder="Place some text here"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('content') }}</textarea>
                        </div>
                        @error('content')
                            <small class="error-validation">{{ $message }}</small>
                        @enderror
                        <p class="text-sm mb-0">
                            Editor <a href="https://github.com/summernote/summernote">Documentation and license
                            information.</a>
                        </p>
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" id="sbm" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
    <!-- /.card -->
</section>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('.textarea').summernote()
        })
    </script>
@endpush