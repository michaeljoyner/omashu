<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/6/15
 * Time: 3:35 PM
 */

namespace Omashu\Stock;


use Illuminate\Support\Str;

trait SetsSlugFromNameTrait {

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

}