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

<h2>{{{ $college->name }}}</h2>



<p>{{ link_to_route('colleges.index', 'Go to all colleges') }}</p>

	<div id="doublescroll">
		<table class="table table-striped table-bordered">
		    <thead>
		        <tr>
		            <th>Name</th>
					<th>Street</th>
					<th>City</th>
					<th>State</th>
					<th>Postal_code</th>
					<th>Student_count</th>
                    @if(User::adminCheck())
    					<th>Added_by</th>
    					<th>Approved_by</th>
    					<th>Approved_at</th>
                        <th>Latitude</th>
                        <th>Longitude</th> 
                    @endif
					
		        </tr>
		    </thead>

		    <tbody>
		        <tr>
		            <td>{{{ $college->name }}}</td>
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
		    </tbody>
		</table>
	</div>


<h4>Bookshelves</h4>
<?php if(isset($bookshelf['0'])): ?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>User Name</th>
				<th>Book Name</th>
				<th>Author</th>
				<th>Price</th>
				<th>Status</th>
				<th>Available</th>
				<th>Condition</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($bookshelf as $bookshelf)
                <?php
                $user = User::find($bookshelf->userid);
                ?>
                <tr>
                    <td>{{ $user->fullNameLink() }}</td>
            		<td><a href="{{ URL::to('bookshelf/'.$bookshelf->id) }}">{{{ $bookshelf->name }}}</a></td>
					<td>{{{ $bookshelf->author }}}</td>
					<td>{{{ $bookshelf->price }}}</td>
					<td>{{{ $bookshelf->status }}}</td>
					<td>{{{ $bookshelf->available }}}</td>
					<td>{{{ $bookshelf->condition }}}</td>

					@if(User::adminCheck())
                    <td>{{ link_to_route('bookshelf.edit', 'Edit', array($bookshelf->id), array('class' => 'btn btn-info')) }}</td>
                    
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('bookshelf.destroy', $bookshelf->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
<?php else: ?>
    No Books found
<?php endif; ?>

<h4>Wishlists</h4>
<?php if(isset($wishlist['0'])): ?>
	
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>User Name</th>
				<th>Book Name</th>
				<th>Author</th>
				<th>Price</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($wishlist as $wishlist)
            	<?php
            	$user = User::find($wishlist->userid);
            	?>
                <tr>
                    <td>{{ $user->fullNameLink() }}</td>
            		<td><a href="{{ URL::to('wishlist/'.$wishlist->id) }}">{{{ $wishlist->name }}}</a></td>
					<td>{{{ $wishlist->author }}}</td>
					<td>{{{ $wishlist->price }}}</td>

                    @if(User::adminCheck())
                    <td>{{ link_to_route('wishlist.edit', 'Edit', array($wishlist->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('wishlist.destroy', $wishlist->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
<?php else: ?>
    No Books found
<?php endif; ?>

@stop