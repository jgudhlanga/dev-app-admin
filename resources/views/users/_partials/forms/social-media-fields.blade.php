<div class="col-md-6">
    <div class="form-group">
        <label for="facebook" class="col-md-3 control-label text-left">@lang('social-media.facebook')
            <i class="fa fa-facebook-square"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="facebook" id="facebook"
                   value="@isset($user){{$user->facebook}}@endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="google_plus" class="col-md-3 control-label text-left">@lang('social-media.google_plus')
            <i class="fa fa-google-plus-square"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="google_plus" id="google_plus"
                   value="@isset($user){{$user->google_plus}}@endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="skype" class="col-md-3 control-label text-left">@lang('social-media.skype')
            <i class="fa fa-skype"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="skype" id="skype"
                   value="@isset($user){{$user->skype}}@endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="whatsapp" class="col-md-3 control-label text-left">@lang('social-media.whatsapp')
            <i class="fa fa-whatsapp"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="whatsapp" id="whatsapp"
                   value="@isset($user){{$user->whatsapp}}@endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="youtube" class="col-md-3 control-label text-left">@lang('social-media.youtube')
            <i class="fa fa-youtube-square"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="youtube" id="youtube"
                   value="@isset($user){{$user->youtube}}@endisset">
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="twitter" class="col-md-3 control-label text-left">@lang('social-media.twitter')
            <i class="fa fa-twitter-square"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="twitter" id="twitter"
                   value="@isset($user){{$user->twitter}}@endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="linkedin" class="col-md-3 control-label text-left">@lang('social-media.linkedin')
            <i class="fa fa-linkedin-square"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="linkedin" id="linkedin"
                   value="@isset($user){{$user->linkedin}}@endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="github" class="col-md-3 control-label text-left">@lang('social-media.github')
            <i class="fa fa-github"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="github" id="github"
                   value="@isset($user){{$user->github}}@endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="github" class="col-md-3 control-label text-left">@lang('social-media.bitbucket')
            <i class="fa fa-bitbucket"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="bitbucket" id="bitbucket"
                   value="@isset($user){{$user->bitbucket}}@endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="gitlab" class="col-md-3 control-label text-left">@lang('social-media.gitlab')
            <span class="fa fa-gitlab"></span>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="gitlab" id="gitlab"
                   value="@isset($user){{$user->gitlab}}@endisset">
        </div>
    </div>
</div>