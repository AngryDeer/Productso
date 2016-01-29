<?php

namespace Angrydeer\Productso\Models;

use Kalnoy\Nestedset\Node;

class PrsoCategory extends Node
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', '_lft', '_rgt', 'parent_id', 'note', 'desc', 'showtop', 'showside', 'showbottom', 'showcontent',
    ];

}
