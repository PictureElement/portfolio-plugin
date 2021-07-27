<?php namespace Msof\Portfolio\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'msof_portfolio_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name'   => 'required',
        'slug'    => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:msof_portfolio_categories']
    ];
    
    /**
     * Relations
     */
    public $hasMany = [
        'projects' => 'Msof\Portfolio\Models\Project'
    ];
}
