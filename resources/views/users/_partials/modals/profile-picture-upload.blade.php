<div class="modal fade" id="profilePictureModal" tabindex="-1" role="dialog" aria-labelledby="profilePictureModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form  role="form"  method="POST" enctype="multipart/form-data" data-toggle="validator"
               action='{{route("users.upload-profile-picture", $user->id)}}'>
            {{method_field('PUT')}}
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
                        {{trans('general.people.upload')}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="modal-close-btn">&times;</span>
                        </button>
                    </h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="profile_picture" class="col-md-3 control-label text-left">@lang('general.select')
                                <i class="fa fa-"></i>
                            </label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="profile_picture" id="profile_picture">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>&nbsp;{{trans('buttons.close')}}
                    </button>
                    <button type="submit" class="btn btn-success"  id="btnUpload">
                        <i class="fa fa-save"></i>&nbsp;{{trans('buttons.upload')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>