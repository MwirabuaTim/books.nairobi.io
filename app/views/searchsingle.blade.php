@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Searching
@stop


@section('content')
<!-- replace the content below to suit your page content -->


@if(isset($data[0]["ItemAttributes"]["Title"]))

    <ul id="searchresults">
        @foreach($data as $item)
        <li>
            {{ var_dump($item) }}
        </li>
        @endforeach
    </ul>
@else

 {{ printf($data) }}

@endif




@stop

@section('css')

 <link rel="stylesheet" href="{{ asset('assets/styles/css/home-searchsingle.css')}} ">
 
@stop


