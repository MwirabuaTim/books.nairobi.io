@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Home
@stop


@section('css')

<link rel="stylesheet" href="{{ asset('assets/styles/css/colleges.css')}} ">

@stop


@section('content')

<h1>All Colleges</h1>

<p>{{ link_to_route('colleges.create', 'Add new college') }}</p>

@if ($colleges->count())

	{{ $colleges->links() }}
	<div id="doublescroll">
	    <table class="table table-striped table-bordered">
	        <thead>
	            <tr>
	                <th>Name</th>
					<th>Street</th>
					<th>City</th>
					<th>State</th>
					<th>Postal Code</th>
					<th>Student Count</th>
					@if(User::adminCheck())
						<th>Added By</th>
						<th>Approved By</th>
						<th>Approved At</th>
						<th>Latitude</th>
						<th>Longitude</th>
					@endif

	            </tr>
	        </thead>

	        <tbody>
	            @foreach ($colleges as $college)
	                <tr>
	                    <td>{{ link_to_route('colleges.show', $college->name, $college->id) }}</td>
						<td>{{{ $college->street }}}</td>
						<td>{{{ $college->city }}}</td>
						<td>{{{ $college->state }}}</td>
						<td>{{{ $college->postal_code }}}</td>
						<td>{{{ $college->student_count }}}</td>

						@if(User::adminCheck())
							<td>{{{ $college->added_by }}}</td>
							<td>{{{ $college->approved_by }}}</td>
							<td>{{{ $college-> approved_at }}}</td>
							<td>{{{ $college->latitude }}}</td>
							<td>{{{ $college->longitude }}}</td>
		                	<td>{{ link_to_route('colleges.edit', 'Edit', array($college->id), array('class' => 'btn btn-info')) }}</td>
		                    <td>
		                        {{ Form::open(array('method' => 'DELETE', 'route' => array('colleges.destroy', $college->id))) }}
		                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
		                        {{ Form::close() }}
		                    </td>
	                    @endif
	                </tr>
	            @endforeach
	        </tbody>
	    </table>
	</div>
	{{ $colleges->links() }}

@else
    There are no colleges
@endif

@stop