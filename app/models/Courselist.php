<?php

class Courselist extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'coursename' => 'required'
	);
}