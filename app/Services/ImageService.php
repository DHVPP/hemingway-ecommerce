<?php


namespace App\Services;


/**
 * Class ImageService
 * @package App\Services
 */
class ImageService
{
    const
        IMAGE_TYPE_PRODUCT = 1,
        IMAGE_TYPE_POST = 2;

    /**
     * @var string[]
     */
    protected static $path = [
        self::IMAGE_TYPE_PRODUCT => 'images/products/',
        self::IMAGE_TYPE_POST => 'images/posts/'
    ];

    /**
     * @param $image
     * @param int $type
     * @return string
     */
    public static function saveImage($image, int $type): string
    {
        $format = $image->getClientOriginalExtension();
        $imageName = self::generateNameOfImage($format);
        $image->move(public_path(self::$path[$type]), $imageName);
        return self::$path[$type] . $imageName;
    }

    /**
     * @param string $format
     * @return string
     */
    protected static function generateNameOfImage(string $format = 'jpg'): string
    {
        return time() . '.' . $format;
    }
}
