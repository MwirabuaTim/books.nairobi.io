@extends('layouts.bookcheetah')

@section('content')

<h1>{{ $title }}</h1>

<p>{{ $topmessage }}</p>

@if (isset($bookshelf['0']))
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Book Name</th>
                <th>Author</th>
                <th>Price</th>
                <th>Status</th>
                <th>Available</th>
                <th>Condition</th>
                <th>Location</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($bookshelf as $bookshelf)
                <tr>
                    <td><a href="{{ URL::to('bookshelf/'.$bookshelf->id) }}">{{{ $bookshelf->name }}}</a></td>
                    <td>{{{ $bookshelf->author }}}</td>
                    <td>{{{ $bookshelf->price }}}</td>
                    <td>{{{ $bookshelf->status }}}</td>
                    <td>{{{ $bookshelf->available }}}</td>
                    <td>{{{ $bookshelf->condition }}}</td>
<td>
<?php 
$colle = DB::table('colleges')->where('id', 'like', $bookshelf->collegeid)->get();
echo '<a href="'.URL::to('colleges/'.$colle['0']->id) .'">'.$colle['0']->name.'</a>'; 
?>
</td>
                    
                    <td>
                        {{ User::editButton($bookshelf->userid, 'bookshelf', $bookshelf->id) }}
                    </td>
                    
                    <td>
                        {{ User::deleteButton($bookshelf->userid, 'bookshelf', $bookshelf->id) }}
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    No books found
@endif

@stop