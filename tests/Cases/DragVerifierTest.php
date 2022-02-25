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
namespace HyperfTest\Cases;

use KY\DragVerifier\DragCode;
use KY\DragVerifier\DragVerifier;

/**
 * @internal
 * @coversNothing
 */
class DragVerifierTest extends AbstractTestCase
{
    public function testGenerate()
    {
        $bg = imagecreatefromjpeg(__DIR__ . '/../images/IMG_0001.jpg');
        $fillImage = imagecreatefrompng(__DIR__ . '/../images/fill.png');
        $hollowedImage = imagecreatefrompng(__DIR__ . '/../images/hollowed.png');

        $verifier = new DragVerifier($bg, $fillImage, $hollowedImage);

        $code = $verifier->generate();

        $this->assertInstanceOf(DragCode::class, $code);
    }

    public function testSave()
    {
        $bg = imagecreatefromjpeg(__DIR__ . '/../images/IMG_0002.jpeg');
        $fillImage = imagecreatefrompng(__DIR__ . '/../images/ky_fill.png');
        $hollowedImage = imagecreatefrompng(__DIR__ . '/../images/ky_hollowed.png');
        $verifier = new DragVerifier($bg, $fillImage, $hollowedImage);

        $code = $verifier->generate();
        $res = $verifier->save($code, __DIR__);
        $this->assertTrue($res);
    }
}
