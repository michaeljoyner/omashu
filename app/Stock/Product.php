<?php namespace Omashu\Stock;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    use SetsSlugFromNameTrait, HasImageTrait;

	protected $table = 'products';

    protected $fillable = [
        'name',
        'zh_name',
        'slug',
        'quantifier',
        'zh_quantifier',
        'description',
        'is_available',
        'image_path'
    ];

}
