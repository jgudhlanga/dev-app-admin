<div class="row">
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ url('cpanel/general/address-types') }}">
            @choice('address-types.title', 2)
            &nbsp;<span class="badge">{{$addressTypeCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ url('cpanel/general/countries') }}">
            @choice('countries.title', 2)
            &nbsp;<span class="badge">{{$countryCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ url('cpanel/general/icons') }}">
            {{trans('cpanel.menu_icons')}}
            &nbsp;<span class="badge">{{$iconCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ url('cpanel/general/status') }}">
            {{trans('cpanel.status')}}
            &nbsp;<span class="badge">{{$statusCount}}</span>
        </a>
    </div>
</div>
