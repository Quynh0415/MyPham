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
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{route('admin.dashboard')}}">
                    <i class="fa fa-calendar"></i> <span>Trang chủ</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>

            <li class="">
                <a href="{{route('admins.index')}}">
                    <i class="fa fa-user"></i> QL Admin
                </a>
            </li>

            <li class="">
                <a href="{{route('banner.index')}}">
                    <i class="fa fa-camera"></i> QL Banner
                </a>
            </li>
            <li class="">
                <a href="{{route('category.index')}}">
                    <i class="fa fa-folder-open"></i> QL Danh Mục
                </a>
            </li>
            <li class="">
                <a href="{{route('article.index')}}">
                    <i class="fa fa-folder-open"></i> QL Tin Tức
                </a>
            </li>
            <li class="">
                <a href="{{route('product.index')}}">
                    <i class="fa fa-folder-open"></i> QL Sản Phẩm
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>