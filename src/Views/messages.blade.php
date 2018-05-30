<div class="container">
    {{-- Display any flash messages to the user --}}
    @if(Session::has('message'))
        <div class="alert {{ Session::get("messageClass", "alert-info") }} alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>{{ Session::get('message') }}</p>

            {{-- Used to add a link to the message if needed --}}
            @if(Session::has('route'))
                <a href="{{ Session::get('route') }}">{{ Session::get("routeText") }}</a>
            @endif
        </div>
    @endif

    {{-- Display error messages --}}
    {{-- Skip if $hideSessionErrors has been set --}}
    @if(!isset($hideSessionErrors))
        <ul>
            @foreach ($errors->all() as $message)
                <li class="text-danger">{{$message}}</li>
            @endforeach
        </ul>
    @endif
</div>