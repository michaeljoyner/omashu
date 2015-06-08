<?php namespace Omashu\Stock;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

    use SetsSlugFromNameTrait;

	protected $table = 'brands';

    protected $fillable = [
        'name',
        'slug',
        'website',
        'image_path',
        'tagline',
        'description',
    ];

    public function categories()
    {
        return $this->hasMany('Omashu\Stock\Category', 'brand_id');
    }


}
