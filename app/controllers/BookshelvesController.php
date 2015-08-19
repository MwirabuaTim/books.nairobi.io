<?php

class BookshelvesController extends BaseController {

    /**
     * Bookshelf Repository
     *
     * @var Bookshelf
     */
    protected $bookshelf;

    public function __construct(Bookshelf $bookshelf)
    {
        $this->bookshelf = $bookshelf;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        if(Auth::user()):
            return Redirect::to('bookshelf/user/' . Auth::user()->id);
        else:
            return Redirect::to('user/login')
                ->with('message', 'Please log in to add these books. Register free!');
        endif;

    }

    public function indexAll()  // all bookshelf items in system
    {
        $bookshelf = $this->bookshelf->all();
        $title = "All Books in all Bookshelves";
        $topmessage = "";

        return View::make('bookshelf.indexall', compact('bookshelf'))
                    ->with('title', $title)
                    ->with('topmessage', $topmessage);
    }

    public function indexByCollege($id)     //all bookshelf items by a college
    {
        $bookshelf = $this->bookshelf->where('college', $id);
        $title = "All Books in College's Bookshelves";
        $topmessage = "";

        return View::make('bookshelf.index', compact('bookshelf'))
                    ->with('title', $title)
                    ->with('topmessage', $topmessage);
    }

    public function indexByUser($id) // all bookshelf items by a user id
    {
        // $bookshelf = $this->bookshelf->all();
        // $bookshelf = DB::table('bookshelves')->where('userid', 'like', '%'.$id.'%')->take(10)->get();
            $user =  User::find($id);
            $title = $user->firstname."'s Bookshelf";
            $topmessage = "You can contact ". $user->fullNameLink()." if you want to buy these books";

        if(Auth::user()){
            if(Auth::user()->id == $id ){
                $user = Auth::user();
                $title = "Your Bookshelf";
                $topmessage = link_to_route('bookshelf.create', 'Add a Book to your Bookshelf');
            }
        };

        $bookshelfarray = DB::table('bookshelves')->where('userid', 'like', $user->id)->get();
        // $bookshelfobject =  Bookshelf::where('userid', $id)->get();//collegeid5795 why not work????
        $bookshelf = $bookshelfarray;
        // var_dump($bookshelfobject);
        return View::make('bookshelf.indexbyuser', compact('bookshelf'))
                    ->with('title', $title)
                    ->with('topmessage', $topmessage)
                    // ->with('bookshelfobject', $bookshelfobject)
                    ->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $topmessage = "Note: You can search the book above first and just click to add!";
        return View::make('bookshelf.create')
                ->with('topmessage', $topmessage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        
        if(Auth::user()):

            $input = Input::all();

            //overwriting whatever is in scaffold form:
            $input['userid'] = Auth::user()->id; 
            $input['collegeid'] = Auth::user()->collegeid(); 
            

            //var_dump($input);
            $validation = Validator::make($input, Bookshelf::$rules);

            if ($validation->passes()):

                $this->bookshelf->create($input);

                if(URL::previous() == URL::to('bookshelf/create')):
                    return Redirect::route('bookshelf.index');
                else:
                    return Redirect::to(URL::previous());
                endif;
            else:
            return Redirect::route('bookshelf.create')
                ->withInput()
                ->withErrors($validation)
                ->with('message', 'There were validation errors.');
            endif;
        else:
            return Redirect::to('user/login')
                ->with('message', 'Please log in to add these books. Register free!');
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $bookshelf = $this->bookshelf->findOrFail($id);
        $user =  User::find($bookshelf->userid);
        $title = $bookshelf->name;

        if(Auth::user()->id == $user->id ){
            $topmessage = 'On '.link_to_route('bookshelf.index', 'Your Wishlist');
        }
        else{
            $topmessage = "You can contact ". $user->fullNameLink()." if you need this book";
        }

        return View::make('bookshelf.show', compact('bookshelf'))
            ->with('user', $user)
            ->with('title', $title)
            ->with('topmessage', $topmessage);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $bookshelf = $this->bookshelf->find($id);
        $user =  User::find($bookshelf->userid);

        if(!(Auth::user()) || Auth::user()->id != $user->id ){

            return Redirect::route('bookshelf.index');
        }

        if (is_null($bookshelf))
        {
            return Redirect::route('bookshelf.index');
        }


        return View::make('bookshelf.edit', compact('bookshelf'));

    }
    public function add()
    {
        $bookshelf = array(
            'name' => $_GET['title'],
            'author' => $_GET['author'],
            // 'publishdate' => $_GET['publishdate'],
            // 'edition' => $_GET['edition'],
            // 'isbn' => $_GET['isbn'],
            'price' => $_GET['newprice'],
            // 'usedprice' => $_GET['usedprice'],
            // 'amazonlink' => $_GET['amazonlink'],
            'imgurl' => $_GET['imgurl'],
            'query' => $_GET['query'],
            'userid' => Auth::user()->id,
            'collegeid' => Auth::user()->collegeid,
             );
// http://localhost:8000/bookshelf/add?
// name=Fort+Laramie+and+the+Sioux
// &author=Remi+Nadeau
// &price=%2415.95
// &userid=25
// &collegeid=22
// &query=http%3A%2F%2Fecx.images-amazon.com%2Fimages%2FI%2F519S4VK5D0L._SL160_.jpg
        // $bookshelf-> = ;
        // var_dump($bookshelf);

        if(!(Auth::user())){
            return Redirect::route('user.login')
                ->with('info', 'Please log in to be able to add books. Registering is free!');
        }

        return View::make('bookshelf.add', compact('bookshelf'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        $bookshelf = $this->bookshelf->find($id);
        $user =  User::find($bookshelf->userid);

        if(!(Auth::user()) || Auth::user()->id != $user->id ){

            return Redirect::route('bookshelf.index');
        }

        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Bookshelf::$rules);

        if ($validation->passes())
        {
            $bookshelf = $this->bookshelf->find($id);
            $bookshelf->update($input);

            return Redirect::route('bookshelf.show', $id);
        }

        return Redirect::route('bookshelf.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $bookshelf = $this->bookshelf->find($id);
        $user =  User::find($bookshelf->userid);

        if(!(Auth::user()) || Auth::user()->id != $user->id ){

            return Redirect::route('bookshelf.index');
        }

        $this->bookshelf->find($id)->delete();

        return Redirect::route('bookshelf.index')->with('success', 'The book has been Deleted');
    }

}