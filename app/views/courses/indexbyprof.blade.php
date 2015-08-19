@extends('layouts.bookcheetah')

@section('content')

<h1>{{ $title }}</h1>

<p>{{ $topmessage }}</p>

@if (isset($courses['0']))
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Book Name</th>
				<th>Author</th>
				<th>Price</th>
                <th>College</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($courses as $courses)
                <tr>
					<td><a href="{{ URL::to('courses/'.$courses->id) }}">{{{ $courses->name }}}</a></td>
					<td>{{{ $courses->number }}}</td>
					<td>{{{ $courses->name }}}</td>

                    @if(Auth::user()->id == $courses->userid)
                        <td>{{ link_to_route('courses.edit', 'Edit', array($courses->id), array('class' => 'btn btn-info')) }}</td>
                        <td>
                            {{ Form::open(array('method' => 'DELETE', 'route' => array('courses.destroy', $courses->id))) }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>
                    
                        <td>
                        <?php 
                        $colle = DB::table('colleges')->where('id', 'like', $courses->collegeid)->get();
                        echo '<a href="'.URL::to('colleges/'.$colle['0']->id) .'">'.$colle['0']->name.'</a>'; 
                        ?>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    There are no courses Items
@endif

@stop