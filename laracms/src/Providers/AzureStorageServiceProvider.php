<?php
namespace Wanglelecc\Laracms\Providers;

use Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use Wanglelecc\Laracms\Adapter\AzureBlobStorageAdapter;

class AzureStorageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('azure', function ($app, $config) {
            $client = BlobRestProxy::createBlobService('DefaultEndpointsProtocol=https;AccountName='.$config['name'].';AccountKey='.$config['key'].';');
            $adapter = new AzureBlobStorageAdapter($client, $config['container']);
            $filesystem = new Filesystem($adapter);

            return $filesystem;
        });
    }

    /**
     * 在容器中注册绑定。
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
