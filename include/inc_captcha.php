<?php
function generate_string($characters = 6)
{
    $gfwChar = '23456789bcdfghjkmnpqrstvwxyz';
    /* list all possible characters, similar looking characters and vowels have been removed */
    $possible = $gfwChar;
    $code = '';
    $i = 0;
    while ($i < $characters) {
        $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
        $i++;
    }
    return $code;
}

$image = imagecreatetruecolor(200, 50);

imageantialias($image, true);

$colors = [];

$red = rand(125, 175);
$green = rand(125, 175);
$blue = rand(125, 175);

for ($i = 0; $i < 5; $i++) {
    $colors[] = imagecolorallocate($image, $red - 20 * $i, $green - 20 * $i, $blue - 20 * $i);
}

imagefill($image, 0, 0, $colors[0]);

for ($i = 0; $i < 10; $i++) {
    imagesetthickness($image, rand(2, 10));
    $line_color = $colors[rand(1, 4)];
    imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $line_color);
}

$black = imagecolorallocate($image, 0, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);
$textcolors = [$black, $white];

$fonts = [dirname(__FILE__) . '/files/fonts/monofont.ttf'];
// print_r($fonts);
// exit();
$string_length = 6;
$captcha_string = generate_string($string_length);

$_SESSION[SESSION_TITLE . 'security_code'] = $captcha_string;
for ($i = 0; $i < $string_length; $i++) {
    $letter_space = 170 / $string_length;
    $initial = 15;

    imagettftext($image, 24, rand(-15, 15), $initial + $i * $letter_space, rand(25, 45), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);
}

header('Content-type: image/png');
imagepng($image);
imagedestroy($image);

?>