<?php

class Bookshelf extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
    	'name' => 'required',
		// 'price' => 'required',
		// 'condition' => 'required',
		// 'available' => 'required',
	);
	public function collegeName()
	{

		if(DB::table('colleges')->where('id', $this->collegeid)->first()){
			$collegeobject = DB::table('colleges')->where('id', $this->collegeid)->first();
			$collegename = $collegeobject->name; //Auth::user()->collegeName()
			return $collegename;
		}
		
		else{
			return '';
		}
	}
	public function collegeURL()
	{

		if(DB::table('colleges')->where('id', $this->collegeid)->first()){
			$collegeobject = DB::table('colleges')->where('id', $this->collegeid)->first();
			$collegeid = $collegeobject->id; //Auth::user()->collegeName()
			return URL::to('colleges/'.$collegeid);
		}
		else{
			return URL::to('bookshelf/'.$this->id.'/edit');
		}
		//User::find(Auth::user()->id);
		// Retrieving A Single Row From A Table:
		// $user = DB::table('user')->where('name', 'John')->first();
	}
	public function collegeLink(){

		if(DB::table('colleges')->where('id', $this->collegeid)->first()):
            return '<a href="'.$this->collegeURL().'">'.$this->collegeName().'</a>';
        else:
            return 'Not Specified';
        endif;
	}
}