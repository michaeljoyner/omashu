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
        $counter = 0;
        $this->attributes['name'] = $name;
        if($this->where('slug', Str::slug($name))->count() > 0) {
            $counter += 1;
            while($this->where('slug', Str::slug($name.$counter))->count() > 0) {
                $counter += 1;
            }
            $this->attributes['slug'] = Str::slug($name.$counter);
        } else {
            $this->attributes['slug'] = Str::slug($name);
        }

    }

}