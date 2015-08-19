@extends('layouts.bookcheetah')

@section('content')

<h1>Add a Book to your Wishlist</h1>

{{ Form::open(array('route' => 'wishlist.store')) }}
    <ul style="list-style: none; list-style-type: none;">
        <li>
            {{ Form::input('number', 'userid') }}
        </li>

        <li>
            {{ Form::input('number', 'collegeid') }}
        </li>

        <li>
            {{ Form::text('query') }}
        </li>
        
        <li>
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::text('author') }}
        </li>

        <li>
            {{ Form::text('price') }}
        </li>

        <li>
            {{ Form::submit('Submit', array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop


