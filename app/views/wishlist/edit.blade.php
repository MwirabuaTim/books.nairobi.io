@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Wishlist
@stop

@section('content')

<h1>Edit Book in your Wishlist</h1>
{{ Form::model($wishlist, array('method' => 'PATCH', 'route' => array('wishlist.update', $wishlist->id))) }}
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

        <li>
            {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
            {{ link_to_route('wishlist.show', 'Cancel', $wishlist->id, array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop