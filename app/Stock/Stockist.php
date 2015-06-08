<?php namespace Omashu\Stock;

use Illuminate\Database\Eloquent\Model;

class Stockist extends Model {

    use SetsSlugFromNameTrait;

	protected $table = 'stockists';

    protected $fillable = [
        'name',
        'slug',
        'address',
        'phone',
        'website',
        'image_path'
    ];

}
