<?php
/**
 * Created by PhpStorm.
 * User: Hanson
 * Date: 2016/8/4
 * Time: 21:10
 */

namespace Hanson\Wechat\Handler;

use Illuminate\Support\ServiceProvider;

class WechatHandlerServiceProvider extends ServiceProvider
{

    protected $commands = [
        'Hanson\Wechat\Handler\MakeCoreCommand'
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}