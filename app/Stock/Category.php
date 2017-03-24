<?php namespace Omashu\Stock;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Category extends Model implements HasMediaConversions
{

    use Sluggable, HasCoverPicTrait, HasMediaTrait;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'zh_name',
        'slug',
        'description',
        'image_path'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function products()
    {
        return $this->hasMany('Omashu\Stock\Product', 'category_id');
    }

    public function addProduct($attributes)
    {
        return $this->products()->create($attributes);
    }

}
