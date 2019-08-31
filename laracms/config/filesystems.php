<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
			'url' => env('AWS_URL'),
        ],

        'aliyun' => [
            'driver'            => 'aliyun',
            'access_key_id'     => env('ALIYUN_ACCESS_KEY_ID','your id'),
            'access_key_secret' => env('ALIYUN_ACCESS_KEY_SECRET','your key'),
            'oss_bucket'        => env('ALIYUN_OSS_BUCKET','your bucket'),
            'oss_endpoint'      => env('ALIYUN_OSS_ENDPOINT',''), // 生成环境若使用的阿里云服务，可配置内网地址，上传速度更快
            'oss_prefix'        => env('ALIYUN_OSS_PREFIX', ''), // optional
            'oss_url'           => env('ALIYUN_OSS_URL', ''), // optional //  https://<bucket>.<endpoint>/<filename>
            
            'vod_region_id'     => env('ALIYUN_VOD_REGION_ID', ''),
            'vod_upload_url'    => env('ALIYUN_VOD_URLOAD_URL', ''),
        ],

        'azure' => [
            'driver'    => 'azure',
            'name'      => env('AZURE_STORAGE_NAME', 'azure storage name'),
            'key'       => env('AZURE_STORAGE_KEY', 'azure storage key'),
            'container' => env('AZURE_STORAGE_CONTAINER', 'azure storage container'),
            // $url = 'https://' . config('filesystems.disks.azure.name'). '.blob.core.windows.net/' . config('filesystems.disks.azure.container') . '/' . $filename;
        ],

    ],
    
    // 配置的允许大小不能超过 PHP.ini 限制. 默认PHP POST 请求允许最大8MB，File Upload 最大 2MB
    'uploader' => [
        
        'folder' => ['avatar', 'article', 'blog', 'page', 'website', 'slide', 'link', 'video', 'annex', 'voice', 'navigation'],
        
        // 图片
        'image' => [
            'size_limit' => 5242880, // 单位：字节，默认：5MB
            'allowed_ext' => ["png", "jpg", "gif", 'jpeg', 'bmp'],
        ],
        
        // 附件
        'annex' => [
            'size_limit' => 204857600000, // 单位：字节，默认：5MB (5242880 B)  // 104857600
            'allowed_ext' => ['zip','rar','7z','gz'],
        ],
        
        // 文件
        'file' => [
            'size_limit' => 5242880, // 单位：字节，默认：5MB
            'allowed_ext' => ['pdf','doc','docx','xls','xlsx','ppt','pptx'],
        ],
        
        // 音频
        'voice' => [
            'size_limit' => 5242880, // 单位：字节，默认：5MB
            'allowed_ext' => ['mp3','wmv'],
        ],
        
        // 视频
        'video' => [
            'size_limit' => 5242880, // 单位：字节，默认：5MB
            'allowed_ext' => ['mp4'],
        ],

        // Ueditor 配置
        'ueditor' => [
            "imageActionName" => "uploadimage",
            "imageFieldName" => "upload_file",
            "imageMaxSize" => 5242880,
            "imageAllowFiles" => [".png", ".jpg", ".jpeg", ".gif", ".bmp"],
            "imageCompressEnable" => true,
            "imageCompressBorder" => 1600,
            "imageInsertAlign" => "none",
            "imageUrlPrefix" => "",
            "imagePathFormat" => "",
            "imageManagerUrlPrefix" => "",

            "imageManagerActionName" => "listimage",
            "imageManagerListSize" => 20,
            "fileManagerListSize" => 20,

            "snapscreenActionName" => "uploadimage",
            "snapscreenInsertAlign" => "none",
            "snapscreenUrlPrefix" => "",
            "snapscreenPathFormat" => "",

            "videoActionName" => "uploadvideo",
            "videoFieldName" => "upload_file",
            "videoMaxSize" => 5242880,
            "videoAllowFiles" => [".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg", ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid"],
            "videoUrlPrefix" => "",
            "videoPathFormat" => "",
    
            "catcherLocalDomain" =>  ["127.0.0.1", "localhost", "img.baidu.com"],
            "catcherActionName" => "catchimage",
            "catcherFieldName" =>  "source",
            "catcherUrlPrefix" =>  "",
            "catcherMaxSize" =>  2048000,
            "catcherAllowFiles" =>  [".png", ".jpg", ".jpeg", ".gif", ".bmp"],
        ],
        
    ],

];
