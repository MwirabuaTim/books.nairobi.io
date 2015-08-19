@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Courses
@stop


@section('content')

<h1>Edit Course</h1>
{{ Form::model($course, array('method' => 'PATCH', 'route' => array('courses.update', $course->id))) }}
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
            {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
            {{ link_to_route('courses.show', 'Cancel', $course->id, array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop

