# wechat-handler
A package to create some base handler for wechat events faster!
帮你更快地生成微信事件文件

## 依赖

laravel 5+ (lumen 请看 [wechat](https://github.com/HanSon/wechat))

EasyWechat 3+

## 安装

```
composer require composer require hanson/wechat-handler
```

## 使用

在`config/app.php`的provider尾部加上

```

    App\Providers\EventServiceProvider::class,
    
    App\Providers\RouteServiceProvider::class,
    # 加上
    Hanson\Wechat\Handler\WechatHandlerServiceProvider::class,
```

然后执行```php artisan make:handler```

接下来会生成若干文件

`app\Handler`目录，负责处理所有的微信事件

`app\Http\Controllers\Wechat`为微信的controller

`config\wechat.php` 微信的配置（自行选择是否使用）

## 文档

### Handler
所有消息事件都位于`app/Handlers`中，事件Handler位于`app/Handlers/EventHandlers`中


### Service
所有的服务事件，直接在继承BaseController 的 Controller中 调用 $this->service即可

    #example:
    class MyController extends BaseController{
    
        public function index(){
            $user = $this->user;
            echo $user->get('openid')->nickname;
        }
    }
