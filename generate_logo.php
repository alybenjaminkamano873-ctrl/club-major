<?php
// Create directory if it doesn't exist
$dir = __DIR__ . '/assets/images';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

// Create a simple PNG image using GD library
$width = 600;
$height = 400;
$image = imagecreatetruecolor($width, $height);

// Define colors (RGB)
$colors = [
    'white' => imagecolorallocate($image, 255, 255, 255),
    'darkGreen' => imagecolorallocate($image, 34, 139, 34),
    'lightGreen' => imagecolorallocate($image, 144, 238, 144),
    'blue' => imagecolorallocate($image, 30, 144, 255),
    'black' => imagecolorallocate($image, 0, 0, 0),
];

// Fill background
imagefilledrectangle($image, 0, 0, $width, $height, $colors['white']);

// Draw borders
imagerectangle($image, 5, 5, $width - 5, $height - 5, $colors['darkGreen']);
imagerectangle($image, 10, 10, $width - 10, $height - 10, $colors['lightGreen']);

// Draw diagonal lines
for ($i = 0; $i < $width; $i += 40) {
    imageline($image, $i, 0, $i + 100, $height, $colors['lightGreen']);
}

// Add text using built-in fonts
imagestring($image, 5, 180, 100, 'MAJOR', $colors['darkGreen']);
imagestring($image, 5, 120, 200, 'Mazagan Athletisme Jogging', $colors['blue']);
imagestring($image, 5, 150, 250, 'And Organisation', $colors['black']);

// Save PNG
$outputPath = $dir . '/logo_major.png';
imagepng($image, $outputPath);
imagedestroy($image);

echo "Logo created at: " . $outputPath;
?>
