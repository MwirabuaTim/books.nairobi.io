@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Contact Us
@stop



@section('content')

	
<!-- facebook like plugin -->
<div id="fb-root" class=" fb_reset"><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div><iframe name="fb_xdm_frame_http" frameborder="0" allowtransparency="true" scrolling="no" id="fb_xdm_frame_http" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tab-index="-1" src="http://static.ak.facebook.com/connect/xd_arbiter.php?version=25#channel=f4ef51ec4&amp;origin=http%3A%2F%2Fbookcheetah.com&amp;channel_path=%2Foff-menu-pages%2Fcontact-us%3Ffb_xd_fragment%23xd_sig%3Df3b77bda74%26" style="border: none;"></iframe><iframe name="fb_xdm_frame_https" frameborder="0" allowtransparency="true" scrolling="no" id="fb_xdm_frame_https" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tab-index="-1" src="https://s-static.ak.facebook.com/connect/xd_arbiter.php?version=25#channel=f4ef51ec4&amp;origin=http%3A%2F%2Fbookcheetah.com&amp;channel_path=%2Foff-menu-pages%2Fcontact-us%3Ffb_xd_fragment%23xd_sig%3Df3b77bda74%26" style="border: none;"></iframe></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<h2 class="gradient-title">Contact Us</h2>

<div class="facebook-find">
	<p><a href="http://www.facebook.com/bookcheetah"><img alt="Find us on Facebook" src="{{ asset('assets/images/facebook.jpg') }}"></a></p>
    <p>
        <iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/follow_button.1372833608.html#_=1374308432303&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=bookcheetah&amp;show_count=false&amp;show_screen_name=true&amp;size=l" class="twitter-follow-button twitter-follow-button" title="Twitter Follow Button" data-twttr-rendered="true" style="width: 180px; height: 28px;"></iframe>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    </p>
</div>


	<br/>
  <br/>
  <p>Thanks for contacting us here at Bookcheetah.<br>
	We are always looking for ways to improve, so we look forward to addressing your comment.</p>	


<form action="/gmail" class="contactUs" method="POST">
  <fieldset>
  	<legend><h3 class="gradient-light">Send us a message</h3></legend>

	  <div class="name">
	    	  <label for="name">Name</label>
	  <input type="text" name="name" class="large" value="">
	  </div>
	  
	  <div class="email">
	    	  <label for="email">Email</label>
	  <input type="text" name="email" class="large" value="">
	  </div>
	  
	  <div class="subject">
	    	    <label for="subject">Subject</label>
	    <input type="text" name="subject" class="large" value="">
	  </div>
	  
	  <div class="msg">  
	    	  <label for="msg">Message</label>
	  <textarea name="msg" cols="60" rows="10"></textarea>
	  </div>
    
    <div class="math">
            <label for="math">4 + 9 = </label>
      <input type="text" name="answer" class="small">
      <input type="hidden" name="secret" value="P3jkCd4iKaRR91pMihNbhkk2wcU+7ZnO7RSPTtyoolM=">
      <span class="helptext">Solve to prove you are a human</span>
    </div>

    <input class="btn btn-primary submitcontact" type="submit" value="Submit" style="font-size: 15px;">
  	<!-- <button type="submit" value="Send" class="submit ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Submit</span></button> -->
  </fieldset>
</form>

  
@stop

@section('css')
	<link href="{{ asset('assets/styles/css/contactus.css') }}" rel="stylesheet" />
@stop