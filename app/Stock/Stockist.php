<?php namespace Omashu\Stock;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Stockist extends Model implements HasMediaConversions
{

    use SetsSlugFromNameTrait, HasCoverPicTrait, UsesAbsoluteUrlsTrait, HasMediaTrait;

    protected $table = 'stockists';

    protected $fillable = [
        'name',
        'slug',
        'address',
        'zh_address',
        'phone',
        'website',
        'image_path'
    ];

    public function setWebsiteAttribute($website)
    {
        $this->attributes['website'] = $this->makeAbsoluteUrl($website);
    }

}
