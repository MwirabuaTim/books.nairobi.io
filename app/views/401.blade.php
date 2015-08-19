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
        <h1>401</h1>
        <span class="sad">:(</span>
        <p>You have to be logged in to access this page.</p>
        <p>Please <a href="{{ URL::to('login') }}">log in</a> or <a href="{{ URL::to('register') }}">register.</a></p>
    </div>

@stop