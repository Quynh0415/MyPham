@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Thêm Admin <a href="{{route('admins.index')}}" class="btn btn-success">Danh Sách</a>
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
                    <form role="form" action="{{route('admins.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            @if($errors->has('role_id'))
                                <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                            @endif
                                            <label>Chọn Quyền</label>
                                            <select class="form-control has-error" name="role_id">
                                                <option value="">-- chọn --</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block"> {{$errors->first('role_id')}} </span>
                                        </div>
                                        @if($errors->has('name'))
                                            <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                        @endif
                                                        <label for="exampleInputEmail1">Họ Tên</label>
                                                        <input type="text" class="form-control" id="name" name="name"
                                                               placeholder="Nhập họ & tên" value="{{old('name')}}">
                                                        <span class="help-block"> {{$errors->first('name')}} </span>
                                                    </div>
                                                    @if($errors->has('email'))
                                                        <div class="form-group has-error">
                                                            @else
                                                                <div class="form-group">
                                                                    @endif
                                                                    <label for="exampleInputEmail1">Email</label>
                                                                    <input type="text" class="form-control" id="email"
                                                                           name="email" placeholder="Nhập Email" value="{{old('email')}}">
                                                                    <span
                                                                        class="help-block"> {{$errors->first('email')}} </span>
                                                                </div>
                                                                @if($errors->has('password'))
                                                                    <div class="form-group has-error">
                                                                        @else
                                                                            <div class="form-group">
                                                                                @endif
                                                                                <label for="exampleInputEmail1">Mật
                                                                                    khẩu</label>
                                                                                <input type="password"
                                                                                       class="form-control"
                                                                                       id="password"
                                                                                       name="password"
                                                                                       placeholder="Nhập password" value="{{old('password')}}">
                                                                                <span
                                                                                    class="help-block"> {{$errors->first('password')}} </span>
                                                                            </div>
                                                                            @if($errors->has('avatar'))
                                                                                <div class="form-group has-error">
                                                                                    @else
                                                                                        <div class="form-group">
                                                                                            @endif
                                                                                            <label
                                                                                                for="exampleInputFile">Avatar</label>
                                                                                            <input type="file"
                                                                                                   id="avatar"
                                                                                                   name="avatar">
                                                                                            <span
                                                                                                class="help-block"> {{$errors->first('avatar')}} </span>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <input type="checkbox"
                                                                                                       value="1"
                                                                                                       name="is_active">
                                                                                                Kích hoạt tài khoản
                                                                                            </label>
                                                                                        </div>
                                                                                </div>
                                                                                <!-- /.box-body -->

                                                                                <div class="box-footer">
                                                                                    <button type="submit" class="btn btn-primary">Tạo</button>
                                                                                    <input type="reset" class="btn btn-default pull-right" value="Reset">
                                                                                </div>
                                                                    </div>
                                                        </div>
                                            </div>
                                </div>
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
