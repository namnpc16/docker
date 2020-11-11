@extends('admin.layouts.app')
@section('title') Sửa bài viết @endsection

@section('content')
<section class="content">
    <!-- Default box -->
    <div class="card card-primary">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề bài viết</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control select2" name="active" style="width: 100%;">
                            <option selected="selected" value="1">active</option>
                            <option value="0">deactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select multiple size="7" name="category_id[]" class="form-control">
                              <option>option 1</option>
                              <option>option 2</option>
                              <option>option 3</option>
                              <option>option 4</option>
                              <option>option 5</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ảnh bài viết</label>
                            <input id="img" type="file" name="img" style="display: none;" class="form-control hidden"
                                onchange="changeImg(this)">
                            <img id="avatar" style="border: 1px solid #636e72; border-radius: 4px; cursor: pointer;" class="thumbnail" width="100%" height="350px" src="{{ asset('back/img/import-img.png') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Chi tiết bài viết</label>
                            <div class="mb-3">
                                <textarea class="textarea" name="content" placeholder="Place some text here"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <p class="text-sm mb-0">
                                Editor <a href="https://github.com/summernote/summernote">Documentation and license
                                information.</a>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card -->
</section>
@endsection

@push('scripts')
    <script>
        $(function () {
            // Summernote
            $('.textarea').summernote()
        })
    </script>

    <script>
        function changeImg(input){
            //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
            if(input.files && input.files[0]){
                var reader = new FileReader();
                //Sự kiện file đã được load vào website
                reader.onload = function(e){
                    //Thay đổi đường dẫn ảnh
                    $('#avatar').attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function() {
            $('#avatar').click(function(){
                $('#img').click();
            });
        });

    </script>
@endpush