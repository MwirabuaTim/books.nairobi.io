@extends('layouts.bookcheetah')

@section('content')

<h1>Add a Book to your Wishlist</h1>
{{ Form::open(array('route' => 'wishlist.store', 'method' => 'PATCH')) }}
    <ul>
        <li>
            {{ Form::label('userid', 'User ID:') }}
            {{ Form::input('number', 'userid') }}
        </li>

        <li>
            {{ Form::label('collegeid', 'College ID:') }}
            {{ Form::input('number', 'collegeid') }}
        </li>

        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('author', 'Author:') }}
            {{ Form::text('author') }}
        </li>

        <li>
            {{ Form::label('price', 'Price:') }}
            {{ Form::text('price') }}
        </li>

        <li>
            {{ Form::submit('Submit', array('class' => 'btn')) }}
            <a href="URL::previous()" class="btn">Cancel</a>
        </li>
    </ul>
{{ Form::close() }}