@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Home
@stop


@section('css')

<link rel="stylesheet" href="{{ asset('assets/styles/css/mybooks.css')}} ">

@stop


@section('content')


<h2 class="gradient-title">Books by {{{ $user->firstName() }}}</h2>

<fieldset>
<legend>
    <a href="{{ URL::to('bookshelf/user/'.$user->id) }}"> <h3 class="gradient-yellow">Bookshelf</h3></a>
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
                        <img src="{{{ $bookshelf->imgurl }}}" />
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
                        <a href="{{ URL::to('bookshelf/'.$bookshelf->id) }}" class="btn btn-info">On Amazon</a>
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

<fieldset>
<legend>
    <a href="{{ URL::to('wishlist/user/'.$user->id) }}"><h3 class="gradient-yellow">Wishlist</h3></a>
</legend>

<?php if(isset($wishlist['0'])): ?>
	
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
				<th>Book</th>
				<th>Author</th>
                <th class="binding">Binding</th>
				<th>Price</th>
                <th>Potential Local Sellers</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($wishlist as $wishlist)
                <tr>
					<td>
                        <img src="{{{ $wishlist->imgurl }}}" />
                    </td>
                    <td>{{{ $wishlist->author }}}</td>
                    <td>{{{ $wishlist->binding }}}</td>
					<td>{{{ $wishlist->price }}}</td>
                    <td>0</td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                     <a href="{{ URL::to('wishlist/'.$wishlist->id) }}">{{{ $wishlist->name }}}</a>
                    </td>
                    <td>
                        <a href="{{ URL::to('wishlist/'.$wishlist->id) }}" class="btn btn-info">On Amazon</a>
                    </td>
                    <td>
                        {{ User::editButton($wishlist->userid, 'wishlist', $wishlist->id) }}
                    </td>
                    <td>
                        {{ User::deleteButton($wishlist->userid, 'wishlist', $wishlist->id) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
<?php else: ?>
    No Books found. <?php echo link_to_route('wishlist.create', 'Add a Book to your Wishlist'); ?>
<?php endif; ?>
</fieldset>


@stop
