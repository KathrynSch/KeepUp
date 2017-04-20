<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reaction extends Model
{
	use SoftDeletes;

	 /**implements the SoftDeletes trait so we don't actually delete a record from the database when a user "unlike" something.*/

    protected $table = 'reactions';

    protected $fillable = [
        'id_user',
        'id_post',
        'type',
    ];

    public function post(){
    	return $this->morphedByMany('App\Post', 'reactions');
    }
}
