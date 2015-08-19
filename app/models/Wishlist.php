<?php

class Wishlist extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'name' => 'required',
		// 'price' => 'required',
		// 'deleted_at' => 'required'
	);

	// public function userName()
	// {
	// 	if(DB::table('colleges')->where('id', $this->collegeid)->first()){
	// 		$collegeobject = DB::table('colleges')->where('id', $this->collegeid)->first();
	// 		$collegename = $collegeobject->name;
	// 		return $collegename;
	// 	}
	// 	else{
	// 		return 'Add a College';
	// 	}
	// }
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
			return URL::to('wishlist/'.$this->id.'/edit');
		}
	}
	public function collegeLink(){

		if(DB::table('colleges')->where('id', $this->collegeid)->first()):
            return '<a href="'.$this->collegeURL().'">'.$this->collegeName().'</a>';
        else:
            return 'Not Specified';
        endif;
	}
}