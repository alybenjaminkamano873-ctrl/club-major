<?php
// Create a logo image for Club MAJOR
$width = 600;
$height = 400;
$image = imagecreatetruecolor($width, $height);

// Define colors
$white = imagecolorallocate($image, 255, 255, 255);
$darkGreen = imagecolorallocate($image, 34, 139, 34); // Dark green
$lightGreen = imagecolorallocate($image, 144, 238, 144); // Light green
$blue = imagecolorallocate($image, 30, 144, 255); // Dodger blue
$black = imagecolorallocate($image, 0, 0, 0);

// Fill background with white
imagefilledrectangle($image, 0, 0, $width, $height, $white);

// Draw a border
imagerectangle($image, 5, 5, $width - 5, $height - 5, $darkGreen);
imagerectangle($image, 10, 10, $width - 10, $height - 10, $lightGreen);

// Add some diagonal lines for design
for ($i = 0; $i < $width; $i += 40) {
    imageline($image, $i, 0, $i + 100, $height, $lightGreen);
}

// Add text
$fontFile = __DIR__ . '/assets/fonts/arial.ttf';

// Check if font file exists, if not use default
if (!file_exists($fontFile)) {
    // Use imagestring instead
    imagestring($image, 5, 150, 80, 'CLUB MAJOR', $darkGreen);
    imagestring($image, 3, 100, 150, 'Mazagan Athletisme Jogging And Organisation', $blue);
    imagestring($image, 3, 80, 200, 'Convivialite - Union - Fraternite', $black);
} else {
    // Use TrueType fonts
    imagettftext($image, 48, 0, 120, 120, $darkGreen, $fontFile, 'MAJOR');
    imagettftext($image, 24, 0, 80, 200, $blue, $fontFile, 'Mazagan Athletisme');
    imagettftext($image, 16, 0, 100, 280, $black, $fontFile, 'Jogging And Organisation');
}

// Save the image
$outputPath = __DIR__ . '/assets/images/logo_major.png';
imagepng($image, $outputPath);
imagedestroy($image);

echo "Logo created successfully at: " . $outputPath;
?>
