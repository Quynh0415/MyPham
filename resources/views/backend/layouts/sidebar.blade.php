<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ (asset(Auth::guard('admin')->user()->avatar)) ? Auth::guard('admin')->user()->avatar : '' }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p></p>
                <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{route('admin.dashboard')}}">
                    <i class="fa fa-line-chart"></i> <span>Thống kê</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>

            <li class="">
                <a href="{{route('admins.index')}}">
                    <i class="glyphicon glyphicon-user"></i> QL Admin
                </a>
            </li>

            <li class="">
                <a href="{{route('banner.index')}}">
                    <i class="fa fa-image"></i> QL Banner
                </a>
            </li>
            <li class="">
                <a href="{{route('category.index')}}">
                    <i class="glyphicon glyphicon-list"></i> QL Danh Mục
                </a>
            </li>
            <li class="">
                <a href="{{route('brand.index')}}">
                    <i class="glyphicon glyphicon-bookmark"></i> QL Thương Hiệu
                </a>
            </li>
            <li class="">
                <a href="{{route('article.index')}}">
                    <i class="fa  fa-newspaper-o"></i> QL Tin Tức
                </a>
            </li>
            <li class="">
                <a href="{{route('product.index')}}">
                    <i class="fa  fa-book"></i> QL Sản Phẩm
                </a>
            </li>

            <li class="">
                <a href="{{route('coupon.index')}}">
                    <i class="glyphicon glyphicon-gift"></i> QL Mã Giảm Giá
                </a>
            </li>

            <li class="">
                <a href="{{route('setting.index')}}">
                    <i class="fa  fa-gears"></i> Cấu hình website
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
