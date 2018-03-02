<div class="row">
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold" href="{{ route('modules.index') }}">
            {{trans('cpanel.modules')}}&nbsp;&nbsp;
            <span class="badge">{{ $moduleCount }}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold" href="{{ url('cpanel/security/permissions') }}">
            @choice('permissions.title', 2)&nbsp;&nbsp;
            <span class="badge">{{$permissionCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold" href="{{ url('cpanel/security/roles') }}">
            @choice('roles.title', 2)&nbsp;&nbsp;
            <span class="badge">{{$roleCount}}</span>
        </a>
    </div>
</div>