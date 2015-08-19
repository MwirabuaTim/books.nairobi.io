@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Courses
@stop


@section('content')

<h4>{{{ $course->name }}}</h4>

<p>{{ link_to_route('courses.index', 'Return to all courses') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
                <th class="tr_size">Professor</th>
                <th class="tr_size">Course No</th>
                <th class="tr_size">Course Name</th>
                <th class="tr_size">Description</th>
                <th class="tr_size">Books</th>
                <th class="tr_size">Semester</th>   
        </tr>
    </thead>

    <tbody>
        <tr>
            <td class="td_size">{{{ $course->professor }}}</td>
            <td class="td_size">{{{ $course->number }}}</td>
            <td class="td_size">{{{ $course->name }}}</td> 
            <td class="td_size">{{{ $course->description }}}</td>
            <td class="td_size">{{{ $course->books }}}</td>
            <td class="td_size">{{{ $course->semester }}}</td>

            @if(User::adminCheck())
                <td>{{ link_to_route('courses.edit', 'Edit', array($course->id), array('class' => 'btn btn-info')) }}</td>
                <td>
                    {{ Form::open(array('method' => 'DELETE', 'route' => array('courses.destroy', $course->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                </td>
            @endif

        </tr>
    </tbody>
</table>

@stop

