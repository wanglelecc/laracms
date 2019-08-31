<?php

namespace Wanglelecc\Laracms\Providers;

use Storage;
use OSS\OssClient;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use ApolloPY\Flysystem\AliyunOss\Plugins\PutFile;
use ApolloPY\Flysystem\AliyunOss\Plugins\SignedDownloadUrl;
use Wanglelecc\Laracms\Adapter\AliyunOssAdapter;

/**
 * Aliyun Oss ServiceProvider class.
 *
 * @author  ApolloPY <ApolloPY@Gmail.com>
 */
class AliyunOssServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('aliyun', function ($app, $config) {
            $accessKeyId = $config['access_key_id'];
            $accessKeySecret = $config['access_key_secret'];
            $endPoint = $config['oss_endpoint'];
            $bucket = $config['oss_bucket'];
            
            $prefix = null;
            if (isset($config['oss_prefix'])) {
                $prefix = $config['oss_prefix'];
            }
            
            $client = new OssClient($accessKeyId, $accessKeySecret, $endPoint);
            $adapter = new AliyunOssAdapter($client, $bucket, $prefix);
            
            $filesystem = new Filesystem($adapter);
            $filesystem->addPlugin(new PutFile());
            $filesystem->addPlugin(new SignedDownloadUrl());
            
            return $filesystem;
        });
    }
    
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
