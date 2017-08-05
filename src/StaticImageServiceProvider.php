<?php

namespace Greg\AppStaticImage;

use Greg\AppInstaller\Application;
use Greg\AppInstaller\Events\ConfigAddEvent;
use Greg\AppInstaller\Events\ConfigRemoveEvent;
use Greg\AppInstaller\Events\PublicAddEvent;
use Greg\AppInstaller\Events\PublicRemoveEvent;
use Greg\AppStaticImage\Decorators\BaseDecorator;
use Greg\AppStaticImage\Events\LoadStaticImageManagerEvent;
use Greg\Framework\ServiceProvider;
use Greg\StaticImage\StaticImageManager;
use Intervention\Image\ImageManager;

class StaticImageServiceProvider implements ServiceProvider
{
    private const CONFIG_NAME = 'staticImage';

    private const STATIC_NAME = 'static';

    private const IMAGE_NAME = 'image.php';

    private $app;

    public function name(): string
    {
        return 'greg-static-image';
    }

    public function boot(Application $app)
    {
        $this->app = $app;
    }

    public function bootHttpKernel(Application $app)
    {
        $app->inject(StaticImageManager::class, function () use ($app) {
            $manager = new StaticImageManager(
                new ImageManager(),
                $this->config('sourcePath'),
                $this->config('destinationPath'),
                new BaseDecorator($this->config('uriPath'))
            );

            $app->event(new LoadStaticImageManagerEvent($manager));

            return $manager;
        });
    }

    public function install(Application $app)
    {
        $app->event(new ConfigAddEvent(__DIR__ . '/../config/config.php', self::CONFIG_NAME));

        $app->event(new PublicAddEvent(__DIR__ . '/../public/static', self::STATIC_NAME));

        $app->event(new PublicAddEvent(__DIR__ . '/../public/image.php', self::IMAGE_NAME));
    }

    public function uninstall(Application $app)
    {
        $app->event(new ConfigRemoveEvent(self::CONFIG_NAME));

        $app->event(new PublicRemoveEvent(self::STATIC_NAME));

        $app->event(new PublicRemoveEvent(self::IMAGE_NAME));
    }

    private function config($name)
    {
        return $this->app()->config(self::CONFIG_NAME . '.' . $name);
    }

    private function app(): Application
    {
        return $this->app;
    }
}
