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
    @if (isset($wishlist['0']))
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
                        <a href="{{ URL::to('wishlist/'.$wishlist->id) }}"><img src="{{{ $wishlist->imgurl }}}" /></a>
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
                        <a href="{{ $wishlist->bookurl }}" class="btn btn-warning">On Amazon</a>
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
    @else
        There are no Wishlist Items
    @endif

</fieldset>
    
@stop