<?php

class CollegesController extends BaseController {

    /**
     * College Repository
     *
     * @var College
     */
    protected $college;

    public function __construct(College $college)
    {
        $this->college = $college;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        //$colleges = $this->college->all();
        //$users = User::where('votes', '>', 100)->paginate(15);
        $colleges = College::orderBy('name', 'asc')->paginate(20);

        return View::make('colleges.index', compact('colleges'));
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('colleges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, College::$rules);

        if ($validation->passes())
        {
            $this->college->create($input);

            return Redirect::route('colleges.index');
        }

        return Redirect::route('colleges.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $college = $this->college->findOrFail($id);

        $bookshelves = DB::table('bookshelves')->where('collegeid', 'like', $id)->get();
        $wishlists = DB::table('wishlists')->where('collegeid', 'like', $id)->get();
        // $wishlists =  Wishlist::find('collegeid', $college->id);

         // var_dump($wishlists['0']->userid);
        // if(isset($wishlists['0']->userid)):
        //     // $userarray = DB::table('users')->where('id', 'like', $wishlists['0']->userid)->get();
        //     // $username = $userarray['0']->firstname . ' ' .  $userarray['0']->lastname;
        //     $wishlists =  Wishlist::find('collegeid, '$college->id);
        // else:
        //     $username = '';
        // endif;
        // var_dump($userarray['0']->firstname . ' ' .  $userarray['0']->lastname);

        // $wishlists['0']->username   = $userarray['0']->firstname . ' ' .  $userarray['0']->lastname;
        // var_dump($wishlists['0']->collegename);

        return View::make('colleges.show', compact('college'))
                    ->with('wishlist', $wishlists)
                    ->with('bookshelf', $bookshelves);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $college = $this->college->find($id);

        if (is_null($college))
        {
            return Redirect::route('colleges.index');
        }

        return View::make('colleges.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, College::$rules);

        if ($validation->passes())
        {
            $college = $this->college->find($id);
            $college->update($input);

            return Redirect::route('colleges.show', $id);
        }

        return Redirect::route('colleges.edit', $id)
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
        $this->college->find($id)->delete();

        return Redirect::route('colleges.index')->with('success', 'The college has been Deleted');
    }


    public function search()
    {
        $term = Input::get('term');
        //$data = array();

        $query = DB::table('colleges')->where('name', 'like', '%'.$term.'%')->take(10)->get();
        if(!isset($query[0])){
            $query = '<h4>There are no colleges that match "'. $term .'". Please search another college...</h4>';
        }

        //$searchresults = College::find($id)->orderBy('name', 'asc')->paginate(20);
        // if (isset($query['0']->name)):
        //     var_dump($query['0']);
        // endif;

        return View::make('colleges.searchresults', compact('query'))->with('term', $term);
    }
    public function ajaxByLetters() {
        $term = Input::get('term');
        // $data = array();
        //$query = College::where('name', $term)->take(10)->get();
        $query = DB::table('colleges')->where('name', 'like', '%'.$term.'%')->take(10)->get();
        //$query = 'SELECT name FROM colleges WHERE name LIKE "%'.$term.'%" OR street LIKE "%'.$term.'%" LIMIT 0, 10';
        //$query = "SELECT name FROM colleges WHERE name LIKE '%".$term."%' OR street LIKE '%".$term."%' LIMIT 0, 10";
        
        //var_dump($query);
        //foreach ($query as $user){
        //var_dump($user);
        //};

        return Response::json($query);
    }
        
}