@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Danh Sách Danh Mục <a href="{{route('category.create')}}" class="btn bg-olive btn-flat margin"> Thêm Danh Mục</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <td>TT</td>
                                <th>Tên danh mục</th>
                                <th>Hình ảnh</th>
{{--                                <th>Danh mục cha</th>--}}
                                <th>Vị trí</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Tác Vụ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $item)
                                <tr class="item-{{$item->id}}">
                                    <td>{{$key + 1}}</td>

                                    <td>{{$item->name}}</td>
                                    <td>
                                    @if ($item->image) <!-- Kiểm tra hình ảnh tồn tại -->
                                        <img src="{{ asset($item->image)}} " width="50" height="50">
                                        @endif
                                    </td>

                                    <td>{{$item->position}}</td>
                                    <td>{{($item->is_active == 1 ) ? 'Hiển Thị' : 'Ẩn'}}</td>

                                    <td class="text-center">
                                        <a href="{{route('category.edit', ['id'=> $item->id])}}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <button onclick="deleteItem('category',{{ $item->id }})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--                    <!-- /.box-body -->--}}
                    {{--                    <div class="box-footer clearfix">--}}
                    {{--                        <ul class="pagination pagination-sm no-margin">--}}
                    {{--                            {{ $data->links() }}--}}
                    {{--                        </ul>--}}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endsection
