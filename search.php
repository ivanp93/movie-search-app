<?php
// TMDb API Key
$apiKey = '770c4894dbdb9be6edda1ee2ac607919';  // Use your actual API key here
$baseUrl = 'https://api.themoviedb.org/3';

// Check if the 'query' parameter is set and not empty
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = urlencode($_GET['query']);  // URL encode the query to handle special characters
    $url = "{$baseUrl}/search/movie?api_key={$apiKey}&query={$query}&language=en-US&page=1&include_adult=false";

    // Initialize cURL session to fetch data from the TMDb API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout after 30 seconds

    // Execute the cURL session and fetch the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo json_encode(['error' => 'Failed to fetch data from TMDb API: ' . curl_error($ch)]);
        exit;
    }

    // Close the cURL session
    curl_close($ch);

    // Decode the JSON response from TMDb API
    $data = json_decode($response, true);

    // Check if TMDb returned any results
    if (isset($data['results']) && !empty($data['results'])) {
        // Return the results as JSON
        echo json_encode(['Search' => $data['results']]);
    } else {
        // If no results found, return a friendly message
        echo json_encode(['Search' => [], 'message' => 'No results found for your query.']);
    }
} else {
    // If 'query' parameter is not provided or is empty
    echo json_encode(['error' => 'No search query provided. Please enter a movie title.']);
}
?>
