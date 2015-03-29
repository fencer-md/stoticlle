@if ( Auth::user()->role == "1" )
    @include('layouts.backend.topnavigationbar-admin')
@endif
@if ( Auth::user()->role == "2" )
    @include('layouts.backend.topnavigationbar-user')
@endif
