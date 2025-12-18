<?php
require 'file/connection.php';
session_start();
if(!isset($_SESSION['hid']))
{
  header('location:login.php');
}
else {
	if(isset($_SESSION['hid'])){
		$id=$_SESSION['hid'];
		$sql = "SELECT * FROM hospitals WHERE id='$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
	}
}
?>

<!DOCTYPE html>
<html>
<?php $title="Blood Lifestyle Tracking System | My Profile"; ?>
<?php require 'head.php';?>
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
    transition: all 0.3s ease;
    overflow: hidden;
  }
  
  .card:hover {
    box-shadow: 0 20px 50px rgba(220, 53, 69, 0.4);
    transform: translateY(-5px);
    border-color: rgba(220, 53, 69, 0.4);
  }
  
  .form-control {
    border: 2px solid rgba(220, 53, 69, 0.2);
    border-radius: 10px;
    padding: 12px 15px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.9);
  }
  
  .form-control:focus {
    border-color: #dc3545;
    box-shadow: 
      0 0 10px rgba(220, 53, 69, 0.3),
      0 0 0 0.2rem rgba(220, 53, 69, 0.15);
    transform: translateY(-2px);
    background: white;
  }
  
  .btn-primary {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
    border: none;
    border-radius: 10px;
    padding: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
  }
  
  .btn-primary:hover {
    background: linear-gradient(135deg, #c92a2a 0%, #a61e4d 100%);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
  }
  
  .btn-primary:active {
    transform: translateY(-1px) scale(0.98);
  }
  
  .rounded-circle {
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    transition: all 0.3s ease;
  }
  
  .rounded-circle:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
  }
  
  label {
    color: #dc3545;
    font-weight: 600;
    margin-bottom: 8px;
  }
  
  a {
    color: #dc3545;
    text-decoration: none;
    transition: all 0.3s ease;
  }
  
  a:hover {
    color: #c92a2a;
    text-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
  }
</style>
<body class="page-transition">
	<?php require 'header.php'; ?>
	
	<!-- Back Button -->
	<div style="position: fixed; top: 80px; left: 20px; z-index: 999;">
		<a href="hospitalpage.html" onclick="window.location.href='hospitalpage.html'; return false;" class="back-button" style="display: inline-flex; align-items: center; padding: 8px 15px; background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%); color: white; text-decoration: none; border-radius: 20px; font-weight: 600; box-shadow: 0 3px 10px rgba(220, 53, 69, 0.4); transition: all 0.3s ease; font-size: 14px;">
			<i class="fas fa-arrow-left" style="margin-right: 6px; font-size: 14px;"></i>
			<span>Back</span>
		</a>
	</div>

	<div class="container cont">

		<?php require 'message.php'; ?>

		<div class="row justify-content-center">
			<div class="col-lg-4 col-md-4 col-sm-6 mb-5">
				<div class="card">
					<div class="media justify-content-center mt-1">
						<img src="image/hospital.png" alt="profile" class="rounded-circle" width="70" height="60">
					</div>
					<div class="card-body">
					   <form action="file/updateprofile.php" method="post">
					   	<label class="text-muted font-weight-bold" class="text-muted font-weight-bold">Hospital Name</label>
						<input type="text" name="hname" value="<?php echo $row['hname']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold">Hospital Email</label>
						<input type="email" name="hemail" value="<?php echo $row['hemail']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold">Hospital Password</label>
						<input type="text" name="hpassword" value="<?php echo $row['hpassword']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold">Hospital Phone Number</label>
						<input type="text" name="hphone" value="<?php echo $row['hphone']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold">Hospital City</label>
						<input type="text" name="hcity" value="<?php echo $row['hcity']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold">Address</label>
						<input type="text" name="address" id="address" value="<?php echo isset($row['address']) ? $row['address'] : ''; ?>" class="form-control mb-3" placeholder="Enter full address">
						<input type="hidden" name="latitude" id="latitude" value="<?php echo isset($row['latitude']) ? $row['latitude'] : ''; ?>">
						<input type="hidden" name="longitude" id="longitude" value="<?php echo isset($row['longitude']) ? $row['longitude'] : ''; ?>">
						<button type="button" onclick="getCurrentLocation()" class="btn btn-info btn-block mb-3" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); border: none; color: white;">
							<i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i>Get Current Location
						</button>
						<div id="locationStatus" style="display: none; padding: 10px; margin: 10px 0; border-radius: 10px; background: rgba(40, 167, 69, 0.1); color: #155724;"></div>
						<input type="submit" name="update" class="btn btn-block btn-primary" value="Update">
					   </form>
					</div>
					<a href="hospitalpage.html" class="text-center">Cancel</a><br>
				</div>
			</div>
		</div>
	</div>
	<?php require 'footer.php'; ?>
	<script>
		function getCurrentLocation() {
			const statusDiv = document.getElementById("locationStatus");
			statusDiv.style.display = "block";
			statusDiv.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Getting your location...';

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(
					function(position) {
						const lat = position.coords.latitude;
						const lng = position.coords.longitude;
						
						document.getElementById("latitude").value = lat;
						document.getElementById("longitude").value = lng;
						
						// Reverse geocode using Nominatim (free, no API key)
						fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
							.then(response => response.json())
							.then(data => {
								if (data && data.display_name) {
									document.getElementById("address").value = data.display_name;
									statusDiv.innerHTML = '<i class="fas fa-check-circle"></i> Location captured successfully!';
									statusDiv.style.background = "rgba(40, 167, 69, 0.1)";
									statusDiv.style.color = "#155724";
								} else {
									statusDiv.innerHTML = '<i class="fas fa-check-circle"></i> Location captured (lat: ' + lat.toFixed(6) + ', lng: ' + lng.toFixed(6) + ')';
									statusDiv.style.background = "rgba(40, 167, 69, 0.1)";
									statusDiv.style.color = "#155724";
								}
							})
							.catch(error => {
								statusDiv.innerHTML = '<i class="fas fa-check-circle"></i> Location captured (lat: ' + lat.toFixed(6) + ', lng: ' + lng.toFixed(6) + ')';
								statusDiv.style.background = "rgba(40, 167, 69, 0.1)";
								statusDiv.style.color = "#155724";
							});
					},
					function(error) {
						statusDiv.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Error: ' + error.message;
						statusDiv.style.background = "rgba(220, 53, 69, 0.1)";
						statusDiv.style.color = "#721c24";
					}
				);
			} else {
				statusDiv.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Geolocation is not supported by this browser.';
				statusDiv.style.background = "rgba(220, 53, 69, 0.1)";
				statusDiv.style.color = "#721c24";
			}
		}

		// Address field - user can type manually or use geolocation
		document.getElementById("address").addEventListener('blur', function() {
			const address = this.value;
			if (address && address.length > 5) {
				// Try to geocode the address
				fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&limit=1`)
					.then(response => response.json())
					.then(data => {
						if (data && data.length > 0) {
							document.getElementById("latitude").value = data[0].lat;
							document.getElementById("longitude").value = data[0].lon;
						}
					})
					.catch(error => console.log('Geocoding failed'));
			}
		});
	</script>
</body>
</html>