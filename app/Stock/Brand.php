<?php namespace Omashu\Stock;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Brand extends Model implements HasMediaConversions, SluggableInterface
{

    use SluggableTrait, HasCoverPicTrait, UsesAbsoluteUrlsTrait, HasMediaTrait;

    protected $table = 'brands';

    protected $fillable = [
        'name',
        'slug',
        'website',
        'image_path',
        'tagline',
        'zh_tagline',
        'description',
        'location'
    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    public function setWebsiteAttribute($website)
    {
        $this->attributes['website'] = $this->makeAbsoluteUrl($website);
    }

    public function categories()
    {
        return $this->hasMany('Omashu\Stock\Category', 'brand_id');
    }

    public function addCategory($attributes)
    {
        return $this->categories()->create($attributes);
    }


}
