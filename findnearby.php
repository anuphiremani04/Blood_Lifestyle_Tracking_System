<?php 
require 'file/connection.php'; 
session_start();
?>
<!DOCTYPE html>
<html>
<?php $title="Blood Lifestyle Tracking System | Find Nearby"; ?>
<?php require 'head.php'; ?>
<!-- Leaflet.js - Free Open Source Maps (Load early) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<style>
    body{
    background: linear-gradient(135deg, rgba(255, 107, 107, 0.85) 0%, rgba(238, 90, 111, 0.85) 25%, rgba(201, 42, 42, 0.85) 50%, rgba(166, 30, 77, 0.85) 75%, rgba(134, 46, 156, 0.85) 100%);
    background-attachment: fixed;
    min-height: 100vh;
    animation: fadeIn 0.6s ease-in;
  }
  
  .card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 245, 245, 0.95) 100%);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(220, 53, 69, 0.2);
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(220, 53, 69, 0.3);
    margin-bottom: 20px;
  }
  
  #map {
    height: 500px !important;
    width: 100% !important;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
    overflow: hidden;
    background-color: #e8e8e8;
    min-height: 500px !important;
    display: block !important;
    visibility: visible !important;
  }
  
  /* Prevent map from causing scroll issues */
  .leaflet-container {
    touch-action: pan-x pan-y;
    outline: none;
    height: 500px !important;
    width: 100% !important;
    border-radius: 15px;
    position: relative !important;
    z-index: 1;
  }
  
  /* Ensure map tiles load properly */
  .leaflet-tile-container {
    border-radius: 15px;
  }
  
  /* Fix for Leaflet map visibility */
  .leaflet-map-pane {
    z-index: 1;
  }
  
  .leaflet-tile-pane {
    z-index: 2;
  }
  
  .leaflet-overlay-pane {
    z-index: 3;
  }
  
  .leaflet-marker-pane {
    z-index: 4;
  }
  
  /* Prevent body scroll on button click */
  body {
    overflow-x: hidden;
  }
  
  /* Fix for status div to prevent layout shift */
  #locationStatus {
    min-height: 40px;
    transition: none;
  }
  
  /* Prevent results div from causing jump */
  #nearbyResults {
    transition: none;
  }
  
  .btn-primary {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
    border: none;
    border-radius: 10px;
    padding: 12px 25px;
    font-weight: 600;
    transition: background 0.2s ease, box-shadow 0.2s ease;
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    color: white;
    cursor: pointer;
    position: relative;
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    touch-action: manipulation;
  }
  
  .btn-primary:hover {
    background: linear-gradient(135deg, #c92a2a 0%, #a61e4d 100%);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
    color: white;
  }
  
  .btn-primary:active {
    background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
    box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3);
    transform: none !important;
    outline: none !important;
  }
  
  .btn-primary:active,
  .btn-primary:focus:active {
    transform: none !important;
  }
  
  .btn-primary:focus {
    outline: none;
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3), 0 0 0 3px rgba(220, 53, 69, 0.2);
  }
  
  .btn-primary:focus:active {
    box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3);
  }
  
  .location-info {
    background: rgba(220, 53, 69, 0.1);
    padding: 15px;
    border-radius: 10px;
    margin: 10px 0;
  }
  
  .distance-badge {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-weight: 600;
    display: inline-block;
    margin-left: 10px;
  }
</style>
<body class="page-transition">
	<?php require 'header.php'; ?>
	
	<div class="container cont">
		<?php require 'message.php'; ?>

		<div class="card" style="padding: 30px;">
			<h2 style="color: #dc3545; font-weight: bold; text-align: center; margin-bottom: 20px;">
				<i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i>
				Find Nearby Hospitals & Donors
			</h2>
			
			<div class="location-info">
				<p style="margin: 0; color: #333;">
					<strong><i class="fas fa-info-circle" style="margin-right: 5px;"></i>Location Services:</strong>
					Click "Get My Location" to find hospitals and donors near you. You can also search by entering a location manually.
				</p>
			</div>

			<div class="row mb-4">
				<div class="col-md-6 mb-3">
					<button type="button" id="getLocationBtn" class="btn btn-primary btn-block" onclick="return false;">
						<i class="fas fa-crosshairs" style="margin-right: 5px;"></i>Get My Location
					</button>
				</div>
				<div class="col-md-6 mb-3">
					<input type="text" id="searchLocation" class="form-control" placeholder="Search by city name (e.g., Delhi, Mumbai, Bengaluru)">
					<button type="button" id="searchLocationBtn" class="btn btn-primary btn-block mt-2" onclick="return false;">
						<i class="fas fa-search" style="margin-right: 5px;"></i>Search Hospitals in City
					</button>
				</div>
			</div>

			<div id="locationStatus" style="text-align: center; padding: 10px; margin: 10px 0; border-radius: 10px; display: none;"></div>

			<div id="map" style="height: 500px; width: 100%; background-color: #e8e8e8; border: 2px solid #dc3545; border-radius: 15px; position: relative;">
				<div id="mapLoading" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; z-index: 1000;">
					<i class="fas fa-spinner fa-spin" style="font-size: 30px; color: #dc3545; margin-bottom: 10px;"></i>
					<p style="color: #dc3545; font-weight: bold;">Loading map...</p>
				</div>
			</div>

			<div id="nearbyResults" class="mt-4" style="display: none;"></div>
		</div>
	</div>

	<?php require 'footer.php'; ?>

	<script>
		// Global variables
		let map;
		let userMarker;
		let userLocation = null;
		let markers = [];
		let mapInitialized = false;

		function initMap() {
			if (mapInitialized && map) {
				map.invalidateSize();
				return;
			}
			
			const mapDiv = document.getElementById('map');
			if (!mapDiv) {
				setTimeout(initMap, 100);
				return;
			}
			
			if (typeof L === 'undefined' || !L || !L.map) {
				setTimeout(initMap, 100);
				return;
			}
			
			mapInitialized = true;
			const defaultLocation = [12.9141, 74.8560];
			
			try {
				// Hide loading message
				const loadingDiv = document.getElementById('mapLoading');
				if (loadingDiv) {
					loadingDiv.style.display = 'none';
				}
				
				// Initialize map
				map = L.map('map', {
					center: defaultLocation,
					zoom: 13
				});
				
				// Add tile layer
				L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; OpenStreetMap contributors',
					maxZoom: 19
				}).addTo(map);
				
				// Set user location and show marker
				userLocation = {
					lat: 12.9141,
					lng: 74.8560
				};
				showUserLocation(userLocation);
				
				// Invalidate size after a delay
				setTimeout(function() {
					if (map) {
						map.invalidateSize();
					}
				}, 500);
				
			} catch (error) {
				console.error('Map error:', error);
				const loadingDiv = document.getElementById('mapLoading');
				if (loadingDiv) {
					loadingDiv.innerHTML = '<p style="color: #dc3545;">Error: ' + error.message + '</p>';
				}
				mapInitialized = false;
			}
		}

		function getLocation(event) {
			if (event) {
				event.preventDefault();
				event.stopPropagation();
			}
			
			const statusDiv = document.getElementById("locationStatus");
			if (statusDiv) {
				statusDiv.style.display = "block";
				statusDiv.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Getting your location...';
				statusDiv.style.background = "rgba(255, 193, 7, 0.2)";
				statusDiv.style.color = "#856404";
			}

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(
					function(position) {
						userLocation = {
							lat: position.coords.latitude,
							lng: position.coords.longitude
						};
						
						showUserLocation(userLocation);
						// Just show location, don't load hospitals
						
						statusDiv.innerHTML = '<i class="fas fa-check-circle"></i> Location found! Showing real hospitals from map.';
						statusDiv.style.background = "rgba(40, 167, 69, 0.2)";
						statusDiv.style.color = "#155724";
					},
					function(error) {
						// If geolocation fails, use Mangalore as default
						statusDiv.innerHTML = '<i class="fas fa-info-circle"></i> Using Mangalore as default location.';
						statusDiv.style.background = "rgba(23, 162, 184, 0.2)";
						statusDiv.style.color = "#0c5460";
						
						// Set Mangalore as default location
						userLocation = {
							lat: 12.9141,
							lng: 74.8560
						};
						
						showUserLocation(userLocation);
						// Just show location, don't load hospitals
					}
				);
			} else {
				// Browser doesn't support geolocation, use Mangalore
				statusDiv.innerHTML = '<i class="fas fa-info-circle"></i> Using Mangalore as default location.';
				statusDiv.style.background = "rgba(23, 162, 184, 0.2)";
				statusDiv.style.color = "#0c5460";
				
				userLocation = {
					lat: 12.9141,
					lng: 74.8560
				};
				
				showUserLocation(userLocation);
				getRealHospitalsFromMap(userLocation);
			}
		}

		function searchLocation(event) {
			if (event) {
				event.preventDefault();
				event.stopPropagation();
				event.stopImmediatePropagation();
				if (event.cancelable) {
					event.preventDefault();
				}
			}
			
			// Prevent any form submission
			if (event && event.target) {
				const form = event.target.closest('form');
				if (form) {
					event.preventDefault();
				}
			}
			
			const searchInput = document.getElementById("searchLocation").value.trim();
			if (!searchInput) {
				alert("Please enter a city or location to search");
				return false;
			}

			const statusDiv = document.getElementById("locationStatus");
			statusDiv.style.display = "block";
			statusDiv.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching location...';
			statusDiv.style.background = "rgba(255, 193, 7, 0.2)";
			statusDiv.style.color = "#856404";

			// Use Nominatim (OpenStreetMap geocoding) - Free, no API key needed
			fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchInput)}&limit=1`)
				.then(response => response.json())
				.then(data => {
					if (data && data.length > 0) {
						userLocation = {
							lat: parseFloat(data[0].lat),
							lng: parseFloat(data[0].lon)
						};
						
						showUserLocation(userLocation);
						// Search by city name as well
						searchByCity(searchInput, userLocation);
						
						statusDiv.innerHTML = '<i class="fas fa-check-circle"></i> Location found: ' + data[0].display_name;
						statusDiv.style.background = "rgba(40, 167, 69, 0.2)";
						statusDiv.style.color = "#155724";
					} else {
						// If geocoding fails, try searching by city name directly
						searchByCity(searchInput, null);
						statusDiv.innerHTML = '<i class="fas fa-info-circle"></i> Searching hospitals in: ' + searchInput;
						statusDiv.style.background = "rgba(23, 162, 184, 0.2)";
						statusDiv.style.color = "#0c5460";
					}
				})
				.catch(error => {
					// Fallback to city search
					searchByCity(searchInput, null);
					statusDiv.innerHTML = '<i class="fas fa-info-circle"></i> Searching hospitals in: ' + searchInput;
					statusDiv.style.background = "rgba(23, 162, 184, 0.2)";
					statusDiv.style.color = "#0c5460";
				});
		}

		function searchByCity(cityName, userLocation) {
			// Clear existing markers
			markers.forEach(marker => map.removeLayer(marker));
			markers = [];

			// First, get coordinates for the city
			fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(cityName)}&limit=1`)
				.then(response => response.json())
				.then(cityData => {
					if (cityData && cityData.length > 0) {
						const cityLocation = {
							lat: parseFloat(cityData[0].lat),
							lng: parseFloat(cityData[0].lon)
						};
						
						if (!userLocation) {
							userLocation = cityLocation;
							showUserLocation(cityLocation);
						}
						
						// Get real hospitals from OpenStreetMap for this city
						getRealHospitalsFromMap(cityLocation, cityName);
					} else {
						// Fallback to database search
						fetch('file/getnearby.php?city=' + encodeURIComponent(cityName) + (userLocation ? '&lat=' + userLocation.lat + '&lng=' + userLocation.lng : ''))
							.then(response => response.json())
							.then(data => {
								displayResults(data, userLocation, cityName);
							})
							.catch(error => {
								console.error('Error:', error);
								document.getElementById("locationStatus").innerHTML = '<i class="fas fa-exclamation-triangle"></i> Error searching. Please try again.';
								document.getElementById("locationStatus").style.background = "rgba(220, 53, 69, 0.2)";
								document.getElementById("locationStatus").style.color = "#721c24";
							});
					}
				})
				.catch(error => {
					console.error('Error:', error);
				});
		}

		function getRealHospitalsFromMap(location, cityName = null) {
			const statusDiv = document.getElementById("locationStatus");
			if (!statusDiv.innerHTML.includes('Showing')) {
				statusDiv.style.display = "block";
				statusDiv.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Fetching real hospitals from map...';
				statusDiv.style.background = "rgba(255, 193, 7, 0.2)";
				statusDiv.style.color = "#856404";
			}

			// Calculate bounding box (approximately 5km radius)
			const radius = 0.05; // degrees (approximately 5km)
			const bbox = [
				(location.lng - radius).toString(),
				(location.lat - radius).toString(),
				(location.lng + radius).toString(),
				(location.lat + radius).toString()
			].join(',');

			// Query OpenStreetMap Overpass API for hospitals and medical facilities
			const overpassQuery = `
				[out:json][timeout:25];
				(
					node["amenity"~"^(hospital|clinic|doctors|pharmacy)$"](bbox:${bbox});
					way["amenity"~"^(hospital|clinic|doctors|pharmacy)$"](bbox:${bbox});
					relation["amenity"~"^(hospital|clinic|doctors|pharmacy)$"](bbox:${bbox});
				);
				out center meta;
			`;

			// Use Overpass API
			fetch('https://overpass-api.de/api/interpreter', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: 'data=' + encodeURIComponent(overpassQuery)
			})
			.then(response => response.json())
			.then(data => {
				if (data && data.elements && data.elements.length > 0) {
					const hospitals = data.elements.map(element => {
						const lat = element.lat || (element.center && element.center.lat);
						const lon = element.lon || (element.center && element.center.lon);
						
						return {
							id: element.id,
							hname: element.tags.name || element.tags['name:en'] || 'Hospital',
							hcity: cityName || element.tags['addr:city'] || element.tags['addr:district'] || 'Unknown',
							hphone: element.tags.phone || element.tags['contact:phone'] || 'Not available',
							hemail: element.tags.email || element.tags['contact:email'] || 'Not available',
							address: element.tags['addr:full'] || 
								[element.tags['addr:street'], element.tags['addr:housenumber'], 
								 element.tags['addr:city'], element.tags['addr:postcode']].filter(Boolean).join(', ') || 'Address not available',
							latitude: lat,
							longitude: lon,
							amenity: element.tags.amenity || 'hospital',
							website: element.tags.website || null
						};
					});

					// Display real hospitals
					displayRealHospitals(hospitals, location, cityName);
					
					statusDiv.innerHTML = `<i class="fas fa-check-circle"></i> Found ${hospitals.length} real hospital(s) from OpenStreetMap!`;
					statusDiv.style.background = "rgba(40, 167, 69, 0.2)";
					statusDiv.style.color = "#155724";
				} else {
					// Fallback to database if no OSM results
					if (userLocation) {
						findNearby(userLocation);
					} else if (cityName) {
						fetch('file/getnearby.php?city=' + encodeURIComponent(cityName))
							.then(response => response.json())
							.then(data => {
								displayResults(data, null, cityName);
							});
					}
					
					statusDiv.innerHTML = '<i class="fas fa-info-circle"></i> No hospitals found on map. Showing database results.';
					statusDiv.style.background = "rgba(23, 162, 184, 0.2)";
					statusDiv.style.color = "#0c5460";
				}
			})
			.catch(error => {
				console.error('Overpass API Error:', error);
				// Fallback to database search
				if (userLocation) {
					findNearby(userLocation);
				} else if (cityName) {
					fetch('file/getnearby.php?city=' + encodeURIComponent(cityName))
						.then(response => response.json())
						.then(data => {
							displayResults(data, null, cityName);
						});
				}
				
				statusDiv.innerHTML = '<i class="fas fa-info-circle"></i> Using database results.';
				statusDiv.style.background = "rgba(23, 162, 184, 0.2)";
				statusDiv.style.color = "#0c5460";
			});
		}

		function displayRealHospitals(hospitals, userLocation, cityName = null) {
			
			const resultsDiv = document.getElementById("nearbyResults");
			const title = cityName ? `Real Hospitals in ${cityName} (from OpenStreetMap)` : 'Real Hospitals Nearby (from OpenStreetMap)';
			let html = `<div class="card" style="padding: 20px; border: 2px solid rgba(220, 53, 69, 0.2); border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);"><h4 style="color: #dc3545; margin-bottom: 20px; font-weight: bold;">${title}</h4>`;

			// Clear existing markers
			markers.forEach(marker => map.removeLayer(marker));
			markers = [];

			if (hospitals && hospitals.length > 0) {
				hospitals.forEach(hospital => {
					let distanceText = '';
					if (userLocation && hospital.latitude && hospital.longitude) {
						const distance = calculateDistance(
							userLocation.lat, userLocation.lng,
							parseFloat(hospital.latitude), parseFloat(hospital.longitude)
						);
						distanceText = `<span class="distance-badge">${distance.toFixed(2)} km away</span>`;
					}

					// Add hospital marker on map
					if (hospital.latitude && hospital.longitude) {
						const hospitalIcon = L.divIcon({
							className: 'hospital-marker',
							html: '<div style="background-color: #dc3545; width: 25px; height: 25px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><i class="fas fa-hospital" style="color: white; font-size: 12px;"></i></div>',
							iconSize: [25, 25],
							iconAnchor: [12, 12]
						});

						const marker = L.marker([parseFloat(hospital.latitude), parseFloat(hospital.longitude)], { icon: hospitalIcon })
							.addTo(map)
							.bindPopup(`
								<div style="padding: 10px; min-width: 200px;">
									<h6 style="color: #dc3545; margin: 0 0 10px 0; font-weight: bold;">${hospital.hname}</h6>
									<p style="margin: 5px 0; font-size: 13px;"><i class="fas fa-map-marker-alt" style="color: #dc3545;"></i> ${hospital.hcity || 'N/A'}</p>
									${hospital.address && hospital.address !== 'Address not available' ? '<p style="margin: 5px 0; font-size: 12px; color: #666;"><i class="fas fa-home"></i> ' + hospital.address + '</p>' : ''}
									${hospital.hphone && hospital.hphone !== 'Not available' ? '<p style="margin: 5px 0; font-size: 13px;"><i class="fas fa-phone" style="color: #dc3545;"></i> ' + hospital.hphone + '</p>' : ''}
									${hospital.website ? '<p style="margin: 5px 0; font-size: 12px;"><a href="' + hospital.website + '" target="_blank" style="color: #dc3545;"><i class="fas fa-globe"></i> Website</a></p>' : ''}
									<p style="margin: 5px 0; font-size: 12px; color: #666;"><i class="fas fa-tag"></i> Type: ${hospital.amenity}</p>
									${distanceText ? '<p style="margin: 5px 0; font-size: 13px; color: #28a745; font-weight: bold;">' + distanceText.replace(/<[^>]*>/g, '') + '</p>' : ''}
								</div>
							`);

						markers.push(marker);
					}

					html += `
						<div class="card" style="padding: 20px; margin: 15px 0; background: linear-gradient(135deg, rgba(255, 245, 245, 0.8) 0%, rgba(255, 255, 255, 0.9) 100%); border: 1px solid rgba(220, 53, 69, 0.2); border-radius: 12px; transition: all 0.3s ease;">
							<div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
								<h5 style="color: #dc3545; margin: 0; font-weight: bold; font-size: 1.2rem;">
									<i class="fas fa-hospital" style="margin-right: 8px;"></i>${hospital.hname}
								</h5>
								${distanceText}
							</div>
							<div style="border-top: 1px solid rgba(220, 53, 69, 0.1); padding-top: 15px;">
								<p style="margin: 8px 0; color: #333; font-size: 14px;">
									<i class="fas fa-map-marker-alt" style="color: #dc3545; margin-right: 8px; width: 20px;"></i>
									<strong>Location:</strong> ${hospital.hcity || 'Not specified'}
								</p>
								${hospital.address && hospital.address !== 'Address not available' ? `
								<p style="margin: 8px 0; color: #333; font-size: 14px;">
									<i class="fas fa-home" style="color: #dc3545; margin-right: 8px; width: 20px;"></i>
									<strong>Address:</strong> ${hospital.address}
								</p>
								` : ''}
								${hospital.hphone && hospital.hphone !== 'Not available' ? `
								<p style="margin: 8px 0; color: #333; font-size: 14px;">
									<i class="fas fa-phone" style="color: #dc3545; margin-right: 8px; width: 20px;"></i>
									<strong>Phone:</strong> <a href="tel:${hospital.hphone}" style="color: #dc3545; text-decoration: none;">${hospital.hphone}</a>
								</p>
								` : ''}
								${hospital.hemail && hospital.hemail !== 'Not available' ? `
								<p style="margin: 8px 0; color: #333; font-size: 14px;">
									<i class="fas fa-envelope" style="color: #dc3545; margin-right: 8px; width: 20px;"></i>
									<strong>Email:</strong> <a href="mailto:${hospital.hemail}" style="color: #dc3545; text-decoration: none;">${hospital.hemail}</a>
								</p>
								` : ''}
								${hospital.website ? `
								<p style="margin: 8px 0; color: #333; font-size: 14px;">
									<i class="fas fa-globe" style="color: #dc3545; margin-right: 8px; width: 20px;"></i>
									<strong>Website:</strong> <a href="${hospital.website}" target="_blank" style="color: #dc3545; text-decoration: none;">Visit Website</a>
								</p>
								` : ''}
								<p style="margin: 8px 0; color: #666; font-size: 13px;">
									<i class="fas fa-tag" style="color: #dc3545; margin-right: 8px; width: 20px;"></i>
									<strong>Type:</strong> ${hospital.amenity.charAt(0).toUpperCase() + hospital.amenity.slice(1)}
								</p>
							</div>
						</div>
					`;
				});

				// Fit map to show all markers
				if (markers.length > 0) {
					const group = new L.featureGroup(markers);
					if (userMarker) {
						group.addLayer(userMarker);
					}
					map.fitBounds(group.getBounds().pad(0.1), { animate: false });
				}
			} else {
				html += '<p style="text-align: center; color: #666; padding: 30px; font-size: 16px;">No hospitals found in this area.</p>';
			}

			html += '</div>';
			
			// Lock scroll before updating
			const scrollY = window.scrollY || window.pageYOffset;
			const scrollX = window.scrollX || window.pageXOffset;
			
			resultsDiv.innerHTML = html;
			
			// Restore scroll position
			requestAnimationFrame(() => {
				window.scrollTo(scrollX, scrollY);
			});
		}

		function showUserLocation(location) {
			if (!map) {
				console.error('Map not initialized');
				return;
			}
			
			// Remove existing user marker
			if (userMarker) {
				map.removeLayer(userMarker);
			}

			// Create custom blue icon for user location with pulsing effect
			const userIcon = L.divIcon({
				className: 'user-location-marker',
				html: `
					<div style="
						background-color: #4285F4; 
						width: 24px; 
						height: 24px; 
						border-radius: 50%; 
						border: 4px solid white; 
						box-shadow: 0 2px 10px rgba(66, 133, 244, 0.5);
						position: relative;
						animation: pulse 2s infinite;
					">
						<div style="
							position: absolute;
							top: 50%;
							left: 50%;
							transform: translate(-50%, -50%);
							width: 8px;
							height: 8px;
							background-color: white;
							border-radius: 50%;
						"></div>
					</div>
					<style>
						@keyframes pulse {
							0% { transform: scale(1); opacity: 1; }
							50% { transform: scale(1.2); opacity: 0.8; }
							100% { transform: scale(1); opacity: 1; }
						}
					</style>
				`,
				iconSize: [24, 24],
				iconAnchor: [12, 12]
			});

			// Add user marker
			userMarker = L.marker([location.lat, location.lng], { 
				icon: userIcon,
				title: 'Your Location',
				zIndexOffset: 1000
			})
				.addTo(map)
				.bindPopup(`
					<div style="padding: 10px; text-align: center;">
						<strong style="color: #4285F4; font-size: 16px;">
							<i class="fas fa-map-marker-alt"></i> Your Location
						</strong>
						<p style="margin: 5px 0; font-size: 12px; color: #666;">
							Lat: ${location.lat.toFixed(6)}<br>
							Lng: ${location.lng.toFixed(6)}
						</p>
					</div>
				`)
				.openPopup();

			// Center map on user location with smooth animation
			map.setView([location.lat, location.lng], 13, {
				animate: true,
				duration: 0.5
			});
			
			// Ensure map is visible
			setTimeout(function() {
				if (map) {
					map.invalidateSize();
				}
			}, 100);
		}

		function findNearby(userLocation) {
			// Clear existing markers
			markers.forEach(marker => map.removeLayer(marker));
			markers = [];

			// Get real hospitals from OpenStreetMap first
			getRealHospitalsFromMap(userLocation);
			
			// Also fetch from database as backup
			fetch('file/getnearby.php?lat=' + userLocation.lat + '&lng=' + userLocation.lng)
				.then(response => response.json())
				.then(data => {
					// If no OSM results, show database results
					if (data.hospitals && data.hospitals.length > 0) {
						const resultsDiv = document.getElementById("nearbyResults");
						if (!resultsDiv.innerHTML.includes('Real Hospitals')) {
							displayResults(data, userLocation);
						}
					}
				})
				.catch(error => {
					console.error('Error:', error);
				});
		}

		function displayResults(data, userLocation, cityName = null) {
			// Hide hospital details section
			const resultsDiv = document.getElementById("nearbyResults");
			if (resultsDiv) {
				resultsDiv.style.display = 'none';
			}

			// Only show markers on map, no details cards
			if (data.hospitals && data.hospitals.length > 0) {
				data.hospitals.forEach(hospital => {
					// Add hospital marker if coordinates available
					if (hospital.latitude && hospital.longitude) {
						const hospitalIcon = L.divIcon({
							className: 'hospital-marker',
							html: '<div style="background-color: #dc3545; width: 25px; height: 25px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><i class="fas fa-hospital" style="color: white; font-size: 12px;"></i></div>',
							iconSize: [25, 25],
							iconAnchor: [12, 12]
						});

						const marker = L.marker([parseFloat(hospital.latitude), parseFloat(hospital.longitude)], { icon: hospitalIcon })
							.addTo(map)
							.bindPopup(`
								<div style="padding: 10px; min-width: 200px;">
									<h6 style="color: #dc3545; margin: 0 0 10px 0; font-weight: bold;">${hospital.hname}</h6>
									<p style="margin: 5px 0; font-size: 13px;"><i class="fas fa-map-marker-alt" style="color: #dc3545;"></i> ${hospital.hcity || 'N/A'}</p>
								</div>
							`);

						markers.push(marker);
					}
				});

				// Fit map to show all markers if any
				if (markers.length > 0) {
					const group = new L.featureGroup(markers);
					if (userMarker) {
						group.addLayer(userMarker);
					}
					map.fitBounds(group.getBounds().pad(0.1), { animate: false });
				}
			}

			// Display donors markers only (no details)
			if (userLocation && data.donors && data.donors.length > 0) {
				data.donors.forEach(donor => {
					if (donor.latitude && donor.longitude) {
						const donorIcon = L.divIcon({
							className: 'donor-marker',
							html: '<div style="background-color: #17a2b8; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"></div>',
							iconSize: [20, 20],
							iconAnchor: [10, 10]
						});

						const marker = L.marker([parseFloat(donor.latitude), parseFloat(donor.longitude)], { icon: donorIcon })
							.addTo(map)
							.bindPopup(`
								<div style="padding: 10px; min-width: 200px;">
									<h6 style="color: #dc3545; margin: 0 0 10px 0; font-weight: bold;">${donor.rname}</h6>
									<p style="margin: 5px 0; font-size: 13px;"><i class="fas fa-tint" style="color: #dc3545;"></i> Blood Group: <strong>${donor.rbg}</strong></p>
								</div>
							`);

						markers.push(marker);
					}
				});
			}
		}

		function calculateDistance(lat1, lon1, lat2, lon2) {
			const R = 6371; // Radius of the Earth in km
			const dLat = (lat2 - lat1) * Math.PI / 180;
			const dLon = (lon2 - lon1) * Math.PI / 180;
			const a = 
				Math.sin(dLat/2) * Math.sin(dLat/2) +
				Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
				Math.sin(dLon/2) * Math.sin(dLon/2);
			const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
			return R * c;
		}

		// Simple initialization - start immediately
		let mapInitAttempts = 0;
		function startMap() {
			mapInitAttempts++;
			
			if (typeof L !== 'undefined' && L && L.map) {
				initMap();
			} else if (mapInitAttempts < 200) {
				setTimeout(startMap, 50);
			} else {
				// Failed to load after 10 seconds
				const loadingDiv = document.getElementById('mapLoading');
				if (loadingDiv) {
					loadingDiv.innerHTML = '<i class="fas fa-exclamation-triangle" style="font-size: 30px; color: #dc3545; margin-bottom: 10px;"></i><p style="color: #dc3545; font-weight: bold;">Map library failed to load</p><p style="color: #666; font-size: 12px;">Please check your internet connection and refresh the page.</p><button onclick="location.reload()" style="margin-top: 10px; padding: 8px 15px; background: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">Refresh Page</button>';
				}
			}
		}

		// Set up button event listeners
		function setupButtons() {
			const getLocationBtn = document.getElementById('getLocationBtn');
			const searchLocationBtn = document.getElementById('searchLocationBtn');
			const searchInput = document.getElementById('searchLocation');
			
			if (getLocationBtn) {
				// Prevent drag on mousedown
				getLocationBtn.addEventListener('mousedown', function(e) {
					e.preventDefault();
					e.stopPropagation();
				}, true);
				
				// Handle click
				getLocationBtn.addEventListener('click', function(e) {
					e.preventDefault();
					e.stopPropagation();
					e.stopImmediatePropagation();
					e.cancelBubble = true;
					getLocation(e);
					return false;
				}, false);
			}
			
			if (searchLocationBtn) {
				// Prevent drag on mousedown
				searchLocationBtn.addEventListener('mousedown', function(e) {
					e.preventDefault();
					e.stopPropagation();
				}, true);
				
				// Handle click
				searchLocationBtn.addEventListener('click', function(e) {
					e.preventDefault();
					e.stopPropagation();
					e.stopImmediatePropagation();
					e.cancelBubble = true;
					searchLocation(e);
					return false;
				}, false);
			}
			
			if (searchInput) {
				searchInput.addEventListener('keypress', function(e) {
					if (e.key === 'Enter') {
						e.preventDefault();
						e.stopPropagation();
						e.stopImmediatePropagation();
						searchLocation(e);
						return false;
					}
				});
			}
		}
		
		// Start everything when page loads
		window.addEventListener('load', function() {
			setupButtons();
			startMap();
			
			// Load hospitals after map is ready
			setTimeout(function() {
				if (map && userLocation) {
					getRealHospitalsFromMap(userLocation, 'Mangalore');
				}
			}, 1000);
		});
		
		// Also try immediately if DOM is ready
		if (document.readyState !== 'loading') {
			setupButtons();
			startMap();
		}
		
		// Prevent any unwanted scroll behavior
		document.addEventListener('DOMContentLoaded', function() {
			// Prevent default anchor behavior
			document.querySelectorAll('a[href="#"]').forEach(anchor => {
				anchor.addEventListener('click', function(e) {
					e.preventDefault();
					e.stopPropagation();
				});
			});
			
			// Prevent form submission from causing scroll
			document.querySelectorAll('form').forEach(form => {
				form.addEventListener('submit', function(e) {
					e.preventDefault();
				});
			});
		});
	</script>
</body>
</html>

