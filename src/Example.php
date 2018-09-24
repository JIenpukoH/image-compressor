<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.09.2018
 * Time: 15:19
 */

namespace JIenpukoH\ImageCompressor;




use JIenpukoH\ImageCompressor\Compressor\ImageCompressor;

class Example
{
    public function compress()
    {
        $src = 'images/upload/myphoto.jpg';
        $compressor = new ImageCompressor();
        $compressor->compress($this->getRootDir().'/'.$src);
        $path = pathinfo($src);
        return $compressor->getOptimized($path['dirname'],$path['basename']);
    }

    public function getRootDir(){
        return '/src/www/image-resizer/htdocs';
    }
}