@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Home
@stop

@section('content')
<!-- replace the content below to suit your page content -->

<div id="slidebox">
  <ul id="bxslider">
    <li><img src="assets/bxslider/images/pic (1).jpg" title="" /></li>
    <li><img src="assets/bxslider/images/pic (2).jpg" title="" /></li>
    <li><img src="assets/bxslider/images/pic (3).jpg" title="" /></li>
    <li><img src="assets/bxslider/images/pic (4).jpg" title="" /></li>
  </ul>
</div>
<ul id="linkpad">
  <a href="/books"><li><!-- <span>Student to Student</span><p>Buy and sell at your own price</p> --></li></a>
  <a href="/colleges"><li><!-- <span>Fast, Local, Carbon-neutral</span><p>Find Buyers on your Campus</p> --></li></a>
  <a href="/account"><li><!-- <span>Save on Course Books</span><p>Buy course books at low prices</p> --></li></a>
  <a href="/howitworks"><li><!-- <span>Hassle-Free Delivery</span><p>We buy and deliver at no extra Cost</p> --></li></a>
  <a href="/howitworks"><li><!-- <span>Guaranteed Savings</span><p>We find the lowest prices for you</p> --></li></a>
</ul>
<div id="bx-pager">
  <a data-slide-index="0" href="#"><span id="s1">Buy And Sell Locally</span></a>
  <a data-slide-index="1" href="#"><span id="s2">Sell on Amazon</span></a>
  <a data-slide-index="2" href="#"><span id="s3">BookCheetah Delivery</span></a>
  <a data-slide-index="3" href="#"><span id="s4">Get Started</span></a>
</div>

<div id="bottom">
  <div class="bottom-left">
      <span class="title-text">Browse Popular Categories</span>
      <img class="bgshelf" src="{{ asset('assets/images/shelf3.jpg') }}"/>
    
        <a href="{{ URL::to('courses/14') }}" style="left:6%;">
          <img src="{{ asset('assets/images/1.png') }}"/>
          <span class="image-text" >Mathematics >></span>
        </a>
      
        <a href="{{ URL::to('courses/9') }}" style="left: 37%;">
          <img src="{{ asset('assets/images/2.png') }}"/>
          <span class="image-text">Biology >></span>
        </a>
      
        <a href="{{ URL::to('courses/13') }}" style="left: 68%;">
          <img src="{{ asset('assets/images/3.png') }}"/>
          <span class="image-text">Chemistry >></span>
        </a>
    

   <!--  
      <a href="{{ URL::to('courses/15') }}">
        <img src="{{ asset('assets/images/4.png') }}"/>
        <span class="image-text">Economics >></span>
      </a>
    
      <a href="{{ URL::to('courses/16') }}">
        <img src="{{ asset('assets/images/5.png') }}"/>
        <span class="image-text">Psychology >></span>
      </a>
    
      <a href="{{ URL::to('courses/12') }}">
        <img src="{{ asset('assets/images/6.png') }}"/>
        <span class="image-text">Sociology >></span>
      </a> -->

  </div>

  <!-- <div class="bottom-right"> -->
    <div id="video">
    <iframe width="100%" height="100%" 
      src="http://www.youtube.com/embed/_ugjlxl85w4?feature=player_detailpage"
      frameborder="0" allowfullscreen>
     </iframe>
     
    </div>
    <img style="width: 50%;" class="bgshelfbg" src="{{ asset('assets/images/shelf4.jpg') }}"/>
  <!-- </div> -->
  

</div>
    
<div class="fb-like" data-href="http://bookcheetah.com" data-width="450" data-colorscheme="dark" data-show-faces="false" data-send="false"></div>


@stop

@section('css')
    <link type="text/css" charset="utf-8" rel="stylesheet" media="screen" href="{{ asset('assets/styles/css/home.css')}}" />
@stop

@section('js')
    <!-- bxSlider Javascript file -->
    <script src="assets/bxslider/jquery.bxslider.js"></script>
    <!-- bxSlider CSS file -->
    <link href="assets/bxslider/jquery.bxslider.css" rel="stylesheet" />


    <script type="text/javascript" charset="utf-8">

        // $(window).load(function(){
          function bxslide(){
              $('#bxslider').bxSlider({
                auto: true,
                autoControls: false,
                nextSelector: '#slider-next',
                prevSelector: '#slider-prev',
                mode: 'fade',
                adaptiveHeight: true,
                infiniteLoop: true,
                pause:7000,
                speed: 3000,
                onSliderLoad: function(){
                   $('.bxslider .bx-prev').css('margin-left', '-3px');
                 },
                onSlideAfter: function(){
                  $('#bx-pager a').children().css('color', '#74662A');
                  $('#bx-pager a.active').children().css('color', '#FFD100');
                },
                pagerCustom: '#bx-pager'
              });
          };
            // $('#bxslider2').bxSlider({
            //   auto: true,
            //   autoControls: false,
            //   adaptiveHeight: true,
            //   infiniteLoop: true,
            //   speed: 500,
            //   onSliderLoad: function(){
            //      $('.bxslider2 .bx-viewport').css('position', 'absolute');
            //      $('.bxslider2 .bx-next').css({'left':'15%', 'top':'60px', 'z-index':'1'});
            //      $('.bxslider2 .bx-prev').css({'top':'60px', 'z-index':'1'});
            //    },
            //   onSlideAfter: function(){
            //     $('#bx-pager2 li a.btitle').css('color', '#74662A');
            //     $('#bx-pager2 li').css('color', '#74662A');
            //     $('#bx-pager2 li a.active').css('color', '#FFD100');
            //     $('#bx-pager2 li a.active').parent().css('color', '#FFD100');
            //     $('#bx-pager2 li span').css('display', 'none');
            //     $('#bx-pager2 a.active').parent('li').children('span').css('display', 'list-item');
            //   },
            //   pagerCustom: '#bx-pager2'
            // });


          //   $('#dialog-form').dialog({
          //       title: "Add Book to your Bookshelf",
          //       autoOpen: false,
          //       width: 600,
          //       height: 600,
		        //     appendTo: ".content",
          //       modal: true,
          //       buttons: {
          //         'Save': function() { $('#emailPost2').submit(); },
          //         'Close': function() { $(this).dialog("close"); }      
          //       }
          //     });
          //   $('#dialog-form').css({'z-index': '2000'});

          //   $('.ui-dialog').css({
          //     'position': 'fixed',
          //     'top': '10px',
          //     'border-right': '10px',
          //     'width': '600px',
          //     'height': '80%',
          //     'top': '10px',
          //     'left': '0px',
          //     'right': '0px',
          //     'margin': 'auto',
          //   });
          //   //$('.ui-dialog-titlebar-close').click(function(e) { e.preventDefault(); $(this).dialog("close"); });

          //   $("a.bookshelf").click(function (e) {
          //     e.preventDefault();
          //     $( '#dialog-form' ).dialog( 'open' );
          //     $bdata = $('#bx-pager2 li a.active').parent();
          //     $book = {
          //             'imgurl' : "http://localhost:8000/assets/bxslider/images/img-"+$bdata.children('a.active').attr('data-slide-index')+".jpg",
          //             'title' : $bdata.children('a.active').text(),
          //             'author' :  $bdata.children('span.author').text()
          //             // 'publishdate' : '12:12:12',
          //             // 'edition' : 'Latest n Greatest',
          //             // 'isbn' : '1234567890asd',
          //             // 'newprice' : '$2345',
          //             // 'usedprice' : '$1234',
          //             // 'amazonlink' : URL::to('users')
          //             };
          //     $('#imgurl').attr('src', $book['imgurl']);
          //     $('#title').text($book['title']);
          //     $('#author').text($book['author']);
          //   });

          //   $("button.ui-button-text-only .ui-button-text").attr('class', 'btn btn-primary');
          //   //bootstrap blue button

        // });

    </script>

@stop

