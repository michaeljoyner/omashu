<?php namespace Omashu\Stock;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Product extends Model implements HasMediaConversions, SluggableInterface
{

    use SluggableTrait, HasCoverPicTrait, HasMediaTrait, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'zh_name',
        'quantifier',
        'zh_quantifier',
        'description',
        'is_available',
        'image_path',
        'price',
        'write_up'
    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    protected $dates = ['deleted_at'];




    public function setAvailability($isAvailable)
    {
        $this->is_available = $isAvailable;
        $this->save();

        return $this->is_available;
    }

    public function setPriceAttribute($price)
    {
        $this->attributes['price'] = $price * 100;
    }

    public function getPriceAttribute($price)
    {
        return intval($price / 100);
    }

}
