<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-01-05
 * Time: 14:41
 */

namespace iBrand\Cache;


use Illuminate\Support\Collection;

class CollectCacheRepository
{
    public function get($key, $collectKey)
    {
        $value = \Cache::get($key);

        if(is_null($value) OR is_null($collectKey)){
            return null;
        }

        if ($value instanceof Collection) {
            return $value->get($collectKey);
        }

        return null;
    }


    public function put($key, $collectKey, $collectValue, $minutes)
    {
        $value = \Cache::get($key, collect());

        $value->put($collectKey, $collectValue);

        \Cache::put($key, $value, $minutes);

    }
}