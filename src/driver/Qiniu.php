<?php

namespace iamsohot\filesystem\driver;

use League\Flysystem\AdapterInterface;
use Liz\Flysystem\QiNiu\QiNiuOssAdapter;
use iamsohot\filesystem\traits\Storage;
use think\filesystem\Driver;

class Qiniu extends Driver
{
    use Storage;

    protected function createAdapter(): AdapterInterface
    {
        $qiniu = new QiNiuOssAdapter($this->config['accessKey'], $this->config['secretKey'],
            $this->config['bucket'], $this->config['url']);

        return $qiniu;
    }
}
