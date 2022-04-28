@extends('layout.master')

@section('content')

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div>
                    <h1 class=""
                        My Trips
                    </h1>
                </div>
                <div id="mytrips" class="trips">
                   {!! $result !!}
                </div>
            </div>

        </div>


@endsection