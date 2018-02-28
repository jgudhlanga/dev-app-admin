@if(count($permissions) > 0)
    @foreach($permissions->chunk(3) as $chunk)
        <div class="row margin-top-5">
            @foreach($chunk as $permission)
                <div class="col-md-4">
                    <div class="checkbox checkbox-success">
                        <input id="{{$permission->id}}"  type="checkbox"  name="permissions[{{$permission->id}}]" value="{{$permission->id}}" >
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