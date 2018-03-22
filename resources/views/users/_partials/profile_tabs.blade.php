<div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
    <div class="btn-group" role="group">
        <button type="button" id="stars" class="btn btn-primary" href="#details" data-toggle="tab">
            <span class="fa fa-user" aria-hidden="true"></span>
            <div class="hidden-xs">@choice('general.detail', 2)</div>
        </button>
    </div>
    <div class="btn-group" role="group">
        <button type="button" id="following" class="btn btn-default" href="#social_media" data-toggle="tab">
            <span class="fa fa-facebook" aria-hidden="true"></span>
            <span class="fa fa-twitter" aria-hidden="true"></span>
            <span class="fa fa-google-plus-square" aria-hidden="true"></span>
            <span class="fa fa-linkedin-square" aria-hidden="true"></span>
            <span class="fa fa-skype" aria-hidden="true"></span>
            <span class="fa fa-youtube-square" aria-hidden="true"></span>
            <span class="fa fa-whatsapp" aria-hidden="true"></span>
            <span class="fa fa-github" aria-hidden="true"></span>
            <span class="fa fa-bitbucket" aria-hidden="true"></span>
            <span class="fa fa-gitlab" aria-hidden="true"></span>
            <div class="hidden-xs">@lang('general.social_media')</div>
        </button>
    </div>
    <div class="btn-group" role="group">
        <button type="button" id="favorites" class="btn btn-default" href="#other" data-toggle="tab">
            <span class="fa fa-picture-o" aria-hidden="true"></span>
            <div class="hidden-xs">@lang('general.gallery')</div>
        </button>
    </div>
</div>
<div class="well">
    <div class="tab-content">
        <div class="tab-pane fade in active overflow" id="details">
            <form id="editUserForm" role="form" data-toggle="validator" method="PUT" action="{{route('users.update', $user->id)}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" value="{{$user->id}}" name="edit_id" id="edit_id"/>
                @include('users._partials.forms.user-fields')
                <div class="col-md-12  text-center">
                    <div class="padding-top-5">
                        <button class="btn btn-success" type="submit">
                            <i class="{{config('buttons.icons.save')}}"></i>&nbsp;@lang('buttons.update')
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade in overflow" id="social_media">
            <form id="userSocialMediaForm" role="form" data-toggle="validator" method="PUT" action="{{route('users.update', $user->id)}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" value="{{$user->id}}" name="edit_id" id="edit_id"/>
                @include('users._partials.forms.social-media-fields')
                <div class="col-md-12  text-center">
                    <div class="padding-top-5">
                        <button class="btn btn-success" type="submit">
                            <i class="{{config('buttons.icons.save')}}"></i>&nbsp;@lang('buttons.update')
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade in overflow" id="other">
            <h3>This is user other</h3>
        </div>
    </div>
</div>