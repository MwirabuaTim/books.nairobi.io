<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        @section('title')
        BookCheetah
        @show
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/styles/css/main.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/styles/css/bookcheetah.css')}} ">
    <!-- page-specific css-->
    @yield('css')

    <!-- JS -->
    <script src="{{ asset('assets/scripts/js/vendor/modernizr-2.6.2.min.js') }}"></script>

    <div id="fb-root"></div>
    <script type="text/javascript">
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=320691077999812";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Images -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/images/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/images/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/images/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/apple-touch-icon-57-precomposed.png') }}">

    <!-- ICO -->
    <link rel="shortcut icon" href="favicon.ico">

    <!--  -->

    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "452a12de-ea14-4da4-aeca-ef5d5287927c", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

    <script>(function(){
        var uv=document.createElement('script');
        uv.type='text/javascript';
        uv.async=true;
        uv.src='//widget.uservoice.com/DaBJd20KGXiNvgpEJT8A.js';
        var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()
    </script>

</head>
<body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
    <div class="wrapper">
      <img class="preload" alt="Loading..."  src="{{ asset('assets/images/loadingbar.gif') }}">
      <!-- <img class="saveloader" alt="Loading..."  src="{{ asset('assets/images/loading-bar.gif') }}"> -->

        <div class="middles header">
            <a href="{{ URL::to('/') }}"><img class="logo" src="{{ asset('assets/images/logo.png') }}"/></a>
            
            <a href="{{ URL::to('donate') }}">
            <div class="charity">
                <span class="charity1">Keep BookCheetah Free!</span><br/>
                <span class="charity2">Click here to donate</span>
            </div>
            </a>

            <ul class="linkbar top1">
                <a href="{{ URL::to('howitworks') }}"><li>How it Works</li></a> |
                <!-- <a href="{{ URL::to('forums') }}"><li>Forum</li></a> |  -->
                <!-- <a href="{{ URL::to('blog') }}"><li>Blog</li></a> |  -->
                <a href="{{ URL::to('contactus') }}"><li>Contact Us</li></a> | 
                
                <!-- A link to launch the Classic Widget -->
                <a href="javascript:void(0)" data-uv-lightbox="classic_widget">
                  <li>Customer Service</li></a>
            </ul>

<!-- <a href="javascript:void(0)" data-uv-lightbox="classic_widget" data-uv-mode="full" data-uv-primary-color="#cc6d00" data-uv-link-color="#007dbf" data-uv-default-mode="support" data-uv-forum-id="215869">
    Feedback &amp; Support
</a> -->
            <ul class="linkbar top2">
                @if (Auth::check())
                    <?php $id = Auth::user()->id; ?>
                    <li {{ (Request::is('user/'.$id .'/books') ? 'class="active"' : '') }}><a href="{{ URL::to('books/user/'.$id) }}">My Books</a></li>| 
                    <li {{ (Request::is('user') ? 'class="active"' : '') }}><a href="{{ URL::to('user/'.$id ) }}">{{ Auth::user()->firstname }}</a></li> | 
                    <li><a href="{{ URL::to('user/logout') }}">Log Out</a></li>
                @else
                    <li {{ (Request::is('user/login') ? 'class="active"' : '') }}><a href="{{ URL::to('user/login') }}">My Books</a></li>
                    <li {{ (Request::is('user/login') ? 'class="active"' : '') }}><a href="{{ URL::to('user/login') }}">Login</a></li>
                    <li {{ (Request::is('user/register') ? 'class="active"' : '') }}><a href="{{ URL::to('user/register') }}">Register</a></li>
                @endif
            </ul>

            @if (Auth::check())
              <p class="top2">{{ Auth::user()->myCollegeLink() }}</p>
            @else
              <!-- <p class="top2">Browse colleges below...</p> -->
            @endif

            <span class="searchline">
                
                <?php 
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

                    //if (false !== strpos($url,'books/search')) {
                        if(isset($_GET['q'])){
                        $q=$_GET['q'];
                        $c=$_GET['category'];
                        $s=$_GET['sort'];
                        }
                        else{
                            $q = 'Search for a book title, Subject, Author or ISBN...';
                            $c = 283155;
                            $s = 'relevancerank';
                        };
                    //};
                    
                    if(isset($_GET['term'])){
                        $l=$_GET['term'];
                    }
                    else{
                        $l = 'Pick a college...';
                    };
                ?>
                {{ Form::open(array('action' => 'BooksController@searchAmazon', 'method' => 'GET', 'class' => 'search1')) }}
                    {{ Form::text('q', $q, array(
                    'class' => 'searchinput searchbooks',
                    'placeholder' => 'Type a book title, Subject, Author or ISBN...',
                    'onclick' => 'if (this.value==\'Search for a book title, Subject, Author or ISBN...\') this.value=\'\'',
                    'onblur' => 'if (this.value==\'\') this.value=\'Search for a book title, Subject, Author or ISBN...\''
                    )) }}
                    <span class="buttonbabies">
                        {{ Form::select('category', array(
                            '283155' => 'All Books',
                            '465600' => 'All Textbooks',
                            '468220' => 'Business & Finance Textbooks',
                            '468226' => 'Communication & Journalism Textbooks',
                            '468204' => 'Computer Science Textbooks',
                            '468224' => 'Education Textbooks',
                            '468212' => 'Engineering Textbooks',
                            '468206' => 'Humanities Textbooks',
                            '468222' => 'Law Textbooks',
                            '468228' => 'Medicine & Health Sciences Textbooks',
                            '684283011' => 'Reference Textbooks',
                            '468216' => 'Science &amp; Mathematics Textbooks',
                            '468214' => 'Social Sciences Textbooks'

                        ), $c, array('class'=>'btn btn-primary', 'id'=>'category')) }}

                        {{ Form::select('sort', array(
                            'relevancerank' => 'Relevance',
                            'titlerank' => 'Alphabetical: A to Z',
                            '-titlerank' => 'Alphabetical: Z to A',
                            'salesrank' => 'Bestselling',
                            'reviewrank' => 'Average customer review',
                            'pricerank' => 'Price: low to high',
                            'inverse-pricerank' => 'Price: high to low',
                            'daterank' => 'Publication date: newer to older'
                       
                        ), $s, array('class'=>'btn btn-primary', 'id'=>'sort')) }}
                       
                        {{ Form::submit('Search', array('class'=>'btn btn-primary submitbook')) }}
                    </span>
                {{ Form::close() }}

                {{ Form::open(array('action' => 'CollegesController@search', 'method' => 'GET', 'class' => 'search2')) }}
                    {{ Form::text('term', $l, array(
                    'class' => 'searchinput searchcolleges', 
                    'placeholder' => 'Type a College name...',
                    'onclick' => 'if (this.value==\'Pick a college...\') this.value=\'\'',
                    'onblur' => 'if (this.value==\'\') this.value=\'Pick a college...\''
                    )) }}
                    <input type="submit" style="display:none"/>
                    <img class="submitcollege" src="{{ asset('assets/images/lens.png') }}" />
                {{ Form::close() }}

            </span>

        </div>

        <!-- Add your site or application content here -->
        <!-- Container -->
        <div class="middles container">

            <!-- Notifications -->
            @include('partials.notifications')
            <!-- ./ notifications -->

            <!-- Content -->
            <div class="content">
                @yield('content')
                <!-- ./ content -->
            </div>
            <div class="fb-like" id="fblike" data-href="http://bookcheetah.com" data-send="false" 
            data-width="450" data-show-faces="false"></div>

        </div>
        <!-- ./ container -->

        <div class="footer">
            <div class="middles footerstuff">
                <div class="bottom_left">

                    <ul class="footer_links_space">
                        <a href="{{ URL::to('howitworks') }}"><li class="link">How it Works</li></a> | 
                        <a href="{{ URL::to('termsofuse') }}"><li class="link">Terms of Use</li></a> | 
                        <a href="{{ URL::to('privacypolicy') }}"><li class="link">Privacy Policy</li></a> | 
                        <a href="{{ URL::to('contactus') }}"><li class="link">Contact Us</li></a>
                    </ul>
                    <br/>
                    <span class="devs_space">Designed by <a class="dev" href="http://nairobi.io">Nairobi.IO</a></span>
                    
                </div>
                        
                <div class="bottom_right">
                    <span class="social_text">Get in Touch...</span><br />

                    <ul class="social_buttons">
                        <!--  
                        <span class='st_facebook_large' displayText='Facebook'></span>
                        <span class='st_twitter_large' displayText='Tweet'></span>
                        <span class='st_googleplus_large' displayText='Tweet'></span>
                        <span class='st_sharethis_large' displayText='ShareThis'></span>
                        <span class='st_linkedin_large' displayText='LinkedIn'></span>
                        <span class='st_pinterest_large' displayText='Pinterest'></span>
                        <span class='st_email_large' displayText='Email'></span>
                        -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
  </body>


      <!-- jQuery -->
      <script src="{{ asset('assets/scripts/js/jquery.min.js') }}"></script>
      <script src="{{ asset('assets/scripts/jquery-ui-1.10.3.custom.min.js') }}"></script>
      <link href="{{ asset('assets/styles/css/jquery-ui-1.10.3.custom.min.css')}}" rel="stylesheet"/>
      
      <script src="{{ asset('assets/scripts/js/plugins.js') }}"></script>
      <script src="{{ asset('assets/scripts/js/main.js') }}"></script>
      <script src="{{ asset('assets/scripts/js/vendor/bootstrap.min.js') }}"></script>

      @include('javascript')
      @yield('js') <!-- page-specific javascript-->

       <script>
       // (function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/DaBJd20KGXiNvgpEJT8A.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()


       //    <!-- A tab to launch the Classic Widget -->
                 
       //    UserVoice = window.UserVoice || [];
       //    UserVoice.push(['showTab', 'classic_widget', {
       //      mode: 'full',
       //      primary_color: '#cc6d00',
       //      link_color: '#007dbf',
       //      default_mode: 'support',
       //      forum_id: 215869,
       //      tab_label: 'Feedback & Support',
       //      tab_color: '#163fe3',
       //      tab_position: 'middle-right',
       //      tab_inverted: false
       //    }]);
       </script>

      <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
      <script>
          // var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
          // (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
          // g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
          // s.parentNode.insertBefore(g,s)}(document,'script'));
      </script>

</html>
