@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Search Results
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('assets/styles/css/searchresults.css')}} ">
@stop

@section('content')

@if(is_array($data))

<!-- var_dump(data) -->

    <ul id="searchresults">

    @foreach($data as $item)
        <li>

            <?php
                
                $imgurl = "";
                if(isset($item["MediumImage"]["URL"]))
                    $imgurl = $item["MediumImage"]["URL"];
                else{
                    $imgurl = "Image not available";
                }
                $largeimg = "";
                if(isset($item["LargeImage"]["URL"]))
                    $largeimg = $item["LargeImage"]["URL"];
                else{
                    $largeimg = "Image not available";
                }

                $name = "";
                if(isset($item["ItemAttributes"]["Title"]))
                    $name = $item["ItemAttributes"]["Title"];
                else{
                    $name = "Not Titled";
                }

                $author = "";
                if(array_key_exists('Author', $item["ItemAttributes"])):
                    if(is_array($item["ItemAttributes"]["Author"])):
                        $author = implode(', ',array_values($item["ItemAttributes"]["Author"]));
                    else:
                        $author = $item["ItemAttributes"]["Author"];
                    endif;
                    // var_dump($item);
                //elseif(array_key_exists('Creator', $item["ItemAttributes"])):
                    //if(is_array($item["ItemAttributes"]["Creator"][0]) && is_array($item["ItemAttributes"]["Creator"][1])):
                     //   $author1 = implode(', ',array_values($item["ItemAttributes"]["Creator"][0]));
                     //   $author2 = implode(', ',array_values($item["ItemAttributes"]["Creator"][1]));
                      //  $author = $author1 . " and " . $author2;
                    //elseif(is_array($item["ItemAttributes"]["Creator"][0]):
                    //    $author = implode(', ',array_values($item["ItemAttributes"]["Creator"][0]));
                    //else:
                     //   $author = print_r($item["ItemAttributes"]["Creator"]);
                    // $author = "Creators: ". implode(', ',array_values($item["ItemAttributes"]["Creator"]));
                    //endif;
                else:
                    $author = "Unknown";
                endif;
                    // print_r($author);
                

                $publishdate = "";
                if(isset($item["ItemAttributes"]["PublicationDate"])):
                    $publishdate = $item["ItemAttributes"]["PublicationDate"];
                else:
                    $publishdate = "Unspecified";
                endif;

                $isbn = "";
                if(isset($item["ItemAttributes"]["ISBN"]))
                    $isbn = $item["ItemAttributes"]["ISBN"];
                else{
                    $isbn = "Unspecified";
                }

                $newprice = "";
                if(isset( $item["OfferSummary"]["LowestNewPrice"]["FormattedPrice"] ))
                    $newprice = $item["OfferSummary"]["LowestNewPrice"]["FormattedPrice"];
                else{ 
                    $newprice =  "Unspecified";
                }

                $usedprice = "";
                if(isset( $item["OfferSummary"]["LowestUsedPrice"]["FormattedPrice"] ))
                    $usedprice = $item["OfferSummary"]["LowestUsedPrice"]["FormattedPrice"];
                else{ 
                    $usedprice =  "Unspecified";
                }

                $bookurl = "";
                if(isset( $item["DetailPageURL"] ))
                    $bookurl = $item["DetailPageURL"];
                else{ 
                    $bookurl =  "Unspecified";
                }

                $binding = "";
                if(isset($item["ItemAttributes"]["Binding"]))
                    $binding = $item["ItemAttributes"]["Binding"];
                else{
                    $binding = "Unknown";
                }
                $q=$_GET['q'];
                $c=$_GET['category'];
                $s=$_GET['sort'];

            ?>


            <span class="bookimage">
                <img src="{{ $imgurl }}" name="{{ $imgurl }}" title="{{ $imgurl }}" />
            </span>
            <span class="bookdata">
                <h4>{{ $name }}</h4>
                <p>Authors: {{ $author }}</p>
                <p>Binding: {{ $binding }}</p>
                <p>Price: New from: {{ $newprice }}, Used from: {{ $usedprice }}</p>
            </span>
            <span class="bookactions">
                <a id="view" href="{{ $item["DetailPageURL"] }}">View On Amazon</a> |
                <a href="{{ $item["ItemLinks"]["ItemLink"][3]["URL"] }}">Add To Cart</a> | 
                <form id="addtocart" method="GET" action="http://www.amazon.com/gp/aws/cart/add.html">
                    <input type="hidden" name="AssociateTag" value="6345-8081-7310"/>
                    <input type="hidden" name="SubscriptionId" value="AKIAJCMQDVYRM6ZS674A"/> 
                    <input type="hidden" name="ASIN.1" value="{{ $item["ASIN"] }}"/><br/>
                    <input type="hidden" name="Quantity.1" value="1"/><br/>
                    <input type="image" name="add" value="Buy from Amazon.com" border="0" 
                     alt="Buy from Amazon.com" src="http://images.amazon.com/images/G/01/associates/add-to-cart.gif">
                </form>
                <span class="blue">
    

<!-- <a id="bookshelf" class="btn btn-primary btn-small" href="{{ $item["ItemLinks"]["ItemLink"][3]["URL"] }}">Add To Bookshelf</a> -->

<!-- <form method="POST" action="{{ URL::to('bookshelf/store') }}"> -->
    <input name="name" style="display:none;" class="name" value="{{ $name }}"/>
    <input name="author" style="display:none;" class="author" value="{{ $author }}"/>
    <input name="query" style="display:none;" class="query" value="{{ $q }}"/>
    <input name="bookurl" style="display:none;" class="bookurl" value="{{ $bookurl }}"/>
    <input name="imgurl" style="display:none;" class="imgurl" value="{{ $imgurl }}"/>
    <input name="publishdate" style="display:none;" class="publishdate" value="{{ $publishdate }}"/>
    <input name="binding" style="display:none;" class="binding" value="{{ $binding }}"/>
    <input name="isbn" style="display:none;" class="isbn" value="{{ $isbn }}"/>
    <input name="newprice" style="display:none;" class="newprice" value="{{ $newprice }}"/>
    <input name="usedprice" style="display:none;" class="usedprice" value="{{ $usedprice }}"/>
    <input name="largeimg" style="display:none;" class="largeimg" value="{{ $largeimg }}"/>

<input type="submit" id="bookshelf" class="btn btn-primary btn-small" value="Add To Bookshelf"/>
<!-- </form> -->

<form method="POST" action="{{ URL::to('wishlist') }}">

    <input name="name" style="display:none;" class="name" value="{{ $name }}"/>
    <input name="author" style="display:none;" class="author" value="{{ $author }}"/>
    <input name="query" style="display:none;" class="query" value="{{ $q }}"/>
    <input name="bookurl" style="display:none;" class="bookurl" value="{{ $bookurl }}"/>
    <input name="imgurl" style="display:none;" class="imgurl" value="{{ $imgurl }}"/>
    <input name="publishdate" style="display:none;" class="publishdate" value="{{ $publishdate }}"/>
    <input name="binding" style="display:none;" class="binding" value="{{ $binding }}"/>
    <input name="isbn" style="display:none;" class="isbn" value="{{ $isbn }}"/>
    <input name="newprice" style="display:none;" class="newprice" value="{{ $newprice }}"/>
    <input name="usedprice" style="display:none;" class="usedprice" value="{{ $usedprice }}"/>
    <input name="price" style="display:none;" class="usedprice" value="{{ $usedprice }}"/>
    <input name="largeimg" style="display:none;" class="largeimg" value="{{ $largeimg }}"/>


<input type="submit" id="wishlist" class="btn btn-primary btn-small" value="Add To Wishlist"/>
</form>
                </span>
            </span> 
    
        </li>
    @endforeach

    </ul>
@else

 {{ printf($data) }}

@endif


<div id="dialog-form">
@include('bookshelf.button')
</div>

@stop


@section('js')
 
 <script type="text/javascript">
     $('#dialog-form').dialog({
        title: "Add Book to your Bookshelf",
        autoOpen: false,
        width: 600,
        height: 600,
        appendTo: ".content",
        modal: true,
        buttons: {
        	'Save': function() {
                var book = $book;
                //alert(book);
                // $('.ui-dialog-buttonpane').append($('img.saveloader'));
                // $('img.saveloader').css('margin-top', '50%').fadeIn(1000);
                $('img.preload').fadeIn(1000);
                $.ajax({  
                    type: "POST",  
                    url: "{{ URL::to('bookshelf') }}",  
                    data: $('#bshelfform').serialize(),
                    context: $(this),  
                    success: function(){  
                        // $('img.saveloader').fadeOut(1000);
                        // $('.ui-dialog-buttonpane img.saveloader').fadeOut(1000);
                        $('img.preload').fadeOut(500);
                        $(this).dialog("close");
                        console.log($('#bshelfform').serialize());
                    },
                    error:  function(){
                        alert("check your connection");
                    }
                });
                return false;
            },
            'Close': function() { 
                $('#dialog-form').children("img").remove();
                $(this).dialog("close"); 
                console.log($('#bshelfform').serialize());
             }      
        }
      });
    $('#dialog-form').css({'z-index': '2000'});

    $('.ui-dialog').css({
      'position': 'fixed',
      'top': '10px',
      'border-right': '10px',
      'width': '600px',
      'height': '80%',
      'top': '10px',
      'left': '0px',
      'right': '0px',
      'margin': 'auto',
    });


    $("input#bookshelf").click(function (e) {
            e.preventDefault();
            $( '#dialog-form' ).dialog( 'open' );
            //console.log($(this).parent('span').parent('span').parent('li'));
            $bdata = $(this).parent('span');
            $book = {
                //'imgurl' : $bdata.children('.bookimage').children('img').attr('src'),
                'name' : $bdata.children('input.name').attr('value'),
                'author' :  $bdata.children('input.author').attr('value'),
                'price' :  $bdata.children('input.usedprice').attr('value'),//crucial - the price is set as the usedprice
                'query' : $bdata.children('input.query').attr('value'),
                'bookurl' : $bdata.children('input.bookurl').attr('value'),
                'imgurl' : $bdata.children('input.imgurl').attr('value'),
                'publishdate' : $bdata.children('input.publishdate').attr('value'),
                'binding' : $bdata.children('input.binding').attr('value'),
                'isbn' : $bdata.children('input.isbn').attr('value'),
                'newprice' : $bdata.children('input.newprice').attr('value'),
                'usedprice' : $bdata.children('input.usedprice').attr('value'),
                'largeimg' : $bdata.children('input.largeimg').attr('value'),
            };
            $('#name').attr('value', $book['name']);
            $('#author').attr('value', $book['author']);
            $('#price').attr('value', $book['price']);
            $('#query').attr('value', $book['query']);
            $('#bookurl').attr('value', $book['bookurl']);
            $('#imgurl').attr('value', $book['imgurl']);
            $('#publishdate').attr('value', $book['publishdate']);
            $('#binding').attr('value', $book['binding']);
            $('#isbn').attr('value', $book['isbn']);
            $('#newprice').attr('value', $book['newprice']);
            $('#usedprice').attr('value', $book['usedprice']);
            $('#largeimg').attr('value', $book['largeimg']);

            $('#dialog-form').append('<img style="position: absolute; top: 100px;right: 10px; width: 200px;" src="' + $book['largeimg'] + '" />');
        });

 </script>

@stop


