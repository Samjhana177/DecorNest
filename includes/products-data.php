<?php

$products   = [];
$categories = [];

$categories = [
    ['slug' => 'sofa',      'name' => 'Sofa',             'icon' => 'bi-house-heart-fill'],
    ['slug' => 'furniture', 'name' => 'Furniture',        'icon' => 'bi-lamp-fill'],
    ['slug' => 'lighting',  'name' => 'Lighting',         'icon' => 'bi-lightbulb-fill'],
    ['slug' => 'wallart',   'name' => 'Wall Art',         'icon' => 'bi-image-fill'],
    ['slug' => 'plants',    'name' => 'Indoor Plants',    'icon' => 'bi-flower1'],
    ['slug' => 'kitchen',   'name' => 'Kitchen Products', 'icon' => 'bi-cup-hot-fill'],
];

$categoryData = [

    'sofa' => [
        'name'  => 'Sofa',
        'price' => 25000,
        'items' => [
            'Luxury Sofa', 'Modern L-Shape Sofa', 'Classic 3-Seater Sofa',
            'Velvet Sofa', 'Recliner Sofa', 'Compact 2-Seater Sofa',
            'Corner Sofa Set', 'Leather Sofa', 'Fabric Sofa', 'Wooden Frame Sofa',
        ],
    ],

    'furniture' => [
        'name'  => 'Furniture',
        'price' => 8000,
        'items' => [
            'Modern Chair', 'Dining Table Set', 'Wooden Bookshelf',
            'Coffee Table', 'Bedside Table', 'TV Cabinet',
            'Study Desk', 'Wardrobe', 'Shoe Rack', 'Office Chair',
        ],
    ],

    'lighting' => [
        'name'  => 'Lighting',
        'price' => 3500,
        'items' => [
            'Decor Lamp', 'Pendant Light', 'Floor Lamp', 'Table Lamp',
            'Wall Sconce Light', 'Chandelier', 'LED Strip Light',
            'String Fairy Lights', 'Ceiling Light', 'Reading Lamp',
        ],
    ],

    'wallart' => [
        'name'  => 'Wall Art',
        'price' => 2500,
        'items' => [
            'Wall Art', 'Canvas Painting', 'Abstract Wall Frame',
            'Wooden Wall Clock', 'Mirror Wall Decor', 'Photo Frame Set',
            'Wall Tapestry', 'Metal Wall Art', 'Floral Wall Print', 'Wall Hanging Decor',
        ],
    ],

    'plants' => [
        'name'  => 'Indoor Plants',
        'price' => 1500,
        'items' => [
            'Artificial Plant Pot', 'Bamboo Plant', 'Money Plant',
            'Snake Plant', 'Succulent Set', 'Bonsai Tree',
            'Hanging Plant Pot', 'Ceramic Plant Vase', 'Areca Palm Plant', 'Cactus Plant Set',
        ],
    ],

    'kitchen' => [
        'name'  => 'Kitchen Products',
        'price' => 2000,
        'items' => [
            'Ceramic Dinner Set', 'Glass Jar Set', 'Wooden Cutting Board',
            'Kitchen Storage Rack', 'Tea Cup Set', 'Cooking Utensil Set',
            'Spice Rack Organizer', 'Dining Mat Set', 'Kitchen Towel Set', 'Bowl Set',
        ],
    ],

];

$nextId = 1;

foreach ($categoryData as $categorySlug => $categoryInfo) {

    $categoryName = $categoryInfo['name'];
    $basePrice    = $categoryInfo['price'];
    $itemNames    = $categoryInfo['items'];

    foreach ($itemNames as $index => $itemName) {

        // Price goes up slightly for each item in the category
        $price = $basePrice + ($index * 500);

        // Random rating between 3.8 and 5.0
        $rating = rand(38, 50) / 10;

        // Image filename, e.g. images/products/sofa3.png
        $imageNumber = $index + 1;
        $imagePath   = 'images/products/' . $categorySlug . $imageNumber . '.png';

        // Build one product as an associative array
        $singleProduct = [
            'id'           => $nextId,
            'name'         => $itemName,
            'category'     => $categorySlug,
            'categoryName' => $categoryName,
            'price'        => $price,
            'rating'       => $rating,
            'image'        => $imagePath,
            'description'  => 'Premium quality ' . strtolower($itemName) .
                               ' designed to bring comfort, style, and elegance ' .
                               'to your home. Made with high quality materials ' .
                               'and built to last.',
        ];

        // Add this product to the main $products array
        $products[] = $singleProduct;

        // Increase the id for the next product
        $nextId = $nextId + 1;
    }
}
