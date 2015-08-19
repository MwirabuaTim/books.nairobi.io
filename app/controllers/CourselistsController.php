<?php

class CourselistsController extends BaseController {

    /**
     * Courselist Repository
     *
     * @var Courselist
     */
    protected $courselist;

    public function __construct(Courselist $courselist)
    {
        $this->courselist = $courselist;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $courselists = $this->courselist->all();

        return View::make('courselists.index', compact('courselists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('courselists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $input['userid'] = Auth::user()->id; 
        $input['username'] = Auth::user()->fullName(); 

        if(DB::table('courses')->where('name', 'like', $input['coursename'])->get()):

            $course =  DB::table('courses')->where('name', 'like', $input['coursename'])->get();
        // var_dump($course);
            $input['courseid'] = $course['0']->id;

            $validation = Validator::make($input, CourseList::$rules);

            if ($validation->passes()):
            
                $this->courselist->create($input);
                // var_dump($input);
            endif;
        else:
            return Redirect::route('courses.index')
                ->with('info', 'You can only add a course from this list.');
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
        $courselist = $this->courselist->findOrFail($id);

        return View::make('courselists.show', compact('courselist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $courselist = $this->courselist->find($id);

        if (is_null($courselist))
        {
            return Redirect::route('courselists.index');
        }

        return View::make('courselists.edit', compact('courselist'));
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
        $validation = Validator::make($input, Courselist::$rules);

        if ($validation->passes())
        {
            $courselist = $this->courselist->find($id);
            $courselist->update($input);

            return Redirect::route('courselists.show', $id);
        }

        return Redirect::route('courselists.edit', $id)
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
        $this->courselist->find($id)->delete();

        return Redirect::to('user');
    }

}