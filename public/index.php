<?php

/**
 * Ancient Egyptian Museum - Application Entry Point
 */

// Get the requested URI
$requestUri = $_SERVER['REQUEST_URI'];
$requestUri = parse_url($requestUri, PHP_URL_PATH);
$requestUri = rtrim($requestUri, '/');

// If empty, set to home
if (empty($requestUri)) {
    $requestUri = '/';
}

// Define route mappings to HTML files
$routes = [
    '/' => 'index.html',
    '/index' => 'index.html',
    '/about' => 'about.html',
    '/visit' => 'visit.html',
    '/family-visit' => 'family-visit.html',
    '/group-visit' => 'group-visit.html',
    '/booking' => 'booking.html',
    '/learn' => 'learn.html',
    '/gallery' => 'gallery.html',
    '/blog' => 'blog.html',
    '/blog-detail' => 'blog_detail.html',
    '/events' => 'event.html',
    '/event' => 'event.html',
    '/contact' => 'contact.html',
    '/donation' => 'donation.html',
    '/member' => 'member.html',
    '/membership-forms' => 'membershipforms.html',
    '/payment' => 'payment.html',
    '/volunteer' => 'volunteer.html',
    '/volunteer-form' => 'volunteer-form.html',
    '/food-drink' => 'food&drink.html',
    '/map' => 'Map.html',
    '/detail' => 'detail.html',
    '/auth' => 'Auth.html',
    '/login' => 'Auth.html',
    '/register' => 'Auth.html',
];

// Check if route exists
if (isset($routes[$requestUri])) {
    $htmlFile = __DIR__ . '/../views/' . $routes[$requestUri];

    if (file_exists($htmlFile)) {
        // Read and output the HTML file
        readfile($htmlFile);
        exit;
    }
}

// Try to serve static files from views directory
$possibleFile = __DIR__ . '/../views' . $requestUri;
if (file_exists($possibleFile) && is_file($possibleFile)) {
    // Determine content type
    $extension = pathinfo($possibleFile, PATHINFO_EXTENSION);
    $contentTypes = [
        'html' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
    ];

    if (isset($contentTypes[$extension])) {
        header('Content-Type: ' . $contentTypes[$extension]);
    }

    readfile($possibleFile);
    exit;
}

// 404 Not Found
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .error-container {
            text-align: center;
            color: white;
            padding: 40px;
            background: rgba(0,0,0,0.3);
            border-radius: 10px;
        }
        h1 { font-size: 120px; margin: 0; }
        h2 { font-size: 32px; margin: 10px 0; }
        p { font-size: 18px; margin: 20px 0; }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: transform 0.3s;
        }
        a:hover { transform: scale(1.05); }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>The page you are looking for doesn't exist.</p>
        <a href="/">Go Back Home</a>
    </div>
</body>
</html>
