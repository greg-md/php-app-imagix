<?php

namespace Greg\AppImagix;

use Greg\AppImagix\Decorators\BaseDecorator;
use Greg\AppInstaller\Application;
use Greg\Framework\ServiceProvider;
use Greg\Imagix\Imagix;
use Greg\Support\Dir;
use Intervention\Image\ImageManager;
use PHPUnit\Framework\TestCase;

class ImagixServiceProviderTest extends TestCase
{
    private $rootPath = __DIR__ . '/app';

    protected function setUp()
    {
        Dir::make($this->rootPath);

        Dir::make($this->rootPath . '/app');
        Dir::make($this->rootPath . '/build-deploy');
        Dir::make($this->rootPath . '/config');
        Dir::make($this->rootPath . '/public');
        Dir::make($this->rootPath . '/resources');
        Dir::make($this->rootPath . '/storage');
    }

    protected function tearDown()
    {
        Dir::unlink($this->rootPath);
    }

    public function testCanInstantiate()
    {
        $serviceProvider = new ImagixServiceProvider();

        $this->assertInstanceOf(ServiceProvider::class, $serviceProvider);
    }

    public function testCanGetName()
    {
        $serviceProvider = new ImagixServiceProvider();

        $this->assertEquals('greg-imagix', $serviceProvider->name());
    }

    public function testCanBoot()
    {
        $serviceProvider = new ImagixServiceProvider();

        $app = new Application([
            'imagix' => [
                'source_path' => __DIR__ . '/../public',

                'destination_path' => __DIR__ . '/../public/imagix',

                'base_uri' => '/imagix',
            ],
        ]);

        $serviceProvider->boot($app);

        /** @var Imagix $imagix */
        $imagix = $app->get(Imagix::class);

        $this->assertInstanceOf(Imagix::class, $imagix);

        $this->assertInstanceOf(ImageManager::class, $imagix->manager());

        $this->assertEquals(realpath($app->config('imagix.source_path')), $imagix->sourcePath());

        $this->assertEquals(realpath($app->config('imagix.destination_path')), $imagix->destinationPath());

        $this->assertInstanceOf(BaseDecorator::class, $imagix->decorator());
    }

    public function testCanInstall()
    {
        $serviceProvider = new ImagixServiceProvider();

        $app = new Application();

        $app->configure(__DIR__ . '/app');

        $serviceProvider->install($app);

        $this->assertFileExists(__DIR__ . '/app/config/imagix.php');

        $this->assertDirectoryExists(__DIR__ . '/app/public/imagix');

        $this->assertFileExists(__DIR__ . '/app/public/imagix.php');
    }

    public function testCanUninstall()
    {
        $serviceProvider = new ImagixServiceProvider();

        $app = new Application();

        $app->configure(__DIR__ . '/app');

        file_put_contents(__DIR__ . '/app/config/imagix.php', '');

        Dir::make(__DIR__ . '/app/public/imagix');

        file_put_contents(__DIR__ . '/app/public/imagix.php', '');

        $serviceProvider->uninstall($app);

        $this->assertFileNotExists(__DIR__ . '/app/config/imagix.php');

        $this->assertDirectoryNotExists(__DIR__ . '/app/public/imagix');

        $this->assertFileNotExists(__DIR__ . '/app/public/imagix.php');
    }
}
