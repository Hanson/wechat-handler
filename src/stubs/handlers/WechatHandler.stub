<?php
/**
 * Created by PhpStorm.
 * User: Hanson
 * Date: 2016/7/24
 * Time: 22:28
 */

namespace {{namespace}}Handlers;


class WechatHandler implements HandlerInterface
{

    public static function run($message)
    {
        $handler = '{{namespace}}Handlers\\' . ucfirst($message->MsgType) . 'Handler';

        return call_user_func_array([$handler, 'run'], [$message]);
    }
}