<div class="col-md-6">
    <div class="form-group">
        <label for="title_id" class="col-md-3 control-label text-left">@lang('general.people.title')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <select name="title_id" id="title_id" class="form-control input-sm" required>
                <option value="">@lang('forms.choose')</option>
                @if(count($titles) > 0)
                    @foreach($titles as $title)
                        <option value="{{$title->id}}"
                            @isset($user) @if($user->title_id == $title->id) selected @endif @endisset>
                            {{$title->name}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="title_id" class="col-md-3 control-label text-left">@lang('general.people.gender')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            @if(count($genders) > 0)
                @foreach($genders as $gender)
                    <div class="radio radio-success radio-inline">
                        <input type="radio" id="gender_{{$gender->id}}" value="{{$gender->id}}" name="gender_id" required
                               @isset($user) @if($user->gender_id == $gender->id) checked @endif @endisset >
                        <label for="gender_{{$gender->id}}">{{$gender->name}}</label>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="first_name" class="col-md-3 control-label text-left">@lang('general.people.first_name')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="first_name" id="first_name" required
            value="@isset($user) {{$user->first_name}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="middle_name" class="col-md-3 control-label text-left">@lang('general.people.middle_name')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="middle_name" id="middle_name"
                   value="@isset($user) {{$user->middle_name}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="last_name" class="col-md-3 control-label text-left">@lang('general.people.last_name')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="last_name" id="last_name" required
                   value="@isset($user) {{$user->last_name}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="display_name" class="col-md-3 control-label text-left">@lang('general.people.display_name')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="display_name" id="display_name"
                   value="@isset($user) {{$user->display_name}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-md-3 control-label text-left">@lang('general.people.password')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <input type="password" class="form-control input-sm" name="password" id="password"
               @if(isset($user) && !empty($user))
                   value="{{$user->password}}"
                   disabled
               @else
                   required
               @endif
            >
        </div>
    </div>
    <div class="form-group @if(isset($user) && !empty($user)) hide @endif">
        <label for="c_password" class="col-md-3 control-label text-left">@lang('general.people.c_password')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <input type="password" class="form-control input-sm" name="c_password" id="c_password"
               @if(isset($user) && !empty($user))
                    value="{{$user->password}}"
                    disabled
               @else
                    required
                @endif
            >
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="email" class="col-md-3 control-label text-left">@lang('general.email')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="email" id="email" required
                   value="@isset($user) {{$user->email}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="cell_number" class="col-md-3 control-label text-left">@lang('general.people.cell_number')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="mobile" id="mobile"
                   value="@isset($user) {{$user->mobile}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label text-left">@choice('roles.title', 2)</label>
        <div class="col-md-9">
            @if(count($roles) > 0)
                @foreach($roles->chunk(2) as $chunk)
                    @foreach($chunk as $role)
                        <div class="col-md-6">
                            <div class="checkbox checkbox-success">
                                <input id="{{$role->id}}"  type="checkbox"  name="roles[{{$role->id}}]" value="{{$role->id}}"
                                        @php
                                            if(isset($userRoles) && count($userRoles) > 0)
                                                if(in_array($role->id, $userRoles)) echo "checked='checked'";
                                        @endphp
                                >
                                <label for="{{$role->id}}">{{$role->display_name}}</label>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @else
                <div class="col-md-12 alert alert-warning" role="alert">
                    @lang('roles.no_records')
                </div>
            @endif
        </div>
    </div>

</div>

