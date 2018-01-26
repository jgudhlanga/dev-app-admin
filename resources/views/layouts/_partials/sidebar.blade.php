<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- search form (Optional) -->
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

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-group"></i> <span>CHMS</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('chms') }}" class="fa fa-circle-o">&nbsp;Dashboard</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cart-plus"></i> <span>eProcurement</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu"><dbn>z</dbn>
                    <li><a href="{{ url('procurement') }}" class="fa fa-circle-o">&nbsp;Dashboard</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-bed"></i> <span>HMS</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('hms') }}" class="fa fa-circle-o">&nbsp;Dashboard</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-group"></i> <span>&nbsp;{{trans('users.users')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('users') }}" class="fa fa-circle-o">&nbsp;{{trans('users.home')}}</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-wrench"></i> <span>&nbsp;{{trans('admin.c_panel')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin') }}" class="fa fa-circle-o">&nbsp;{{trans('admin.settings')}}</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>