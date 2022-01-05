@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Chi tiết sản phẩm <a href="{{route('admin.product.index')}}" class="btn btn-flat btn-success">Danh Sách
                SP</a>
        </h1>
    </section>
    <!-- Main content -->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Thông tin sản phẩm</h4>
                </div>

                <div class="box-body">
                    <form role="form" action="{{ route('admin.product.update',['id'=>$product->id])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if($errors->has('name'))
                            <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                        @endif
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$product->name}}">
                                        <span class="help-block"> {{$errors->first('name')}} </span>
                                    </div>
                                    @if($errors->has('image'))
                                        <div class="form-group has-error">
                                            @else
                                                <div class="form-group">
                                                    @endif
                                                    <label for="exampleInputFile">Thay đổi ảnh sản phẩm</label>
                                                    <input type="file" class="" id="new_image" name="new_image"><br>
                                                    <img src="{{asset($product->image)}}" width="200">
                                                    <span class="help-block"> {{$errors->first('image')}} </span>
                                                </div>

                                                @if($errors->has('categories_id'))
                                                    <div class="form-group has-error">
                                                        @else
                                                            <div class="form-group">
                                                                @endif
                                                                <div class="col-md-6">
                                                                    <label>Danh mục sản phẩm</label>
                                                                    <select class="form-control w-50"
                                                                            name="categories_id">
                                                                        <option value="0">--Chọn danh mục--</option>
                                                                        @foreach($categories as $category)
                                                                            <option
                                                                                value="{{ $category->id }}" {{($category->id == $product->categories_id) ? 'selected' : ''}} >
                                                                                {{ $category->name }}</option>
                                                                        @endforeach
                                                                        <span
                                                                            class="help-block"> {{$errors->first('categories_id')}} </span>
                                                                    </select>
                                                                </div>
                                                                @if($errors->has('brands_id'))
                                                                    <div class="col-md-6 has-error">
                                                                        @else
                                                                            <div class="col-md-6">
                                                                                @endif
                                                                                <label>Thương hiệu</label>
                                                                                <select class="form-control w-50"
                                                                                        name="brands_id">
                                                                                    <option value="0">--Chọn Thương
                                                                                        Hiệu--
                                                                                    </option>
                                                                                    @foreach($brands as $brand)
                                                                                        <option
                                                                                            value="{{$brand->id}}" {{($brand->id == $product->brands_id) ? 'selected' : ''}}>{{$brand->name}}</option>
                                                                                        <span
                                                                                            class="help-block">{{$errors->first('brands_id')}}</span>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" value="1"
                                                                                               name="is_active" {{ ($product->is_active == 1 ) ? 'checked': '' }}>
                                                                                        Trạng thái hiển thị
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="exampleInputEmail1">Vị
                                                                                    trí</label>
                                                                                <input type="number"
                                                                                       class="form-control"
                                                                                       id="position" name="position"
                                                                                       value="{{ $product->position }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input
                                                                                            {{ ($product->is_hot == 1 ) ? 'checked': '' }} type="checkbox"
                                                                                            value="1" name="is_hot">
                                                                                        Sản phẩm hot
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input
                                                                                            {{ ($product->prod_new == 1 ) ? 'checked': '' }} type="checkbox"
                                                                                            value="1" name="prod_new">
                                                                                        Sản phẩm mới
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="form-group">
                                                                            <label>Nội dung</label>
                                                                            <textarea id="editor1" name="content"
                                                                                      class="form-control"
                                                                                      rows="10"
                                                                                      placeholder="Enter ...">{{$product->content}}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Mô tả</label>
                                                                            <textarea id="editor2" name="description"
                                                                                      class="form-control"
                                                                                      rows="10"
                                                                                      placeholder="Enter ...">{{$product->description}}</textarea>
                                                                        </div>
                                                                        <div class="box-footer">
                                                                            <button type="submit"
                                                                                    class="btn btn-primary">Cập
                                                                                nhật
                                                                            </button>
                                                                        </div>
                                                                    </div>
                    </form>

                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>Thêm biến thể sản phẩm</h4>
                </div>
                <div class="box-body">
                    <form role="form" action="{{ route('admin.products_detail.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Thể tích</label>
                            <input type="text" class="form-control" id="size" name="size"
                                   value="{{old('size')}}">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Màu</label>
                            <input type="text" class="form-control" id="color" name="color"
                                   value="{{old('color')}}">
                        </div>
                        @if($errors->has('stock'))
                            <div class="col-md-6 has-error">
                                @else
                                    <div class="col-md-6">
                                        @endif
                                        <label for="exampleInputEmail1">Số lượng</label>
                                        <input type="text" class="form-control" id="stock" name="stock"
                                               value="{{old('stock')}}">
                                        <span class="help-block"> {{$errors->first('stock')}} </span>
                                    </div>
                                    @if($errors->has('price'))
                                        <div class="col-md-6 has-error">
                                            @else
                                                <div class="col-md-6">
                                                    @endif
                                                    <label for="exampleInputEmail1">Đơn Giá</label>
                                                    <input type="text" class="form-control" id="price" name="price"
                                                           value="{{old('price')}}">
                                                    <span class="help-block"> {{$errors->first('price')}} </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1">Khuyến mại</label>
                                                    <input type="text" class="form-control" id="sale"
                                                           name="sale"
                                                           value="{{old('sale')}}">
                                                    <button type="submit" class="btn btn-primary">Lưu
                                                    </button>
                                                </div>






                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>Danh sách biến thể sản phẩm</h4>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>TT</th>
                            <th>Thể tích</th>
                            <th>Số lượng</th>
                            <th>Màu</th>
                            <th>Đơn giá</th>
                            <th class="text-center">Tác vụ</th>
                        </tr>
                        </thead>

                        <tbody>
                        <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                        @foreach($product->products_detail as $key => $item)
                            <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                <td>{{ $key + 1}}</td>
                                <td>{{ $item->size }}</td>
                                <td>
                                    {{ $item->stock }}
                                </td>
                                <td>{{ $item->color }}</td>
                                <td>{{ $item->price }}</td>
                                <td class="text-center">
                                    <a data-target="#myModal-{{$key}}" data-toggle="modal"
                                       {{--                                       href="{{route('products_detail.edit',['id'=>$item->id])}}"--}}
                                       class="btn btn-primary">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <button onclick="deleteItem('products_detail',{{ $item->id }})"
                                            class="btn btn-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </td>
                                <div class="modal fade" id="myModal-{{$key}}" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                                <h3 class="modal-title">Cập nhật biến thể sản phẩm</h3>
                                            </div>
                                            <div class="modal-body" style="text-align: start;">
                                                <div class="cart cart-order" style="display: flex;">
                                                    <div class="cart-l" style="padding: 1rem;">
                                                    </div>
                                                    <div class="cart-r" style="width: 100%">
                                                        <form role="form"
                                                              action="{{ route('admin.products_detail.update', ['id'=>$item->id])}}"
                                                              method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="product_id"
                                                                   value="{{$product->id}}">
                                                            <div class="col-md-6">
                                                                <label for="exampleInputEmail1">Thể tích</label>
                                                                <input type="text" class="form-control" id="size"
                                                                       name="size"
                                                                       value="{{$item->size}}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="exampleInputEmail1">Màu</label>
                                                                <input type="text" class="form-control" id="color"
                                                                       name="color"
                                                                       value="{{$item->color}}">
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="exampleInputEmail1">Số
                                                                    lượng</label>
                                                                <input type="text" class="form-control"
                                                                       id="stock"
                                                                       name="stock"
                                                                       value="{{$item->stock}}">

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="exampleInputEmail1">Đơn
                                                                    Giá</label>
                                                                <input type="text" class="form-control"
                                                                       id="price"
                                                                       name="price"
                                                                       value="{{$item->price}}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="exampleInputEmail1">Giá
                                                                    KM</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       id="sale"
                                                                       name="sale"
                                                                       value="{{$item->sale}}">
                                                            </div>
{{--                                                            <div class="col-md-6">--}}
{{--                                                                <label for="exampleInputEmail1">Giá sau KM</label>--}}
{{--                                                                <input type="text" class="form-control" id="subtotal"--}}
{{--                                                                       name="sale"--}}
{{--                                                                       value="">{{$item->subtotal}}--}}
{{--                                                            </div>--}}

                                                            <div class="col-md-12">
                                                                <button type="submit"
                                                                        class="btn btn-primary">Lưu
                                                                </button>

                                                                <button type="button" class="btn close pull-right"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
    <!-- /.content -->

@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            // setup textarea sử dụng plugin CKeditor
            var _ckeditor = CKEDITOR.replace('editor1');
            _ckeditor.config.height = 200; // thiết lập chiều cao
            var _ckeditor = CKEDITOR.replace('editor2');
            _ckeditor.config.height = 200; // thiết lập chiều cao
        })
    </script>
@endsection
