@extends('admin.layouts.app')
@section('title') Trang quản trị bài viết @endsection

@section('content')
<section class="content">
    <!-- Default box -->
    <div class="card card-primary">
        <div class="card-body">
            <div class="bootstrap-table">
                <div class="table-responsive">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-check"></i>
                        Success alert preview. This alert is dismissable.
                    </div>
                    <a href="{{ route('create.post') }}" class="btn btn-primary">Thêm bài viết</a>
                    <table class="table table-bordered" style="margin-top:20px;">
    
                        <thead>
                            <tr class="bg-primary">
                                <th>ID</th>
                                <th>Thông tin bài viết</th>
                                <th>Ngày tạo</th>
                                <th>Tình trạng</th>
                                <th>Danh mục</th>
                                <th width='18%'>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-3"><img src="{{ asset('back/img/import-img.png') }}" alt="Áo đẹp" width="100px" class="thumbnail"></div>
                                        <div class="col-md-9">
                                            <p><strong>Title bài viết : </strong></p>
                                            <p>Chi tiết bài viết :</p>
                                        </div>
                                    </div>
                                </td>
                                <td>500.000 VND</td>
                                <td>
                                    <a class="btn btn-success" href="#" role="button">Hoạt động</a>
                                </td>
                                <td>Áo Khoác Nam</td>
                                <td>
                                    <a href="#" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
                                    <a href="#" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-3"><img src="{{ asset('back/img/import-img.png') }}" alt="Áo đẹp" width="100px" class="thumbnail"></div>
                                        <div class="col-md-9">
                                            <p><strong>Title bài viết : SP01</strong></p>
                                            <p>Chi tiết bài viết :</p>
                                        </div>
                                    </div>
                                </td>
                                <td>500.000 VND</td>
                                <td>
                                    <a class="btn btn-danger" href="#" role="button">Ngưng hoạt động</a>
                                </td>
                                <td>Áo Khoác Nam</td>
                                <td >
                                    <a href="#" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
                                    <a href="#" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                                </td>
                            </tr>
    
    
                        </tbody>
                    </table>
                    <div>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Trở lại</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">tiếp theo</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
@endsection

