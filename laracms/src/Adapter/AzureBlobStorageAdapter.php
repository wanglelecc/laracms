<?php

namespace Wanglelecc\Laracms\Adapter;

use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter as AzureBlobStorageAdapterBase;
use Illuminate\Support\Facades\Storage;

class AzureBlobStorageAdapter extends AzureBlobStorageAdapterBase{
    
    /**
     * 扩展 Azure 公共文件访问 URL, 兼容 Storage::url();
     *
     * @param $path
     *
     * @return string
     */
    public function getUrl($path)
    {
        $url = 'https://' . config('filesystems.disks.azure.name'). '.blob.core.windows.net/' . config('filesystems.disks.azure.container') . '/' . $path;
        
        return $url;
    }
}