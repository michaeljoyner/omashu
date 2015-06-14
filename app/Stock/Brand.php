<?php namespace Omashu\Stock;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

    use SetsSlugFromNameTrait, HasImageTrait, UsesAbsoluteUrlsTrait;

	protected $table = 'brands';

    protected $fillable = [
        'name',
        'slug',
        'website',
        'image_path',
        'tagline',
        'zh_tagline',
        'description',
    ];

    public function setWebsiteAttribute($website)
    {
        $this->attributes['website'] = $this->makeAbsoluteUrl($website);
    }

    public function categories()
    {
        return $this->hasMany('Omashu\Stock\Category', 'brand_id');
    }


}
