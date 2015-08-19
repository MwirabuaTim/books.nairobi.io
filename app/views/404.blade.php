@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Not Found
@stop


@section('css')
	<link rel="stylesheet" href="{{ asset('assets/styles/css/error.css')}} ">
@stop

@section('content')

	<div class="error_container">
        <h1>404</h1>
        <span class="sad">:(</span>
        <p>This page can not be found.</p>
        <p>Please check if you typed your link correctly.</p>
    </div>
	    
@stop