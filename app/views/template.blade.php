@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Template
@stop

@section('css')

 <!-- <link rel="stylesheet" href="{{ asset('assets/styles/css/template.css')}} "> -->

@stop

@section('content')
<!-- replace the content below to suit your page content -->
<h4>Coming Soon... Check out Later.</h4>




<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type='text/javascript' src="http://evbdn.eventbrite.com/s3-s3/static/js/platform/Eventbrite.jquery.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
  Eventbrite({'app_key': "P47XBRPQTVS7YF64Z5"}, function(eb){
    eb.organizer_list_events( {'id': 561037966, 'statuses': "live,started"}, function( response ){
     $('.content').append(eb.utils.eventList( response, eb.utils.eventListRow ));
    });
  });
});
</script>


<a href="http://www.eventbrite.com/event/4653432542?ref=ebtn" target="_blank">
  <img border="0" src="http://www.eventbrite.com/custombutton?eid=4653432542" alt="Register for Eventbrite API - Office Hours on Eventbrite" />
</a>

<div style="width:100%; text-align:left;" >
  <iframe src="http://www.eventbrite.com/tickets-external?eid=4653432542&ref=etckt&v=2" frameborder="0" height="256" width="100%" vspace="0" hspace="0" marginheight="5" marginwidth="5" scrolling="auto" allowtransparency="true"></iframe>
</div>

@stop



