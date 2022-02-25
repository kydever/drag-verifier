# 滑动验证码

## 安装

```
composer require kydev/drag-verifier
```

## 使用

```php
<?php
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
