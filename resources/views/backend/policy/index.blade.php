@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Hỗ trợ khách hàng <a href="{{route('admin.policy.create')}}" type="button"
                                  class="btn bg-olive btn-flat margin">Thêm chính sánh</a>
        </h1>
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
                                <th>Chính sách hỗ trợ</th>
                                <th class="text-center">Tác Vụ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($policy as $key => $item)
                                <tr class="item-{{$item->id}}">
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.policy.edit', ['id'=> $item->id])}}" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></a>
                                        <button onclick="deleteItem('policy',{{ $item->id }})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
