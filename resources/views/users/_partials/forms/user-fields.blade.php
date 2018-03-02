<div class="row col-md-6">
    <div class="form-group">
        <label for="title_id" class="col-md-3 control-label text-left">@lang('general.people.title')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <select name="title_id" id="title_id" class="form-control input-sm" required>
                <option value="0">@lang('forms.choose')</option>
                @if(count($titles) > 0)
                    @foreach($titles as $title)
                        <option value="{{$title->id}}">{{$title->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="first_name" class="col-md-3 control-label text-left">@lang('general.people.first_name')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="first_name" id="first_name" required>
        </div>
    </div>
    <div class="form-group">
        <label for="last_name" class="col-md-3 control-label text-left">@lang('general.people.last_name')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="last_name" id="last_name" required>
        </div>
    </div>
    <div class="form-group">
        <label for="user_name" class="col-md-3 control-label text-left">@lang('general.people.user_name')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="user_name" id="user_name">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-md-3 control-label text-left">@lang('general.email')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="email" id="email">
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="title_id" class="col-md-3 control-label text-left">@lang('general.people.gender')</label>
        <div class="col-md-9">
            @if(count($genders) > 0)
                @foreach($genders as $gender)
                    <div class="radio radio-success radio-inline">
                        <input type="radio" id="gender_{{$gender->id}}" value="{{$gender->id}}" name="gender_id">
                        <label for="gender_{{$gender->id}}">{{$gender->name}}</label>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="alias" class="col-md-3 control-label text-left">@lang('general.people.alias')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="alias" id="alias">
        </div>
    </div>
    <div class="form-group">
        <label for="middle_name" class="col-md-3 control-label text-left">@lang('general.people.middle_name')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="middle_name" id="middle_name">
        </div>
    </div>
    <div class="form-group">
        <label for="display_name" class="col-md-3 control-label text-left">@lang('general.people.display_name')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="display_name" id="display_name">
        </div>
    </div>
    <div class="form-group">
        <label for="cell_number" class="col-md-3 control-label text-left">@lang('general.people.cell_number')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="cell_number" id="cell_number">
        </div>
    </div>
</div>