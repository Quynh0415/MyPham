@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Sửa thông tin Admin <a href="{{route('admins.index')}}" class="btn btn-success"><i class="fa fa-list"></i> Danh Sách Admin</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin Admin</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admins.update', ['id' => $admin->id ] )}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            @if($errors->has('role_id'))
                                <div class="form-group has-error">
                                    @else
                                    <div class="form-group">
                                        @endif
                                        <label>Chọn Quyền</label>
                                        <select class="form-control" name="role_id">
                                            <option value="" >-- chọn --</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ ($admin->role_id == $role->id) ? 'selected' : '' }} >{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                            @if($errors->has('name'))
                                <div class="form-group has-error">
                                    @else
                                    <div class="form-group">
                                        @endif
                                        <label for="exampleInputEmail1">Họ Tên</label>
                                        <input value="{{ $admin->name }}" type="text" class="form-control" id="name" name="name" placeholder="Nhập họ & tên">
                                        <span class="help-block"> {{$errors->first('name')}} </span>
                                    </div>
                            @if($errors->has('email'))
                                <div class="form-group has-error">
                                    @else
                                    <div class="form-group">
                                        @endif
                                        <label for="exampleInputEmail1">Email</label>
                                        <input value="{{ $admin->email }}" type="text" class="form-control" id="email" name="email" placeholder="Nhập Email">
                                        <span class="help-block"> {{$errors->first('email')}} </span>
                                    </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" style="color: #9c3328">** Mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nhập mật khẩu mới">
                            </div>
                            @if($errors->has('avatar'))
                                <div class="form-group has-error">
                                    @else
                                    <div class="form-group">
                                        @endif
                                        <label for="exampleInputFile" style="color: #9c3328">** Thay đổi ảnh đại diện</label>
                                        <input type="file" id="new_avatar" name="new_avatar">
                                        <br>
                                        <img src="{{ asset($admin->avatar) }}" width="250">
                                        <span class="help-block"> {{$errors->first('avatar')}} </span>
                                    </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="is_active" {{ ($admin->is_active == 1) ? 'checked' : '' }}> Kích hoạt tài khoản
                                </label>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->


            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
@endsection
