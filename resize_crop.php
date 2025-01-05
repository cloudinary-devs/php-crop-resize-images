<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv; 
use Cloudinary\Configuration\Configuration;
use Cloudinary\Cloudinary;
use Cloudinary\Tag\ImageTag;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Background;


// Load .env file 
$dotenv = Dotenv::createImmutable(__DIR__); 
$dotenv->load(); 

// Initialize Configuration
$config = new Configuration($_ENV['CLOUDINARY_URL']);
$cld = new Cloudinary($config);


// Create the image tag with the transformed image

$scaleURL = $cld->image('cld-sample')
    ->resize(Resize::scale()
        ->width(600)
    );

echo "Resized sample image:" . "\n";
echo $scaleURL . "\n";
echo "\n";


$cropURL = $cld->image('cld-sample')
    ->resize(Resize::crop()
        ->width(600)
        ->height(600)
    );

echo "Cropped sample image:" . "\n";
echo $cropURL . "\n";
echo "\n";

use Cloudinary\Transformation\Gravity;

$autoCropURL = $cld->image('cld-sample')
                ->resize(
                    Resize::auto()
                        ->width(600)
                        ->height(600)
                        ->gravity(Gravity::auto())
                );

echo "Sample image cropped with automatic gravity:" . "\n";
echo $autoCropURL . "\n";
echo "\n";

$faceCropURL = $cld->image('cld-sample')
                ->resize(
                    Resize::auto()
                        ->width(600)
                        ->height(600)
                        ->gravity(Gravity::face())
                );

echo "Sample image automatically cropped around the face:" . "\n";
echo $faceCropURL . "\n";
echo "\n";

// Array of public IDs
$publicIDs = ['winter-fashion', 'girl-leaves', 'leather_bag'];

echo "Loop through an array of public IDs, cropping each image:" . "\n";
// Loop through each public ID and apply transformation
foreach ($publicIDs as $publicID) {
    $autoCropURL = $cld->image($publicID)
        ->resize(
            Resize::auto()
                ->width(600)
                ->height(600)
                ->gravity(Gravity::auto())
        );

    // Print the transformed URL
    echo $publicID . ":\n";
    echo $autoCropURL . "\n";
    echo "\n";

}

?>