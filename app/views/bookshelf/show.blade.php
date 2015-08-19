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

                    <tr>

                        <td class="largeimg">
                            <a href="{{ URL::to('bookshelf/'.$bookshelf->id) }}"><img src="{{{ $bookshelf->largeimg }}}" /></a>
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

            </tbody>
        </table>

</fieldset>

@stop