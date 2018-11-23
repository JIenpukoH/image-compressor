# image-compressor
Image compression with Convert@ImageMagick

```
class Example
{
    public function compress()
    {
        $src = '/images/upload/myphoto.jpg';
        $compressor = new ImageCompressor();
        $compressor->compress($this->getRootDir());
        $path = pathinfo($src);
        $compressed_name = $compressor->getOptimized($path['dirname'],$path['basename']);
        if($compressor->optimizedExist($compressed_name)){
            return $compressed_name;
        }
        return $src;
    }
    public function getRootDir(){
        return '/src/www/image-compressor/htdocs';
    }
}
```
