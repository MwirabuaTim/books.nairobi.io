@extends('layouts.bookcheetah')

@section('content')

<h1>Edit College</h1>
{{ Form::model($college, array('method' => 'PATCH', 'route' => array('colleges.update', $college->id))) }}
    <ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('street', 'Street:') }}
            {{ Form::text('street') }}
        </li>

        <li>
            {{ Form::label('city', 'City:') }}
            {{ Form::text('city') }}
        </li>

        <li>
            {{ Form::label('state', 'State:') }}
            {{ Form::text('state') }}
        </li>

        <li>
            {{ Form::label('postal_code', 'Postal_code:') }}
            {{ Form::text('postal_code') }}
        </li>

        <li>
            {{ Form::label('student_count', 'Student_count:') }}
            {{ Form::input('number', 'student_count') }}
        </li>

        <li>
            {{ Form::label('added_by', 'Added_by:') }}
            {{ Form::text('added_by') }}
        </li>

        <li>
            {{ Form::label('approved_by', 'Approved_by:') }}
            {{ Form::input('number', 'approved_by') }}
        </li>

        <li>
            {{ Form::label(' approved_at', ' Approved_at:') }}
            {{ Form::text(' approved_at') }}
        </li>

        <li>
            {{ Form::label('latitude', 'Latitude:') }}
            {{ Form::text('latitude') }}
        </li>

        <li>
            {{ Form::label('longitude', 'Longitude:') }}
            {{ Form::text('longitude') }}
        </li>

        <li>
            {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
            {{ link_to_route('colleges.show', 'Cancel', $college->id, array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop