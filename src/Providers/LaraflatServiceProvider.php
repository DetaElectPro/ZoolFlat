<?php

namespace Zoolflat\Zoolflat\Providers;


use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Zoolflat\Zoolflat\Zoolflat\Commands\AdminAddEditCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\AdminControllerCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\AdminFormCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\AdminIndexCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\AdminRelationCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\AdminRequestCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\AdminRouteCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\ApiControllerCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\ApiRequestCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\ApiResourcesCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\ApiRouteCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\ConfigCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\FrontAddEditCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\FrontControllerCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\FrontFormCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\FrontIndexCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\FrontRequestCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\FrontRouteCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\InstallCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\LangCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\MigrationCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\ModelCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\SeederCommand;
use Zoolflat\Zoolflat\Zoolflat\Commands\ServiceProviderCommand;
use Zoolflat\Zoolflat\Zoolflat\Traits\FileTrait;


class ZoolflatServiceProvider extends ServiceProvider
{

    use FileTrait;

    protected $DS = DIRECTORY_SEPARATOR;

    /**
     * Bootstrap services.
     *
     * @return void
     */

    public function boot()
    {

        $modulePath = app_path('Modules');

        $this->createFolder($modulePath);

        $location = __DIR__.$this->DS.'../Resources'.$this->DS.'Modules'.$this->DS.'Users.zip';

        $destination = app_path('Modules');

        $zip = new Zipper();

        $zip->zip($location)->extractTo($destination);

        /*
         * change the auth to Zoolflat auth
         */

        $this->publishes([
            __DIR__ . '/../Resources/config' => base_path('config'),
        ], 'Zoolflat');


        /*
         * publish Admin panel Style
         * first put all js and css in public folder
         */

        $this->publishes([
            __DIR__ . '/../Resources/assets' => public_path('assets'),
        ], 'Zoolflat');

        /*
         * copy All users files to modules
         */

        $this->publishes([
            __DIR__ . '/../Resources/Modules' => $modulePath,
        ], 'Zoolflat');


        /*
         * load Zoolflat language files
         */

        $this->loadTranslationsFrom(__DIR__ . '/../Zoolflat/lang', 'Zoolflat');

        /*
         * load Zoolflat migrations files
         */

        $this->loadMigrationsFrom(__DIR__ . '/../Zoolflat/migrations');

        /*
         * load Zoolflat routes
         * generators routes
         */

        $this->loadRoutesFrom(__DIR__ . '/../Zoolflat/routes/admin.php');

        /*
         * loads Zoolflat files
         * generators views
         */

        $this->loadViewsFrom(__DIR__ . '/../Zoolflat/views', 'Zoolflat');

        /*
       * load all Providers
       */

        $this->loadProviders();

        /*
         * register command
         */

        $this->commands([
            MigrationCommand::class,
            ServiceProviderCommand::class,
            AdminRouteCommand::class,
            ModelCommand::class,
            AdminIndexCommand::class,
            AdminAddEditCommand::class,
            AdminControllerCommand::class,
            AdminFormCommand::class,
            AdminRequestCommand::class,
            ConfigCommand::class,
            SeederCommand::class,
            InstallCommand::class,
            LangCommand::class,
            ApiResourcesCommand::class,
            ApiRouteCommand::class,
            ApiControllerCommand::class,
            ApiRequestCommand::class,
            FrontRouteCommand::class,
            FrontIndexCommand::class,
            FrontAddEditCommand::class,
            FrontControllerCommand::class,
            FrontFormCommand::class,
            FrontRequestCommand::class
        ]);

    }

    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {

        /*
         * register helpers files
         */

        $this->registerHelpers('arrays');
        $this->registerHelpers('path');
        $this->registerHelpers('crud');
        $this->registerHelpers('lang');
        $this->registerHelpers('function');

    }

    /**
     * load helpers.
     *
     * @return void
     */

    public function registerHelpers($file)
    {
        // Load the helpers in app/Http/helpers.php
        if (file_exists($file = __DIR__ . '/../Zoolflat/Helpers/' . $file . '.php')) {
            require $file;
        }
    }


    /*
     * load All Providers
     * that will generated with Zoolflat
     */

    public function loadProviders()
    {

        $path = base_path('app' . $this->DS . 'Modules');

        if (is_dir($path)) {

            $directories = File::directories($path);

            if (!empty($directories)) {

                foreach ($directories as $directory) {

                    $moduleName = explode($this->DS, $directory);

                    $moduleName = end($moduleName);

                    $fullProviderPath = $directory . $this->DS . 'Providers' . $this->DS . 'Zoolflat' . $moduleName . 'ServicesProvider.php';

                    if (file_exists($fullProviderPath)) {

                        $nameSpace = 'App\\Modules\\' . $moduleName . '\\Providers\\' . 'Zoolflat' . $moduleName . 'ServicesProvider';

                        app()->register($nameSpace);

                    }
                }
            }
        }

    }


}
