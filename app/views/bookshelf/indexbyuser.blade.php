@extends('layouts.bookcheetah')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/styles/css/mybooks.css')}} ">
@stop

@section('content')

<h2 class="gradient-title">{{ $title }}</h2>


<fieldset>
    <legend>
        <h3 class="gradient-yellow">{{ $topmessage }}</h3>
    </legend>

    <?php if(isset($bookshelf['0'])): ?>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
    				<th>Book</th>
    				<th>Price</th>
    				<th>Status</th>
    				<th>Available</th>
    				<th>Condition</th>
                    <th>Location</th>
                    <th>Potential Local Buyers</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($bookshelf as $bookshelf)
                    <tr>

    					<td rowspan="">
                            <a href="{{ URL::to('bookshelf/'.$bookshelf->id) }}"><img src="{{{ $bookshelf->imgurl }}}" /></a>
                        </td>
                        
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

                        <td>0</td>

                    </tr>
                    <tr>
                        <td colspan="4">
                            <a href="{{ URL::to('bookshelf/'.$bookshelf->id) }}">{{{ $bookshelf->name }}}</a>
                        </td>
                        <td>
                            <a href="{{ $bookshelf->bookurl }}" class="btn btn-warning">On Amazon</a>
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
    <?php else: ?>
        No Books found. <?php echo link_to_route('bookshelf.create', 'Add a Book to your Bookshelf'); ?>

    <?php endif; ?>

</fieldset>

@stop