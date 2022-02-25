<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace KY\DragVerifier;

use GdImage;

class DragVerifier
{
    /**
     * @param GdImage $image 原图
     * @param GdImage $fillImage 被填充到原图的滑块图
     * @param GdImage $hollowedImage 被填充到原图的滑块图的镂空图
     * @param int $color
     */
    public function __construct(
        protected GdImage $image,
        protected GdImage $fillImage,
        protected GdImage $hollowedImage,
        protected int     $color = 65280,
    )
    {
    }

    public function generate(): DragCode
    {
        $bgX = imagesx($this->image);
        $bgY = imagesy($this->image);
        $smX = imagesx($this->fillImage);
        $smY = imagesy($this->fillImage);

        $x = rand(5, ($bgX - $smX - 5));
        $y = rand(5, ($bgY - $smY - 5));

        $background = imagecreatetruecolor($bgX, $bgY);
        imagecopy($background, $this->image, 0, 0, 0, 0, $bgX, $bgY);
        imagecopy($background, $this->fillImage, $x, $y, 0, 0, $smX, $smY);
        var_dump($smX, $smY);

        $smX = imagesx($this->hollowedImage);
        $smY = imagesy($this->hollowedImage);

        $bg = imagecreatetruecolor($bgX, $bgY);

        imagecopy($bg, $this->image, 0, 0, 0, 0, $bgX, $bgY);
        imagecopy($bg, $this->hollowedImage, $x, $y, 0, 0, $smX, $smY);

        $imgCrop = imagecrop($bg, ['x' => $x, 'y' => $y, 'width' => $smX, 'height' => $smY]);

        imagealphablending($imgCrop, true);
        imagecolortransparent($imgCrop, $this->color);
        imagesavealpha($imgCrop, false);

        return new DragCode($background, $imgCrop, $x, $y);
    }

    public function save(DragCode $code, string $path): bool
    {
        $bg = $path . '_bg.png';
        $drag = $path . '_drag.png';

        return imagepng($code->getBackground(), $bg)
            && imagepng($code->getDragImage(), $drag);
    }

    public function validate(DragCode $code, float $x, float $y, float $threshold = 5): bool
    {
        return $x >= $code->getX() - $threshold
            && $x <= $code->getX() + $threshold
            && $y >= $code->getY() - $threshold
            && $y <= $code->getY() + $threshold;
    }
}
