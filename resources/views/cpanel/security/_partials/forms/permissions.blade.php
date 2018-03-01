@if(count($permissions) > 0)
    <div class="row margin-top-5">
        <div class="col-md-12">
            <div class="checkbox checkbox-primary">
                <input id="check_all"  type="checkbox"  name="check_all" >
                <label for="check_all" class="text-primary text-bold">@lang('general.check_all')</label>
            </div>
        </div>
    </div>
    @foreach($permissions->chunk(4) as $chunk)
        <div class="row margin-top-5">
            @foreach($chunk as $permission)
                <div class="col-md-3">
                    <div class="checkbox checkbox-success">
                        <input id="{{$permission->id}}"  type="checkbox"  name="permissions[{{$permission->id}}]"
                               value="{{$permission->id}}"
                                @php
                                    if(isset($rolePermissions) && count($rolePermissions) > 0)
                                        if(in_array($permission->id, $rolePermissions)) echo "checked='checked'";
                                @endphp >
                        <label for="{{$permission->id}}">{{$permission->display_name}}</label>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@else
    <div class="col-md-12 alert alert-warning" role="alert">
        @lang('permissions.no_records')
    </div>
@endif