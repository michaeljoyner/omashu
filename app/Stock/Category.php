<?php namespace Omashu\Stock;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    use SetsSlugFromNameTrait;

	protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_path'
    ];

    public function products()
    {
        return $this->hasMany('Omashu\Stock\Product', 'category_id');
    }

}
