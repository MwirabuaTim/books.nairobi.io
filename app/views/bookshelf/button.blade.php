

<h1>Add a Book to your Bookshelf</h1>

{{ Form::open(array('method' => 'POST', 'route' => 'bookshelf.store', 'id' => 'bshelfform')) }}
    <ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', null, array('id' => 'name')) }}
        </li>

        <li>
            {{ Form::label('author', 'Author:') }}
            {{ Form::text('author', null, array('id' => 'author')) }}
        </li>

        <li>
            {{ Form::label('price', 'Price:') }}
            {{ Form::text('price', null, array('id' => 'price')) }}
        </li>
        <li class="radio status">
            {{ Form::label('status', 'Status:') }}
            <ul>
                <li>
                    {{ Form::radio('status', 'Available', true, array('id' => 'status-available')) }}
                    {{ Form::label('status-available', 'Available') }}
                </li>
                <li>
                    {{ Form::radio('status', 'Sold', false, array('id' => 'status-sold')) }}
                    {{ Form::label('status-sold', 'Sold') }}
                </li>
                <li>
                    {{ Form::radio('status', 'Unavailable', false, array('id' => 'status-unavailable')) }}
                    {{ Form::label('status-unavailable', 'Unavailable') }}
                </li>
            </ul>
        </li>
        <li>
            {{ Form::label('dateavailable', 'Date Available') }}
            {{ Form::text('available', \Carbon\Carbon::now(), array('id' => 'date-available')) }}
        </li>
        <li class="radio condition">
            {{ Form::label('condition', 'Condition') }}
            <ul>
                <li>
                    {{ Form::radio('condition', 'Like New - Shiny cover, crisp corners, no back creases', true, array('id' => 'condition-like-new')) }}
                    {{ Form::label('condition-like-new', 'Like New - Shiny cover, crisp corners, no back creases') }}
                </li>
                <li>
                    {{ Form::radio('condition', 'Light Use - a few dog-eared corners, no marks or tears', false, array('id' => 'condition-light-use')) }}
                    {{ Form::label('condition-light-use', 'Light Use - a few dog-eared corners, no marks or tears') }}
                </li>
                <li>
                    {{ Form::radio('condition', 'Normal Use - dog-eared, some highlights and notes in the margins', false, array('id' => 'condition-normal-use')) }}
                    {{ Form::label('condition-normal-use', 'Normal Use - dog-eared, some highlights and notes in the margins') }}
                </li>
                <li>
                    {{ Form::radio('condition', 'Heavy Use - has that vintage, lived-in look', false, array('id' => 'condition-heavy-use')) }}
                    {{ Form::label('condition-heavy-use', 'Heavy Use - has that vintage, lived-in look') }}
                </li>
                <li>
                    {{ Form::radio('condition', 'Rough - it\'s all there \& usable, but that\'s about it', false, array('id' => 'condition-rough')) }}
                    {{ Form::label('condition-rough', 'Rough - it\'s all there \& usable, but that\'s about it') }}
                </li>
            </ul>
        </li>

        {{ Form::text('query', null, array('id' => 'query', 'style' => 'display:none')) }}
        {{ Form::text('bookurl', null, array('id' => 'bookurl', 'style' => 'display:none')) }}
        {{ Form::text('imgurl', null, array('id' => 'imgurl', 'style' => 'display:none')) }}
        {{ Form::text('publishdate', null, array('id' => 'publishdate', 'style' => 'display:none')) }}
        {{ Form::text('binding', null, array('id' => 'binding', 'style' => 'display:none')) }}
        {{ Form::text('isbn', null, array('id' => 'isbn', 'style' => 'display:none')) }}
        {{ Form::text('newprice', null, array('id' => 'newprice', 'style' => 'display:none')) }}
        {{ Form::text('usedprice', null, array('id' => 'usedprice', 'style' => 'display:none')) }}
        {{ Form::text('largeimg', null, array('id' => 'largeimg', 'style' => 'display:none')) }}
        
        <li style="display:none">
            {{ Form::submit('Save', array('class' => 'submitbook btn btn-info')) }}
            <a href="URL::previous()" class="btn">Cancel</a>
        </li>
    </ul>
{{ Form::close() }}

