<?php

class WishlistsController extends BaseController {

    /**
     * Wishlist Repository
     *
     * @var Wishlist
     */
    protected $wishlist;

    public function __construct(Wishlist $wishlist)
    {
        $this->wishlist = $wishlist;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        if(Auth::user()):
            return Redirect::to('wishlist/user/' . Auth::user()->id);
        else:
            return Redirect::to('user/login')
                ->with('message', 'Please log in to add these books. Register free!');
        endif;

    }


    public function indexAll()  // all wishlist items in system
    {
        $wishlist = $this->wishlist->all();
        $title = "All Books in all Wishlists";
        $topmessage = "";

        return View::make('wishlist.indexall', compact('wishlist'))
                    ->with('title', $title)
                    ->with('topmessage', $topmessage);
    }

    public function indexByCollege($id)     //all wishlist items by a college
    {
        $wishlist = $this->wishlist->where('college', $id);
        $title = "All Books in College's Wishlists";
        $topmessage = "";

        return View::make('wishlist.index', compact('wishlist'))
                    ->with('title', $title)
                    ->with('topmessage', $topmessage);
    }

    public function indexByUser($id) // all wishlist items by a user id
    {
      // $wishlist = $this->wishlist->all();
        // $wishlist = DB::table('wishlists')->where('userid', 'like', '%'.$id.'%')->take(10)->get();
            $user =  User::find($id);
            $title = $user->firstname."'s Wishlist";
            $topmessage = "You can contact ". $user->fullNameLink()." if you want to buy these books";

        if(Auth::user()){
            if(Auth::user()->id == $id ){
                $user = Auth::user();
                $title = "Your Wishlist";
                $topmessage = link_to_route('wishlist.create', 'Add a Book to your Wishlist');
            }
        };

        $wishlistarray = DB::table('wishlists')->where('userid', 'like', $user->id)->get();
        // $wishlistobject =  Wishlist::where('userid', $id)->get();//collegeid5795 why not work????
        $wishlist = $wishlistarray;
        // var_dump($wishlistobject);
        return View::make('wishlist.indexbyuser', compact('wishlist'))
                    ->with('title', $title)
                    ->with('topmessage', $topmessage)
                    // ->with('wishlistobject', $wishlistobject)
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
         return View::make('wishlist.create')
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
            $validation = Validator::make($input, Wishlist::$rules);

            if ($validation->passes())
            {
                $this->wishlist->create($input);

                return Redirect::route('wishlist.index');
            }

            return Redirect::route('wishlist.create')
                ->withInput()
                ->withErrors($validation)
                ->with('message', 'There were validation errors.');
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
        $wishlist = $this->wishlist->findOrFail($id);
        $user =  User::find($wishlist->userid);
        $title = $wishlist->name;

        if(Auth::user()->id == $user->id ){
            $topmessage = 'On '.link_to_route('wishlist.index', 'Your Wishlist');
        }
        else{
            $topmessage = "You can contact ". $user->fullNameLink()." if you have this book to sell";
        }

        return View::make('wishlist.show', compact('wishlist'))
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
        $wishlist = $this->wishlist->find($id);
        $user =  User::find($wishlist->userid);

        if(!(Auth::user()) || Auth::user()->id != $user->id ){

            return Redirect::route('wishlist.index');
        }

        if (is_null($wishlist))
        {
            return Redirect::route('wishlist.index');
        };


        return View::make('wishlist.edit', compact('wishlist'));

    }
    public function add()
    {
        $wishlist = array(
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
        // http://localhost:8000/wishlist/add?
        // name=Fort+Laramie+and+the+Sioux
        // &author=Remi+Nadeau
        // &price=%2415.95
        // &userid=25
        // &collegeid=22
        // &query=http%3A%2F%2Fecx.images-amazon.com%2Fimages%2FI%2F519S4VK5D0L._SL160_.jpg
        // $wishlist-> = ;
        // var_dump($wishlist);

        if(!(Auth::user())){
            return Redirect::route('user.login')
                ->with('info', 'Please log in to be able to add books. Registering is free!');
        }

        return View::make('wishlist.add', compact('wishlist'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        $wishlist = $this->wishlist->find($id);
        $user =  User::find($wishlist->userid);

        if(!(Auth::user()) || Auth::user()->id != $user->id ){

            return Redirect::route('wishlist.index');
        }

        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Wishlist::$rules);

        if ($validation->passes())
        {
            $wishlist = $this->wishlist->find($id);
            $wishlist->update($input);

            return Redirect::route('wishlist.show', $id);
        }

        return Redirect::route('wishlist.edit', $id)
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
        $wishlist = $this->wishlist->find($id);
        $user =  User::find($wishlist->userid);

        if(!(Auth::user()) || Auth::user()->id != $user->id ){

            return Redirect::route('wishlist.index');
        }

        $this->wishlist->find($id)->delete();

        return Redirect::route('wishlist.index')->with('success', 'The book has been Deleted');
    }

}