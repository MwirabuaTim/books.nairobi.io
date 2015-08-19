@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: How it Works
@stop

@section('css')
@stop

@section('content')
<div class="clearfix">
	<h3><span style="">How BookCheetah Works</span></h3>

	<h4>Using BookCheetah: REGISTER. SEARCH. POST. MEET.</h4>
	
	<ol><li>
			<b>REGISTER:&nbsp;</b><a href="{{ URL::to('register') }}">Sign up</a>&nbsp;for a free account. Just need a name, email, and school.</li>
		<li>
			<strong>SEARCH:</strong>&nbsp;Find the books you need for upcoming classes and add them to your wishlist.</li>
		<li>
			<strong>POST:</strong>&nbsp;Add your old books for sale on your bookshelf. You set the price.</li>
		<li>
			<strong>MEET:</strong>&nbsp;Set up a time and place to exchange cash for books.</li>
	</ol>

	<h4>Why Bookcheetah?</h4>

	<ul>
		<li>
			<strong>Student-to-student</strong>&nbsp;= no ridiculous bookstore prices and you set your selling price. Money stays with fellow students-- not some faceless bookstore owner.&nbsp;</li>
		<li>
			<strong>No shipping</strong>&nbsp;= quicker, cheaper, and greener.&nbsp;</li>
		<li>
			<strong>Free</strong>&nbsp;= Free accounts, free to use. Simple enough.</li>
		<li>
			<strong>Do good</strong>&nbsp;=&nbsp;If we help to save you money, donate to keep us free! &nbsp;Then decide how ten percent of all BookCheetah proceeds is spent: the <a href="http://www.cheetah.org/">Cheetah Conservation Fund</a>, <a href="http://www.teachforamerica.org/">Teach For America</a> or the student government of your school.</li>
	</ul>
</div>
@stop



