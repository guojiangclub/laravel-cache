<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-01-05
 * Time: 14:58
 */

if (!function_exists('collect_cache')) {

    /**
     * Get / set the specified cache value.
     *
     * If an array is passed, we'll assume you want to put to the cache.
     *
     * @param  dynamic  key|key,default|data,expiration|null
     * @return mixed
     *
     * @throws \Exception
     */
    function collect_cache()
    {
        $arguments = func_get_args();

        if (empty($arguments)) {
            return app(\iBrand\Cache\CollectCacheRepository::class);
        }

        if (is_string($arguments[0])) {
            return app(\iBrand\Cache\CollectCacheRepository::class)->get($arguments[0], isset($arguments[1]) ? $arguments[1] : null);
        }

        if (is_array($arguments[0])) {
            if (!isset($arguments[1]) OR !isset($arguments[2])) {
                throw new Exception(
                    'You must set an expiration time when putting to the cache.'
                );
            }

            return app(\iBrand\Cache\CollectCacheRepository::class)->put($arguments[1], key($arguments[0]), reset($arguments[0]), $arguments[2]);
        }

        return null;
    }
}

if (!function_exists('empty_collect_cache')) {

    /**
     * Get / set the specified cache value.
     *
     * If an array is passed, we'll assume you want to put to the cache.
     *
     * @param  dynamic  key|key,default|data,expiration|null
     * @return mixed
     *
     * @throws \Exception
     */
    function empty_collect_cache()
    {
        $arguments = func_get_args();

        if (empty($arguments)) {
            return app(\iBrand\Cache\CollectCacheRepository::class);
        }

        if (is_string($arguments[0])) {

            return app(\iBrand\Cache\CollectCacheRepository::class)->get($arguments[0], isset($arguments[1]) ? $arguments[1] : null);

        }

        if (is_array($arguments[0])) {

            if (!isset($arguments[1]) OR !isset($arguments[2])) {
                throw new Exception(
                    'You must set an expiration time when putting to the cache.'
                );
            }

            if (reset($arguments[0])) {
                return app(\iBrand\Cache\CollectCacheRepository::class)->put($arguments[1], key($arguments[0]), reset($arguments[0]), $arguments[2]);
            }

            return app(\iBrand\Cache\CollectCacheRepository::class)->put($arguments[1], key($arguments[0]), '', $arguments[2]);
        }

        return false;
    }
}