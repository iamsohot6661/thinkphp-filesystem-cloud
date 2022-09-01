<?php
declare(strict_types=1);
namespace thans\filesystem\driver;

use League\Flysystem\AdapterInterface;
use thans\filesystem\traits\Storage;
use think\filesystem\Driver;
use League\Flysystem\Filesystem;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Aws\S3\S3Client;

class Wasabi extends Driver{


    protected function createAdapter(): AdapterInterface
    {
        $conf = [
            'endpoint' => "https://" . $this->config['bucket'] . ".s3." . $this->config['region'] . ".wasabisys.com/",
            'bucket_endpoint' => true,
            'credentials' => [
                'key' => $this->config['key'],
                'secret' => $this->config['secret'],
            ],
            'region' => $this->config['region'],
            'version' => 'latest',
        ];
        $client = new S3Client($conf);
        $adapter = new AwsS3Adapter($client, $this->config['bucket'], $this->config['root']);
        return $adapter;
    }

    public function getUrl(string $path)
    {
        echo $path;exit;
        if (strpos($path, '/') === 0) {
            return $path;
        }

        return isset($this->config['endpoint']) && $this->config['endpoint'] ? $this->config['endpoint'].DIRECTORY_SEPARATOR.$path
            : $path;
    }

}