@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Courses
@stop


@section('content')

<h1>Create Course</h1>

{{ Form::open(array('route' => 'courses.store')) }}
    <ul>
        <li>
            {{ Form::label('professor', 'Professor:') }}
            {{ Form::text('professor') }}
        </li>

        <li>
            {{ Form::label('number', 'Course Number:') }}
            {{ Form::text('number') }}
        </li>

        <li>
            {{ Form::label('name', 'Course Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('description', 'Description:') }}
            {{ Form::textarea('description') }}
        </li>

        <li>
            {{ Form::label('semester', 'Semester:') }}
            {{ Form::select('semester', array(
                    'Spring' => 'Spring',
                    'Fall' => 'Fall'
                ), 'Spring', array('class'=>'btn btn-primary btn-small', 'id'=>'semester')) }}
        </li></br/></br/>

        <li>
            {{ Form::label('books', 'Book List: (Separate by new lines)') }}
            {{ Form::textarea('books') }}
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


