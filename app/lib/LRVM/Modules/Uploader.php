<?php

namespace LRVM\Modules;

use Aws\AwsClient;
use Aws\S3\S3Client;

class Uploader {

    /**
     * Bucket in which to place the file
     *
     * @var string $bucket
     */
    protected $bucket;

    /**
     * Name to be used as remote file key
     *
     * @var string $filename
     */
    protected $filename;

    /**
     * Path to the temp location of the file
     *
     * @var string $path
     */
    protected $path;

    /**
     * Policy, if any, for access
     *
     * @var string $policy
     */
    protected $policy;

    /**
     * Construct with properties for upload
     *
     * @param $bucket
     * @param $filename
     * @param $path
     * @param null $policy
     */
    public function __construct($bucket, $filename, $path, $policy = NULL) {

        $this->bucket = $bucket;
        $this->filename = $filename;
        $this->path = $path;
        $this->policy = $policy;

    }

    public function doUpload() {

        $s3 = new S3Client([
            'credentials' => [
                'key' => $_ENV['S3_PUB_KEY'],
                'secret' => $_ENV['S3_PRIVATE_KEY']
            ],
            'version' => 'latest',
            'region' => 'us-west-1',
        ]);

        $data = [
            'Bucket'    => $this->bucket,
            'Key'       => $this->filename,
            'SourceFile' => $this->path,
        ];
        if ($this->policy)
            $data['ACL'] = $this->policy;

        $result = $s3->putObject($data);

        $s3->waitUntil('ObjectExists', [
            'Bucket' => $this->bucket,
            'Key'   => $this->filename
        ]);

        return $result;


    }

}