<?php

class BooksController extends AuthorizedController {

	/**
	 * Let's whitelist all the methods we want to allow guests to visit!
	 *
	 * @access   protected
	 * @var      array
	 */
	protected $whitelist = array(
		'show',
		'index',
		'indexByUser',
		'indexByCollege',
		'indexSellers',
		'indexBuyers',
		'searchAmazon',
		'searchAmazon2',
		'search',
		'searchByUser',
		'searchByCollege',
		'searchSellers',
		'searchBuyers'
	);

	public function show($id) // view one book
	{
		//
	}

	public function index()  // all local books
	{
		//
	}

	public function indexByUser($id) 	// all books by a user
	{
	if(User::find($id)):
		$user =  User::find($id);
		$bookshelves = DB::table('bookshelves')->where('userid', 'like', $id)->get();
		$wishlists = DB::table('wishlists')->where('userid', 'like', $id)->get();
		$title = $user->firstname."'s Books";

		if(Auth::user()){
			if(Auth::user()->id == $id ){
	            $title = "Your Books";
	        }
	    };

    	   return View::make('user.booksbyuser')
    	   			->with('user', $user)
    	   			->with('title', $title)
                    ->with('wishlist', $wishlists)
                    ->with('bookshelf', $bookshelves);
	    	// return Redirect::to('books/user/'.Auth::user()->id)
		    //     ->with('info', 'You can only access your books at the moment.');
	        // endif;
    else:
    	return Redirect::to('user/login')
            ->with('info', 'Please log in to view this. Register for free!');
    endif;

  	}

	public function indexMyBooks() 	// all books by me
	{
		$user =  Auth::user();
		$bookshelves = DB::table('bookshelves')->where('userid', 'like', $user->id)->get();
		$wishlists = DB::table('wishlists')->where('userid', 'like', $user->id)->get();

		return View::make('user.books', compact('user'))
                ->with('wishlist', $wishlists)
                ->with('bookshelf', $bookshelves);

	}

	public function indexByCollege($id) 	// all books by a college
	{
		//
	}

	public function indexSellers($id)	//	sellers for a book
	{
		//
	}

	public function indexBuyers($id)	//	buyers for a book
	{
		//
	}

	public function searchAmazon()	// Amazon search submit, not autocomplete, amazonecs
	{
		$data = '<p>Oops, your search returned no book. Please try another search.</p>'; 

		if($_GET['q'] == "Search for a book title, Subject, Author or ISBN..."){
			$data = '<p>Please type in a query to search...</p>';
		}
		if(isset($_GET['q']) && $_GET['q'] != "Search for a book title, Subject, Author or ISBN...") { 
			$filters['q'] = Input::get('q');
			$filters['node'] = Input::get('category', 283155);
			$filters['page'] = Input::get('page', 1); 
			$filters['sort'] = Input::get('sort');
			//echo $filters['q'];

		    // These are nodes from Amazon.com, I found them on browsenodes.com
			$this->textBookNodes = array(
				'All Books' => 283155,
				'All Textbooks' => 465600,
				'Business & Finance Textbooks' => 468220,
				'Communication & Journalism Textbooks' => 468226,
				'Computer Science Textbooks' => 468204,
				'Education Textbooks' =>  468224,
				'Engineering Textbooks' => 468212,
				'Humanities Textbooks'  => 468206,
				'Law Textbooks' => 468222,
				'Medicine & Health Sciences Textbooks' => 468228,
				'Reference Textbooks' => 684283011,
				'Science & Mathematics Textbooks' => 468216,
				'Social Sciences Textbooks' => 468214
				);

			if(array_search($filters['node'], $this->textBookNodes) === FALSE){
				$filter['node'] = 283155;
			}

			$this->sorts = array(
				'Relevance' => 'relevancerank',
				'Alphabetical: A to Z' => 'titlerank',
				'Alphabetical: Z to A' => '-titlerank',
				'Bestselling' => 'salesrank',
				'Average customer review' => 'reviewrank',
				'Price: low to high' => 'pricerank',
				'Price: high to low' => 'inverse-pricerank',
				'Publication date: newer to older' => 'daterank'
				);

			if(array_search($filters['sort'], $this->sorts) === FALSE){
				$filter['sort'] = 'relevancerank';
			}

			$amazonProductApi = new bcAmazonProductApi();

		    // changing the category to DVD and the response to only images and looking for some matrix stuff.
			$response = $amazonProductApi->category('Books')->responseGroup('Medium');


		    // from now on you want to have pure arrays as response
			$amazonProductApi->returnType(AmazonECS::RETURN_TYPE_ARRAY);
			$amazonProductApi->page($filters['page']);



		    // searching again
			if(is_null($filters['q']) OR strlen($filters['q'])<1){
				$this->results = NULL;
			}else{
				$this->results = $amazonProductApi->search($filters['q'], $filters['node'], $filters['sort']);
			}

			$this->filters = $filters;
			$results = $this->results;

			
			if(isset($results['Items']['Item'])){
				$data = array();
				foreach ($results['Items']['Item'] as $item) {
					
					array_push($data, $item);
				}
			}

			//$dataa = json_decode(json_encode($data), FALSE);
			//var_dump($data);
		}
		if(Auth::user()):
			return View::make('searchresults', compact('data'));
		else:
			return View::make('searchresults', compact('data'))
			->with('info', 'You have to be logged in to add these books. Register for free!');
		endif;
		//return View::make('searchsingle', compact('data'));
	
	}

	public function searchAmazon2() //	Amazon search submit, not autocomplete, amazonsearch
	{
		$data = '<p>Oops, your book was not found. Please try another search.</p>'; 

		if($_GET['q'] == "Search for a book title, Subject, Author or ISBN..."){
			$data = '<p>Please type in a query to search...</p>';
		}
		if(isset($_GET['q']) && $_GET['q'] != "Search for a book title, Subject, Author or ISBN...") { 
			/* Example usage of the Amazon Product Advertising API */ 

			$obj = new AmazonProductAPI(); 
			$result ='' ; 

				$result = $obj->searchProducts($_GET['q'], 
					AmazonProductAPI::Books, 
					"TITLE"); 
				$data = $result->Items;

				if(isset($result->Items)){
					$xmlstring = $result->Items;
					if ($xmlstring) {
						foreach ($xmlstring->Item as $item) {
							array_push($data, $item);
						}
					}
				}
	
		}
		return View::make('searchresults', compact('data'));
		//return View::make('searchsingle', compact('data'));

	}

	public function search()  // all local books
	{
		//
	}

	public function searchByUser($id) 	// all books by a user
	{
		//
	}

	public function searchByCollege($id) 	// all books by a college
	{
		//
	}
	
	public function searchSellers($id)	//	sellers for a book
	{
		//
	}

	public function searchBuyers($id)	//	buyers for a book
	{
		//
	}

}
