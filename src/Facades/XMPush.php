<?php

/**
 * Created by PhpStorm.
 * User: NHXuan
 * Date: 2017/8/17
 * Time: 18:38
 */

namespace Wzj\Push\Facades;

use Illuminate\Support\Facades\Facade;

class XMPush extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'xmpush';
    }
}