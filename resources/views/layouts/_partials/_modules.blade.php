@isset($systemModules)
    @foreach($systemModules as $module)
        @php
            $active = ($module->module_url == $currentModule) ? 'active' : '';
            if(strtolower($module->title) == 'home' && $currentModule == '') $active='active';
        @endphp
        @if(count($module->pages) > 0)
            <li class="treeview {{$active}}">
                <a href="#" class="text-bold"><i class="{{$module->class}}"></i>
                    <span>{{$module->title}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @foreach($module->pages as $page)
                        <li><a href="{{ url($page->page_url) }}" class="{{$page->class}}">&nbsp;{{$page->title}}</a></li>
                    @endforeach
                </ul>
            </li>
        @else
            <li class="{{$active}}">
                <a href="{{ url($module->module_url) }}" class="text-bold">
                    <i class="{{$module->class}}"></i>
                    <span>{{$module->title}}</span>
                </a>
            </li>
        @endif
    @endforeach
@endisset
