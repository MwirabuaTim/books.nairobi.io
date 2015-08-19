<?php

class College extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'longitude' => 'required',
		'added_by' => 'required',
		'approved_by' => 'required',
		'approved_at' => 'required'
	);

	public function collegeName()
	{
		return $this->name;
	}
	public function collegeNameLink()
	{
		return '<a href="'.URL::to('college/'.$this->id).'">'.$this->collegeName().'</a>';
	}
}