<?php
function uploadToCloudinary($tmpFilePath) {
    $cloudName = getenv("CLOUDINARY_CLOUD_NAME");
    $apiKey    = getenv("CLOUDINARY_API_KEY");
    $apiSecret = getenv("CLOUDINARY_API_SECRET");

    $timestamp = time();
    $folder = "university_portal/profiles";

    // Create signature
    $signature = sha1("folder={$folder}&timestamp={$timestamp}{$apiSecret}");

    $post = [
        'file' => new CURLFile($tmpFilePath),
        'api_key' => $apiKey,
        'timestamp' => $timestamp,
        'folder' => $folder,
        'signature' => $signature
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    return $result['secure_url'] ?? null;
}
