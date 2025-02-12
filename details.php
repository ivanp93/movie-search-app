<?php
// TMDb API Key
$apiKey = '770c4894dbdb9be6edda1ee2ac607919';  // Use your actual API key here
$baseUrl = 'https://api.themoviedb.org/3';

// Check if the 'id' parameter is set (movie ID)
if (isset($_GET['id'])) {
    $movieId = $_GET['id'];  // Movie ID (e.g., imdbID) passed from the frontend
    $url = "{$baseUrl}/movie/{$movieId}?api_key={$apiKey}&language=en-US";

    // Initialize cURL session to fetch data from the TMDb API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout after 30 seconds

    // Execute the cURL session and fetch the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo json_encode(['error' => 'Failed to fetch movie details from TMDb API: ' . curl_error($ch)]);
        exit;
    }

    // Close the cURL session
    curl_close($ch);

    // Decode the JSON response from TMDb API
    $data = json_decode($response, true);

    // Check if TMDb returned movie details
    if (isset($data['title'])) {
        // Return the movie details as JSON
        echo json_encode($data);
    } else {
        // If no movie details were found
        echo json_encode(['error' => 'Movie details not found']);
    }
} else {
    // If 'id' parameter is not provided
    echo json_encode(['error' => 'No movie ID provided']);
}
?>
