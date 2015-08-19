@extends('layouts.bookcheetah')

@section('content')

<h1>All Courselists</h1>

<p>{{ link_to_route('courselists.create', 'Add new courselist') }}</p>

@if ($courselists->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
				<th>Username</th>
				<th>Coursename</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($courselists as $courselist)
                <tr>
					<td>{{{ $courselist->username }}}</td>
					<td>{{{ $courselist->coursename }}}</td>
                    <td>{{ link_to_route('courselists.edit', 'Edit', array($courselist->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('courselists.destroy', $courselist->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    There are no courselists
@endif

@stop