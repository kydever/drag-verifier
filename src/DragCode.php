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

class DragCode
{
    public function __construct(
        protected GdImage $background,
        protected GdImage $dragImage,
        protected float $x,
        protected float $y
    ) {
    }

    public function getBackground(): GdImage
    {
        return $this->background;
    }

    public function getDragImage(): GdImage
    {
        return $this->dragImage;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }
}
