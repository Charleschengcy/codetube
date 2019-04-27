<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Storage;
use App\Models\channel;

use File;

class Uploadimage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $channel;
    public $fileId;

    public function __construct(channel $channel, $fileId)
    {
        //初始化
        $this->channel = $channel;
        $this->fileId = $fileId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //读取图片文件
        //截取图片文件
        //上传到S3服务器
        //删除临时文件
        //更新频道图片
        $path = storage_path() . '/uploads/' . $this->fileId;
        $fileName = $this->fileId. '.png';

        // Storage::disk('s3images')->put('profile/' . $fileName, fopen($path, 'r+'));
        if(Storage::disk('s3images')->put('profile/' . $fileName, fopen($path, 'r+')))
        {
            File::delete($path);
        }

        $this->channel->image_filename = $fileName;
        $this->channel->save();
    }
}
