<?php namespace Omashu\Stock;

use Illuminate\Database\Eloquent\Model;

class Stockist extends Model {

    use SetsSlugFromNameTrait, HasImageTrait, UsesAbsoluteUrlsTrait;

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
