@extends('layouts.bookcheetah')

@section('content')

<h1>Add a Book to your Bookshelf</h1>
<p>{{ $topmessage }}</p>
{{ Form::open(array('route' => 'bookshelf.store')) }}
    <ul>
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
        <li class="radio status">
            {{ Form::label('status', 'Status:') }}
            <ul>
                <li>
                    {{ Form::radio('status', 'Available', true, array('id' => 'status-available')) }}
                    {{ Form::label('status-available', 'Available') }}
                </li>
                <li>
                    {{ Form::radio('status', 'Sold', false, array('id' => 'status-sold')) }}
                    {{ Form::label('status-sold', 'Sold') }}
                </li>
                <li>
                    {{ Form::radio('status', 'Unavailable', false, array('id' => 'status-unavailable')) }}
                    {{ Form::label('status-unavailable', 'Unavailable') }}
                </li>
            </ul>
        </li>
        <li>
            {{ Form::label('dateavailable', 'Date Available') }}
            {{ Form::text('available', null, array('id' => 'date-available')) }}
        </li>
        <li class="radio condition">
            {{ Form::label('condition', 'Condition') }}
            <ul>
                <li>
                    {{ Form::radio('condition', 'Like New - Shiny cover, crisp corners, no back creases', true, array('id' => 'condition-like-new')) }}
                    {{ Form::label('condition-like-new', 'Like New - Shiny cover, crisp corners, no back creases') }}
                </li>
                <li>
                    {{ Form::radio('condition', 'Light Use - a few dog-eared corners, no marks or tears', false, array('id' => 'condition-light-use')) }}
                    {{ Form::label('condition-light-use', 'Light Use - a few dog-eared corners, no marks or tears') }}
                </li>
                <li>
                    {{ Form::radio('condition', 'Normal Use - dog-eared, some highlights and notes in the margins', false, array('id' => 'condition-normal-use')) }}
                    {{ Form::label('condition-normal-use', 'Normal Use - dog-eared, some highlights and notes in the margins') }}
                </li>
                <li>
                    {{ Form::radio('condition', 'Heavy Use - has that vintage, lived-in look', false, array('id' => 'condition-heavy-use')) }}
                    {{ Form::label('condition-heavy-use', 'Heavy Use - has that vintage, lived-in look') }}
                </li>
                <li>
                    {{ Form::radio('condition', 'Rough - it\'s all there \& usable, but that\'s about it', false, array('id' => 'condition-rough')) }}
                    {{ Form::label('condition-rough', 'Rough - it\'s all there \& usable, but that\'s about it') }}
                </li>
            </ul>
        </li>
        <li>
            {{ Form::submit('Save', array('class' => 'btn btn-info')) }}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop


