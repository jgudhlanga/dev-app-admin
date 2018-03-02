<div class="row">
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ url('cpanel/general/gender') }}">
            @lang('gender.gender')
            &nbsp;<span class="badge">{{$genderCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ url('cpanel/general/member-types') }}">
            @choice('members.types.title', 2)
            &nbsp;<span class="badge">{{$memberTypeCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ url('cpanel/general/marital-statuses') }}">
            @choice('marital-status.title', 2)
            &nbsp;<span class="badge">{{$maritalStatusCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ url('cpanel/general/occupations') }}">
            @choice('general.occupations.heading', 2)
            &nbsp;<span class="badge">{{$occupationCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ url('cpanel/general/races') }}">
            @choice('general.races.heading', 2)
            &nbsp;<span class="badge">{{$raceCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ url('cpanel/general/titles') }}">
            @choice('titles.title', 2)
            &nbsp;<span class="badge">{{$titleCount}}</span>
        </a>
    </div>
</div>
