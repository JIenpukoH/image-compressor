<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.09.2018
 * Time: 15:19
 */

namespace JIenpukoH\ImageResizer;


use JIenpukoH\ImageResizer\Interfaces\Resizable;

class Example implements Resizable
{

    use Resizer;
    public function getImage()
    {
        $src = 'images/upload/myphoto.jpg';

        return $this->getImageUrl($src,200,300,false);
    }

    public function getRootDir(){
        return '/src/www/image-resizer/htdocs';
    }
}