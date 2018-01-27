<aside class="main-sidebar">

    <section class="sidebar">

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <ul class="sidebar-menu">

            @include('layouts._partials._modules')

            @php
                $class = (isset($currentModule) && $currentModule == 'admin') ? 'active' : '';
            @endphp
            <li class="treeview {{$class}}">
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
    </section>
</aside>