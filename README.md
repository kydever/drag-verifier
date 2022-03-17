# 滑动验证码

[![PHPUnit](https://github.com/kydever/drag-verifier/actions/workflows/test.yml/badge.svg)](https://github.com/kydever/drag-verifier/actions/workflows/test.yml)

## 安装

```
composer require kydev/drag-verifier
```

## 使用

```php
<?php

use KY\DragVerifier\DragVerifier;

// 读取滑动验证码的背景图
$bg = imagecreatefromjpeg(__DIR__ . '/../images/IMG_0002.jpeg');

// 读取填充图，要求外围是透明色，中间是纯色，且要求中间那一点，必须有颜色
$fillImage = imagecreatefrompng(__DIR__ . '/../images/ky_fill.png');
$verifier = new DragVerifier($bg, $fillImage);

// 生成验证码相关数据
$code = $verifier->generate();

// 保存图片
$res = $verifier->save($code, __DIR__);
```

## 版权说明

测试目录的 `ky_fill.png` 和 `ky_hollowed.png` 版权所属 `KnowYourself`

禁止随意使用。
