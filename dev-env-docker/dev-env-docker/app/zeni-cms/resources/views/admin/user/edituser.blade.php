@extends('admin.layouts.app')
@section('title') Sửa thành viên @endsection
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
                    <form role="form" method="POST" action="{{ route('update.user', ['id' => $user->id]) }}">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Full name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{ $user->name }}" placeholder="Enter name">
                            @error('name')
                              <small class="error-validation">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="text" name="email" class="form-control" value="{{ $user->email }}" id="exampleInputEmail1" placeholder="Enter email">
                          @error('email')
                            <small class="error-validation">{{ $message }}</small>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          @error('password')
                            <small class="error-validation">{{ $message }}</small>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control select2bs4" name="role" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                              <option value="0" @if ($user->role == 0)
                                  selected
                              @endif>User</option>
                              <option value="1" @if ($user->role == 1)
                                  selected
                              @endif>Admin</option>
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