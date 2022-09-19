@extends('layouts.layout_tables')

@section('tables')

    <div class="table-responsive">
       <div><h1>Arrivals:</h1></div>

           <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Airport Name</th>
                <th scope="col">Arrival Time</th>
                <th scope="col">Zone</th>
                <th scope="col">Free sits</th>
                <th scope="col">Additional</th>
            </tr>
            </thead>
            <tbody>
           
            @if($arrivals)
                @foreach ($arrivals as $arr)
            <tr>
                <th scope="row">{{ $arr->ident}}</th>
                <td>{{ $arr->place}}</td>
                <td>{{ date("h:i", date(strtotime("Today") + ($arr->arr_time) + (substr($arr->timezone, 4) * 3600 )))}}</td>
                <td>{{ $arr->timezone}}</td>
                <td>{{ $arr->free_sits + rand(0,1) + rand(0,2) +  rand(0,4) }}</td>
                <td>{{ ' ' }}</td>
            </tr>
            @endforeach
            @endif
            </tbody>          
        </table>
        <br><BR><BR>
        <div><h1>Departures:</h1></div>
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Airport Name</th>
                <th scope="col">Departure Time</th>
                <th scope="col">Zone</th>
                <th scope="col">Free sits</th>
                <th scope="col">Additional</th>
            </tr>
            </thead>
            <tbody>
            @if($departures)    
                @foreach ($departures as $dep)
                    <tr>
                        <th scope="row">{{ $dep->ident}}</th>
                        <td>{{ $dep->place}}</td>
                        <td>{{ date("h:i", date(strtotime("Today") + ($dep->dep_time) + (substr($dep->timezone, 4) * 3600)))}}</td>
                        <td>{{ $dep->timezone}}</td>
                        <td>{{ $dep->free_sits + rand(0,1) + rand(0,2) +  rand(0,4) }}</td>
                        <td>{{ ' ' }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div><!-- ./table-responsive-->

    <script type="text/javascript">
        function autoRefreshPage()
        {
           location.reload();
        }
        setInterval('autoRefreshPage()', 15000);
    </script>
@endsection
