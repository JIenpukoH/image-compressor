<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.09.2018
 * Time: 11:11
 */

namespace JIenpukoH\ImageCompressor\Compressor;


use JIenpukoH\ImageCompressor\Command;

class ImageCompressor
{
    public $optimized_dir = 'optimized';

    /**
     * @param $filename
     * $filename should be with absolute path
     * @param int $quality
     * @param bool $move
     * @throws \Exception
     */
    public function compress($filename, $quality = 85, $move = true)
    {
        $path = pathinfo($filename);
        if (!isset($path['extension'])) {
            throw new \Exception('File Extension not found');
        }
        $extension = $path['extension'];
        $dirname = $path['dirname'];
        $name = $path['filename'];

        if (mb_strtolower($extension, 'UTF-8') == 'jpg') {
            if ($move) {
                $dest_dir = $dirname . '/' . $this->optimized_dir;
                if (!is_dir($dest_dir)) {
                    mkdir($dest_dir);
                }
            } else {
                $dest_dir = $dirname;
            }
            $output_file = $this->getOutputName($dest_dir, $name, $quality, $extension);

            $options = [
                '' . $filename,
                '-sampling-factor 4:2:0',
                '-strip',
                '-quality ' . $quality,
                '-interlace JPEG',
                '' . $output_file
            ];

            try {
                $command = new Command('convert', $options);
                $command->execute();
            } catch (\Exception $e) {

            }
        }
    }

    public function optimizedExist($filename, $quality = 85)
    {
        $path = pathinfo($filename);
        $dest_dir = $path['dirname'] . '/' . $this->optimized_dir;
        return file_exists($this->getOutputName($dest_dir, $path['filename'], $quality, $path['extension']));
    }

    public function getOptimized($dirname, $filename, $quality = 85)
    {
        $path = pathinfo($filename);
        $dest_dir = $dirname . '/' . $this->getOptimizedDir();
        return $this->getOutputName($dest_dir, $path['filename'], $quality, $path['extension']);
    }

    public function getOptimizedDir()
    {
        return $this->optimized_dir;
    }

    /**
     * @param $quality
     * @param $dest_dir
     * @param $name
     * @param $extension
     * @return string
     */
    public function getOutputName($dest_dir, $name, $quality, $extension)
    {
        return $dest_dir . '/' . $name . '-q-' . $quality . '.' . $extension;
    }

}