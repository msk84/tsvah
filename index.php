<?php 

$apiKey = '';
$currentDate = date(DATE_RFC3339);
$currentDateUrl = urlencode($currentDate);

$plain_json = file_get_contents("https://www.googleapis.com/calendar/v3/calendars/vv0bmmltcm84p69ltm4jr5ivmo@group.calendar.google.com/events?key=$apiKey&timeMin=$currentDateUrl&orderBy=startTime&singleEvents=true");
$calendar_json = json_decode($plain_json, false, 5);

?>

<html>
<head>
	<title>TSV Einsingen AH - Kalender</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="icon" href="https://www.tsv-einsingen.de/wp-content/uploads/2022/04/cropped-favicon-32x32.png" sizes="32x32">
	<link rel="icon" href="https://www.tsv-einsingen.de/wp-content/uploads/2022/04/cropped-favicon-192x192.png" sizes="192x192">
</head>
<body>

<div class="container-fluid">
	<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
	  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
		<img src="https://www.tsv-einsingen.de/wp-content/uploads/2022/04/wappen.png" height="70" />
		<span class="fs-4 ms-4">TSV Einsingen AH</span>
	  </a>

	  <ul class="nav nav-pills">
		<!--<li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Kalender</a></li>-->
		<li class="nav-item"><a href="https://calendar.google.com/calendar/embed?src=vv0bmmltcm84p69ltm4jr5ivmo%40group.calendar.google.com&ctz=Europe%2FBerlin" class="nav-link" aria-current="page" target="_blank"><i class="bi bi-calendar3"></i> Google Calendar</a></li>
	  </ul>
	</header>
	<main>
		<table class="table table-striped">
			<thead>
			  <tr>
  			    <th scope="col">Datum</th>
			    <th scope="col">Termin</th>
			    <th scope="col">Ort</th>
			  </tr>
			</thead>

			<tbody>
			<?php

				foreach($calendar_json->items as $item){
					$itemStart = $item->start;
					$itemStartDateTime = strtotime($itemStart->dateTime);
					$itemStartDateTimeString = date('d.m.Y H:i', $itemStartDateTime);
					$locationUrlEncoded = urlencode($item->location);
					$locationUrl = "https://www.google.com/maps/search/?api=1&query=" . $locationUrlEncoded;
					
					echo "<tr>";
					echo "<td>$itemStartDateTimeString</td>";
					echo "<td>$item->summary</td>";
					echo "<td>
							<a class='btn btn-outline-secondary' role='button' href='$locationUrl' target='_blank'>
								<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pin-map' viewBox='0 0 16 16'>
									<path fill-rule='evenodd' d='M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z'></path>
									<path fill-rule='evenodd' d='M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z'></path>
								</svg>
							</a>
						</td>";
					echo "</tr>";
					
				}			
			?>
			</tbody>
		</table>
	</main>
	<footer class="container footer">
		<p>&copy; <a href="http://www.steinle.it/" target="_blank">steinle.it</a></p>
	</footer>
</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>

