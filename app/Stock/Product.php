<?php namespace Omashu\Stock;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    use SetsSlugFromNameTrait;

	protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'quantifier',
        'description',
        'is_available',
        'image_path'
    ];

}
