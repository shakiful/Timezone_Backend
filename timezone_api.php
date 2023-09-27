<?php
// Enable CORS (Cross-Origin Resource Sharing) to allow requests from different domains
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Check if a timezone was provided in the request
if (isset($_GET['timezone']) && !$_GET['timezone'] == ' ') {
    $timezone = $_GET['timezone'];
} else {
    // Default to UTC if no timezone is provided
    $timezone = $_GET['timezone'];
}

try {
    // Create a DateTime object for the specified timezone
    $dateTime = new DateTime('now', new DateTimeZone($timezone));

    // Prepare the response data
    $response = [
        'timezone' => $timezone,
        'current_time' => $dateTime->format('h:i:s:A'),
    ];

    // Send the JSON response
    echo json_encode($response);
} catch (Exception $e) {
    // Handle any exceptions (e.g., invalid timezone)
    http_response_code(400); // Bad Request
    echo json_encode(['error' => $e->getMessage()]);
}
