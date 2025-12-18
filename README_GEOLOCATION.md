# Geolocation Feature Setup Guide

## Overview
The geolocation feature allows users and hospitals to:
- Find nearby hospitals and donors on an interactive map
- Get their current location automatically
- Search for locations manually
- View distance to nearby locations
- Update profile with location data

## Setup Instructions

### 1. Database Setup
Run the SQL migration to add location columns:
```sql
-- Run this SQL file:
sql/add_geolocation_columns.sql
```

Or the system will automatically add columns when profiles are updated.

### 2. No API Key Required! 🎉

**Great News:** This system uses **100% FREE** geolocation services:
- **Leaflet.js** - Free open-source mapping library
- **OpenStreetMap** - Free map tiles (no API key needed)
- **Nominatim** - Free geocoding service (no API key needed)

**No setup required!** Just use the features directly.

### 3. Features Included

#### Find Nearby Page (`findnearby.php`)
- Interactive map using Leaflet.js & OpenStreetMap (FREE)
- Get current location button
- **Search by city name** - Enter any city to find hospitals there
- Shows hospitals in the searched city with full details
- Shows nearby hospitals (red markers) when using location
- Shows nearby donors (blue markers) when using location
- Displays distance in kilometers
- Click markers for detailed information
- Beautiful card-based display of hospital information

#### Profile Pages
- **Hospital Profile** (`hprofile.php`):
  - Address field (manual entry or auto-filled)
  - "Get Current Location" button (uses free Nominatim service)
  - Automatically captures latitude/longitude
  - Reverse geocoding to get address from coordinates
  
- **User/Receiver Profile** (`rprofile.php`):
  - Address field (manual entry or auto-filled)
  - "Get Current Location" button (uses free Nominatim service)
  - Automatically captures latitude/longitude
  - Reverse geocoding to get address from coordinates

#### Backend Features
- `file/getnearby.php`: API endpoint to find nearby locations
  - Supports city-based search (no coordinates needed)
  - Supports coordinate-based search (with distance calculation)
  - Returns hospitals matching city name
- `file/updateprofile.php`: Updated to save location data
- Automatic distance calculation using Haversine formula
- Radius-based search (default 50km)
- City name search (finds all hospitals in a city)

### 4. How to Use

#### For Users:
1. Go to your profile page
2. Click "Get Current Location" or enter address manually
3. Save your profile
4. Go to "Find Nearby" page
5. Click "Get My Location" to see nearby hospitals and donors

#### For Hospitals:
1. Go to hospital profile page
2. Click "Get Current Location" or enter address manually
3. Save your profile
4. Go to "Find Nearby" page
5. Click "Get My Location" to see nearby hospitals and donors

### 5. Navigation Links
- Hospital Dashboard: "Find Nearby" menu item added
- User Dashboard: Can access via direct URL or add to menu

### 6. Privacy Note
- Location data is stored in the database
- Users can choose to update or not update their location
- Location is only used for finding nearby hospitals/donors
- No location data is shared with third parties

### 7. How to Search by City

1. Go to "Find Nearby" page
2. Enter a city name in the search box (e.g., "Delhi", "Mumbai", "Bengaluru")
3. Click "Search Location"
4. The system will:
   - Find all hospitals in that city
   - Display them in beautiful cards with full details
   - Show hospital name, city, address, phone, email
   - Display on map if coordinates are available
   - Show distance if your location is known

### 8. Troubleshooting

**Map not showing:**
- Check internet connection (needs to load Leaflet.js and OpenStreetMap tiles)
- Check browser console for errors
- Ensure JavaScript is enabled

**Location not working:**
- Ensure browser allows location access
- Check if device has GPS/location services enabled
- Try using HTTPS (some browsers require HTTPS for geolocation)

**No search results:**
- Make sure hospitals have registered with city names
- Try different city name variations
- Check database connection
- City search works even without coordinates - it searches by city name in database

**Search by city works without coordinates:**
- You can search for hospitals in any city
- Results show all hospitals matching the city name
- Distance is calculated only if both user and hospital have coordinates

### 9. API Endpoints

**Get Nearby Locations by Coordinates:**
```
GET file/getnearby.php?lat={latitude}&lng={longitude}&radius={radius_in_km}
```

**Get Hospitals by City Name:**
```
GET file/getnearby.php?city={city_name}
```

**Get Hospitals by City with Distance:**
```
GET file/getnearby.php?city={city_name}&lat={latitude}&lng={longitude}
```

Returns JSON with:
```json
{
  "hospitals": [
    {
      "id": 1,
      "hname": "Hospital Name",
      "hcity": "City Name",
      "hphone": "1234567890",
      "hemail": "email@example.com",
      "address": "Full Address",
      "latitude": "28.6139",
      "longitude": "77.2090",
      "distance": 5.23
    }
  ],
  "donors": [...]
}
```

Each hospital item includes all details and distance (if coordinates available).

## Support
For issues or questions, check:
- Google Maps API documentation
- Browser geolocation API documentation
- Database connection settings

