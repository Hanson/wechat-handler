<?php

namespace Hanson\Wechat\Handler;

use Illuminate\Console\Command;
use Illuminate\Console\AppNamespaceDetectorTrait;

class MakeCoreCommand extends Command
{
    use AppNamespaceDetectorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:handler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create handler/controller/config for easyWechat';

    /**
     * The handlers that need to be exported.
     *
     * @var array
     */
    protected $handlers = [
        'EventHandler.stub' => 'EventHandler.php',
        'HandlerInterface.stub' => 'HandlerInterface.php',
        'ImageHandler.stub' => 'ImageHandler.php',
        'LinkHandler.stub' => 'LinkHandler.php',
        'LocationHandler.stub' => 'LocationHandler.php',
        'ShortVideoHandler.stub' => 'ShortVideoHandler.php',
        'VideoHandler.stub' => 'VideoHandler.php',
        'TextHandler.stub' => 'TextHandler.php',
        'VoiceHandler.stub' => 'VoiceHandler.php',
        'WechatHandler.stub' => 'WechatHandler.php',
        'events/LocationHandler.stub' => 'EventHandlers/LocationHandler.php',
        'events/ScanHandler.stub' => 'EventHandlers/ScanHandler.php',
        'events/SubscribeHandler.stub' => 'EventHandlers/SubscribeHandler.php',
        'events/UnSubscribeHandler.stub' => 'EventHandlers/UnSubscribeHandler.php',
        'events/ViewHandler.stub' => 'EventHandlers/ViewHandler.php',
        'events/ClickHandler.stub' => 'EventHandlers/ClickHandler.php',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->createDirectories();

        $this->createHandlers();

        $this->createConfig();

        $this->makeControllers('HomeController');
        $this->makeControllers('BaseController');
    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function createDirectories()
    {
        if (! is_dir(app_path('Handlers'))) {
            mkdir(app_path('Handlers'), 0755, true);
        }

        if (! is_dir(app_path('Handlers/EventHandlers'))) {
            mkdir(app_path('Handlers/EventHandlers'), 0755, true);
        }

        if (! is_dir(app_path('Http/Controllers/Wechat'))) {
            mkdir(app_path('Http/Controllers/Wechat'), 0755, true);
        }
    }

    protected function createHandlers()
    {
        foreach ($this->handlers as $key => $handler) {
            $path = app_path('Handlers/'.$handler);

            $this->line('<info>Created Handler:</info> '.$path);

            copy(__DIR__.'/stubs/handlers/'.$key, $path);
        }
    }

    protected function createConfig()
    {
        $path = config_path('wechat.php');

        copy(__DIR__.'/stubs/wechat.stub', $path);
    }

    protected function makeControllers($controller)
    {
        file_put_contents(
            app_path('Http/Controllers/Wechat/'.$controller.'.php'),
            $this->compileControllerStub($controller)
        );
    }

    protected function compileControllerStub($controller)
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__.'/stubs/controller/'.$controller.'.stub')
        );
    }

}