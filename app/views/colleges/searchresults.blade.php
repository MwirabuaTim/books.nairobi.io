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

	<h4>Search results for "{{ $term }}"</h4>

	<p>{{ link_to_route('colleges.create', 'Add a new College') }}</p>

	@if (isset($query['0']->id))

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
		            @foreach ($query as $q)
		                <tr>
		                    <td>{{ link_to_route('colleges.show', $q->name, $q->id) }}</td>
							<td>{{{ $q->street }}}</td>
							<td>{{{ $q->city }}}</td>
							<td>{{{ $q->state }}}</td>
							<td>{{{ $q->postal_code }}}</td>
							<td>{{{ $q->student_count }}}</td>
							@if(User::adminCheck())
								<td>{{{ $q->added_by }}}</td>
								<td>{{{ $q->approved_by }}}</td>
								<td>{{{ $q-> approved_at }}}</td>
								<td>{{{ $q->latitude }}}</td>
								<td>{{{ $q->longitude }}}</td>

				<td>{{ link_to_route('colleges.edit', 'Edit', array($q->id), array('class' => 'btn btn-info')) }}</td>
				<td>
					{{ Form::open(array('method' => 'DELETE', 'route' => array('colleges.destroy', $q->id))) }}
					{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
					{{ Form::close() }}
				</td> 
							@endif
		                    
		                </tr>
		            @endforeach
		        </tbody>
		    </table>
		</div>

	@else
	     No colleges match that query. Please try again.
	@endif

@stop
