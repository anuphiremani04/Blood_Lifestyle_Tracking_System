<?php
require 'connection.php';
header('Content-Type: application/json');

$lat = isset($_GET['lat']) ? floatval($_GET['lat']) : null;
$lng = isset($_GET['lng']) ? floatval($_GET['lng']) : null;
$city = isset($_GET['city']) ? trim($_GET['city']) : null;
$radius = isset($_GET['radius']) ? floatval($_GET['radius']) : 50; // Default 50km radius

$result = ['hospitals' => [], 'donors' => []];

// Check if latitude/longitude columns exist
$check_hospitals = mysqli_query($conn, "SHOW COLUMNS FROM hospitals LIKE 'latitude'");
$check_receivers = mysqli_query($conn, "SHOW COLUMNS FROM receivers LIKE 'latitude'");

// Check if latitude/longitude columns exist, if not return empty results
$check_hospitals = mysqli_query($conn, "SHOW COLUMNS FROM hospitals LIKE 'latitude'");
$check_receivers = mysqli_query($conn, "SHOW COLUMNS FROM receivers LIKE 'latitude'");

$result = ['hospitals' => [], 'donors' => []];

// Get hospitals by city or by coordinates
if ($city) {
    // Search by city name
    $hospitals_sql = "SELECT * FROM hospitals 
        WHERE hcity LIKE '%" . mysqli_real_escape_string($conn, $city) . "%' 
        ORDER BY hname
        LIMIT 50";
    
    $hospitals_result = mysqli_query($conn, $hospitals_sql);
    if ($hospitals_result) {
        while ($row = mysqli_fetch_assoc($hospitals_result)) {
            // Calculate distance if user location is provided
            if ($lat && $lng && isset($row['latitude']) && isset($row['longitude']) && $row['latitude'] && $row['longitude']) {
                $row['distance'] = calculateDistance($lat, $lng, floatval($row['latitude']), floatval($row['longitude']));
            }
            $result['hospitals'][] = $row;
        }
    }
} elseif ($lat && $lng && mysqli_num_rows($check_hospitals) > 0) {
    // Search by coordinates (nearby search)
    $hospitals_sql = "SELECT *, 
        (6371 * acos(
            cos(radians($lat)) * 
            cos(radians(latitude)) * 
            cos(radians(longitude) - radians($lng)) + 
            sin(radians($lat)) * 
            sin(radians(latitude))
        )) AS distance
        FROM hospitals 
        WHERE latitude IS NOT NULL 
        AND longitude IS NOT NULL
        HAVING distance < $radius
        ORDER BY distance
        LIMIT 20";
    
    $hospitals_result = mysqli_query($conn, $hospitals_sql);
    if ($hospitals_result) {
        while ($row = mysqli_fetch_assoc($hospitals_result)) {
            $result['hospitals'][] = $row;
        }
    }
}

// Get nearby donors/receivers
if (mysqli_num_rows($check_receivers) > 0) {
    $donors_sql = "SELECT *, 
        (6371 * acos(
            cos(radians($lat)) * 
            cos(radians(latitude)) * 
            cos(radians(longitude) - radians($lng)) + 
            sin(radians($lat)) * 
            sin(radians(latitude))
        )) AS distance
        FROM receivers 
        WHERE latitude IS NOT NULL 
        AND longitude IS NOT NULL
        HAVING distance < $radius
        ORDER BY distance
        LIMIT 20";
    
    $donors_result = mysqli_query($conn, $donors_sql);
    if ($donors_result) {
        while ($row = mysqli_fetch_assoc($donors_result)) {
            $result['donors'][] = $row;
        }
    }
}

// Helper function to calculate distance
function calculateDistance($lat1, $lon1, $lat2, $lon2) {
    $R = 6371; // Radius of the Earth in km
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    return $R * $c;
}

echo json_encode($result);
mysqli_close($conn);
?>

