<script type="text/javascript">

//$(window).load(function(){
window.onload = initStyle;
//window.unload = initStyle;
    
function initStyle() {
  
    // $(".middles").slideToggle(1000);

        url = window.location.href;
        host = window.location.host;
        path = window.location.pathname;

        if($.prototype.bxSlider) {
          $('ul#bxslider').css('display', 'inline');
          bxslide(); //function on home script
        };
        // $('.bx-controls-direction').css({'display':'none'}); //hiding the next-prev controls        

        if($('.alert')){
        $('.alert').slideToggle(1000); setTimeout(function(){$('.alert').slideToggle(1000)}, 3000);
        }

        //$("img.preload").fadeOut(500, function() {});
};
//});​

function accounts(){
    @if(Auth::user())

    if(path.indexOf('/user/' + {{Auth::user()->id}} ) != -1) {

      // $('#tabs').bind('change', function (e) {
      //     var now_tab = e.target // activated tab
      //     console.log(now_tab);

      //     // get the div's id
      //     var divid = $(now_tab).attr('href').substr(1);
      //     console.log(divid);

      //     $.getJSON("{{ URL::to('user/books') }}").success(function(data){
      //         $("#"+divid).text(data.msg);
      //     });
      // })
      $('#mybookslink').click(function(e) {
          e.preventDefault();
          var url = $('#mybooks').attr('data-content');
          console.log(url);
          $('#mybooks').load(url, function(pane){
              $('#mybooks').tab('show');
              // console.log(pane);
          });
      });
        // $( "#tabs" ).tabs();
        // $('#myTabs a:first').tab('show');
        // $('#myTabs a').click(function (e) {
        //   e.preventDefault();
        //   $(this).tab('show');
        // })
        // .css({
        //   'min-height': '1200px'
        // });

        // .delay(500).css({float: "none", clear: "both"}).delay(500).css('height', function() {
        //   var h = parseFloat($(this).children('#account').children('.center_content').height()) + 150;
        //   console.log(h);
        //   return h + "px";
        // });
        console.log("{{ Auth::user()->firstname }} logged in");

        $(".searchcourses").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{ URL::to('courses/ajax') }}",
                    type: "GET",
                    cache: false,
                    dataType: "json",
                    success: function (data) {
                        var arrr = [];
                        $(data).each(function( index ) {
                            arrr.push({label:this.name, value:this.name, id:this.id, num:this.number });
                        });
                        response(arrr);
                    },
                    data: {
                        coursename: request.term
                    }
                });
            },
            select: function( event, ui ) {
                $('img.preload').fadeIn(500);
                $('#courseadder .searchcourses').val(ui.item.value);
                console.log($('#courseadder .searchcourses').val());
                console.log($('#courseadder').serialize());
                $.ajax({  
                    type: "POST",  
                    url: "{{ URL::to('courselists') }}",  
                    data: $('#courseadder').serialize(),
                    success: function(){  
                        $('img.preload').fadeOut(500);
                        $(".course_table table tbody").append('<tr><th>'+ui.item.num+'</th>\
                            <th><a href="{{ URL::to("courses/'+ui.item.id+'") }}">'+ui.item.value+'</a></th>\
                            <th></th><th></th><th>\
                            <form method="POST" action="{{{ URL::to("courselists") }}}" accept-charset="UTF-8">\
                            <input name="_method" type="hidden" value="DELETE">\
                            <input class="delete" onClick="event.preventDefault(); deletePop(this);" data-title="'+ui.item.value+'"\
                            data-content="Are you sure you want to remove this course?" type="submit" value=".">\
                            </form></th></tr>');
                        $('#courseadder .searchcourses').val("");
                        $('.savebook').css('display', 'inline');
                    }
                });
            }
        });
    };
    
    @endif
};

$(document).ready(function () {
    path = window.location.pathname;
    accounts();
//autocomplete for amazon book search 
	//http://completion.amazon.com/search/complete?method=completion&q=halo&search-alias=videogames&mkt=1&x=updateISSCompletion&noCacheIE=1295031912518
	//http://completion.amazon.com/search/complete?callback=jQuery18307210376521106809_1374486637060&q=hello&search-alias=stripbooks&mkt=1&callback=%3F&_=1374486648949
	var filter = $(".searchbooks").autocomplete({
	source: function (request, response) {
	  $.ajax({
	      url: "http://completion.amazon.com/search/complete",
	      type: "GET",
	      cache: false,
	      dataType: "jsonp",
	      success: function( data ) {
	          console.log(data);
	          response(data[1]);
	          var doneTypingInterval = 2000;
	          this.keyup(function(){setTimeout(function(){
	            window.location.href = "{{ URL::to('books/search?q="+
	            request.term +"&category=283155&sort=relevancerank') }}";
	            }, doneTypingInterval)});
	      }, 
	      data: {
	          q: request.term,
	          "search-alias": "stripbooks",
	          mkt: "1",
	          callback: '?'
	      }
	  });
	},
		select: function( event, ui ) {
	    console.log("Selected: "+ ui.item.value);
	    //var cat = document.getElementById("category").value;
	    //var sort = document.getElementById("sort").value;
	    var cat = $("#category").val();
	    var sort = $("#sort").val();

	    window.location.href = "{{ URL::to('books/search?q="+ui.item.value  +
	    "&category="+cat+
	    "&sort="+sort+"') }}";
	  }

	});

});

//autocomplete for colleges search 
  $(".searchcolleges").autocomplete({
    source: function (request, response) {
            $.ajax({
                url: "{{ URL::to('colleges/ajax') }}",
                type: "GET",
                cache: false,
                dataType: "json",
                success: function (data) {
                    //console.log(data[0] ? data[0].name : "No results");
                    var arr = [];
                    //var ids = [];
                    $(data).each(function( index ) {
                      arr.push({label:this.name, value:this.name, id:this.id });
                      //ids.push({value:this.id});
                    });
                    //console.log(arr);
                    //arr = arr.reverse();
                    response(arr);
                },
                data: {
                    term: request.term
                }
            });
    },
	select: function( event, ui ) {
	window.location.href = "{{ URL::to('colleges/"+ ui.item.id +"') }}";
	}
});




//doublescroll
if(document.getElementById('doublescroll')){
    function DoubleScroll(element) {
        var scrollbar= document.createElement('div');
        scrollbar.appendChild(document.createElement('div'));
        scrollbar.style.overflow= 'auto';
        scrollbar.style.overflowY= 'hidden';
        scrollbar.firstChild.style.width= element.scrollWidth+'px';
        scrollbar.firstChild.style.paddingTop= '1px';
        scrollbar.firstChild.appendChild(document.createTextNode('\xA0'));
        scrollbar.onscroll= function() {
            element.scrollLeft= scrollbar.scrollLeft;
        };
        element.onscroll= function() {
            scrollbar.scrollLeft= element.scrollLeft;
        };
        element.parentNode.insertBefore(scrollbar, element);
    }

    DoubleScroll(document.getElementById('doublescroll'));


  }

  $(function() {
          $(window).bind('resize', function()
          {
              resizeMe();
              }).trigger('resize');
        });
    percentage="";
    function resizeMe(){
            //Standard Width, for which the body font size is correct
          //fontsize = $("body").css("font-size").match(/\d+/);
          preferredWidth =850;  

          displayWidth = $(".wrapper").width();
          percentage = displayWidth / preferredWidth;
          newFontSize = Math.floor(14 * percentage);

          //$(".wrapper").css("left", Math.floor(210 * percentage)+"px");
          //$("img.logo").css("width", Math.floor(200 * percentage)+"px");
          //$(".charity").css("left", Math.floor(210 * percentage)+"px");
          //$(".middles").css("width", Math.floor(85 / percentage)+"%");

          // $("body").css("font-size", newFontSize+"px");
          // $("a").css("font-size", newFontSize+"px");

          //while(  $("select").css("font-size") && $("input").css("font-size") <14 ){
          //   $("select").css("font-size", newFontSize+"px");
          //   $("input").css("font-size", newFontSize+"px");
          // }
          // $("ul.top1").css("font-size", newFontSize+"px");
          // $(".footer").css("font-size", newFontSize+"px");
          // $(".charity").css("font-size", newFontSize+"px");
          // $("#bx-pager2 span").css("font-size", newFontSize+"px");
          // $("#bx-pager2 a").css("font-size", newFontSize+"px");
          // $("#bx-pager a").css("font-size", newFontSize+"px");
          // $("span.bookactions a").css("font-size", newFontSize+"px");                      

    };
    /*function autoResizeFont(){
        this.css("font-size", (this.css("font-size")*percentage)+"px");
    };*/


    jQuery('.btn-danger').click(function(evnt) {
        evnt.preventDefault();
        var title = "Confirm";
        var message = "Are you sure you want to delete?";
        var btn = $(this);
        console.log(btn);

        function formSubmit(){
            btn.parent('form').submit();
        }

        if (!jQuery('#dataConfirmModal').length) {
            jQuery('body').append('<div id="dataConfirmModal" \
             class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" \
             aria-hidden="true"><div class="modal-header"> \
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">× \
             </button><h3 id="dataConfirmLabel">'+title+'</h3></div><div class="modal-body"> \
             '+message+'</div><div class="modal-footer"><button class="btn btn-success" \
              data-dismiss="modal" aria-hidden="true">No</button><a class="btn btn-danger"  \
              data-dismiss="modal" id="dataConfirmOK">Yes</a></div> \
              </div>');
        } 

        jQuery('#dataConfirmModal').find('.modal-body').text(message);
        jQuery('a#dataConfirmOK').on('click', function(){
            formSubmit();
        });
        jQuery('#dataConfirmModal').modal({show:true});

    })

</script>