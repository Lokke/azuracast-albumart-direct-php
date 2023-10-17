<?php

function getCurrentAlbumArt($azuraCastBaseUrl, $stationId = 1) {
    // The endpoint for the current playback information
    $endpoint = "{$azuraCastBaseUrl}/api/nowplaying/{$stationId}";

    // Fetch the data using CURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Might be necessary for self-signed certificates
    $output = curl_exec($ch);
    curl_close($ch);

    if (!$output) {
        return false; // Error fetching the data
    }

    $nowPlaying = json_decode($output, true);

    if (!isset($nowPlaying['now_playing']['song']['art'])) {
        return false; // Album art not found
    }

    return $nowPlaying['now_playing']['song']['art'];
}

$azuraCastBaseUrl = 'https://funkturm.radio-endstation.de'; // Your AzuraCast server URL
$albumArtUrl = getCurrentAlbumArt($azuraCastBaseUrl);

if ($albumArtUrl) {
    // Retrieve the content of the image
    $imageContent = file_get_contents($albumArtUrl);

    if ($imageContent) {
        // Define the content type of the image and send the content
        header('Content-Type: image/jpeg'); // For JPEG images
        echo $imageContent;
    } else {
        // Send an error message if the image cannot be fetched
        header("HTTP/1.0 404 Not Found");
        echo "Image could not be retrieved.";
    }
} else {
    // Send an error message if the album art URL is not found
    header("HTTP/1.0 404 Not Found");
    echo "No album art found.";
}

?>
