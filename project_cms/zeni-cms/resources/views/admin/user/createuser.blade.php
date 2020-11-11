@extends('admin.layouts.app')
@section('title') Thêm thành viên @endsection
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
                    <form role="form" method="POST" action="{{ route('store.user') }}">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Full name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                            @error('name')
                            <small class="error-validation">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            @error('email')
                            <small class="error-validation">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            @error('password')
                            <small class="error-validation">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control select2bs4" name="role" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                              <option value="0" selected="selected">User</option>
                              <option value="1">Admin</option>
                            </select>
                            @error('role')
                            <small class="error-validation">{{ $message }}</small>
                            @enderror
                        </div>
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection