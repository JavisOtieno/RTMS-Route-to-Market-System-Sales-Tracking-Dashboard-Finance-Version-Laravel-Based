<?php

return [
    'optimizers' => [
        Spatie\ImageOptimizer\Optimizers\Jpegoptim::class => [
            '--max=85', // Maximum quality percentage
            '--strip-all', // Remove all metadata
            '--all-progressive', // Convert to progressive JPEGs
        ],

        Spatie\ImageOptimizer\Optimizers\Optipng::class => [
            '-o7', // Maximum compression level
            '-strip all', // Remove all metadata
        ],

        Spatie\ImageOptimizer\Optimizers\Gifsicle::class => [
            '--optimize=3', // Maximum optimization level
            '--verbose', // Print verbose output
        ],

        Spatie\ImageOptimizer\Optimizers\Svgo::class => [
            '--disable=cleanupIDs', // Example SVGO option
            '--enable=removeViewBox', // Enable removing the viewBox attribute
        ],

        // Add other optimizers here if needed
    ],
];
