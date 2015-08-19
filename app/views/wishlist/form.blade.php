<div class="bookshelf-edit">

    <div class="book-profile clearfix">
        <img width="126" height="160" src="" id="imgurl" />    
        <div>
            <h2 id="title"></h2>
            <table class="bookThumbnail">
              <tbody>
                <tr>
                  <th>Author:</th><td id="author"></td>
                </tr>
                <tr>
                  <th>Published:</th><td id="publishdate"></td>
                </tr>
                <tr>
                  <th>Edition:</th><td id="edition"></td>
                </tr>
                <tr>
                  <th>ISBN:</th><td id="isbn"></td>
                </tr>
                <tr>
                  <th>On Amazon:</th>
                  <td>
                    <a target="_amazon" href="" id="amazonlink"> 
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>

    <div class="bookshelf-update-content">
      
        <form name="bookshelf-edit" method="post" action="/bookshelf/update">
            <input type="hidden" name="user_book[id]" value="2047" id="user_book_id">
            <input type="hidden" name="user_book[location_id]" value="1" id="user_book_location_id">
            <input type="hidden" name="user_book[available]" id="user_book_available" value="2013-07-24 00:00:00">
            <fieldset>
            <div>
                <label for="user_book_price">Price</label>
                <input type="text" name="user_book[price]" class="small" id="user_book_price">                  
                <p class="small">To indicate an interest in ONLY trading or lending a book, enter a price of zero.
                 Otherwise, enter the sale price.</p>
            </div>
            <div>
                
        

        <label for="user_book_location_id">Location</label> 
        <input id="sf_guard_user_locations_list_autocomplete" class="x-large ui-autocomplete-input" 
        value="Alabama A &amp; M University" name="autocomplete_field" autocomplete="off" 
        role="textbox" aria-autocomplete="list" aria-haspopup="true">
          
        <input type="hidden" name="user_book[location_id]" value="Alabama A &amp; M University" id="user_book_location_id"> 
        </div>

        <label for="user_book_status">Status</label>    
        <ul class="radio_list">
            <li><input name="user_book[status]" type="radio" value="1" id="user_book_status_1" checked="checked">&nbsp;
            <label for="user_book_status_1">available </label></li>
            <li><input name="user_book[status]" type="radio" value="3" id="user_book_status_3">&nbsp;
            <label for="user_book_status_3">sold</label></li>
            <li><input name="user_book[status]" type="radio" value="5" id="user_book_status_5">&nbsp;
            <label for="user_book_status_5">unavailable</label></li>
        </ul>           
                <input type="hidden" name="user_book[available]" id="user_book_available">
                <label for="user_book_available">Available beginning</label>    
                <input type="text" id="user_book_available_calendar" class="hasDatepicker">
            
                
        <label for="user_book_condition_id">Condition</label>       
        <ul class="radio_list">
        <li><input name="user_book[condition_id]" type="radio" value="1" id="user_book_condition_id_1">&nbsp;
            <label for="user_book_condition_id_1">Like New - Shiny cover, crisp corners, no back creases</label></li>
        <li><input name="user_book[condition_id]" type="radio" value="2" id="user_book_condition_id_2">&nbsp;
            <label for="user_book_condition_id_2">Light Use - a few dog-eared corners, no marks or tears</label></li>
        <li><input name="user_book[condition_id]" type="radio" value="3" id="user_book_condition_id_3">&nbsp;
            <label for="user_book_condition_id_3">Normal Use - dog-eared, some highlights and notes in the margins</label></li>
        <li><input name="user_book[condition_id]" type="radio" value="5" id="user_book_condition_id_5">&nbsp;
            <label for="user_book_condition_id_5">Heavy Use - has that vintage, lived-in look</label></li>
        <li><input name="user_book[condition_id]" type="radio" value="6" id="user_book_condition_id_6">&nbsp;
            <label for="user_book_condition_id_6">Rough - it's all there &amp; usable, but that's about it</label></li>
        </ul>           

        </fieldset>
       </form> 
    </div>


</div>


@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif



