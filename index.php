<?PHP



$currentWeekNumber = date('W');
$username = "ICT";
$password = "!135m3n";
$remote_url = "https://roosters.rocmondriaan.nl/ict/student/P2/$currentWeekNumber/c/c00056.htm";

// Create a stream
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header' => "Authorization: Basic " . base64_encode("$username:$password")                 
  )
);

$context = stream_context_create($opts);
echo "Weeknummer: $currentWeekNumber";
// Open the file using the HTTP headers set above
@$file = file_get_contents($remote_url, false, $context);
if ($file) {print($file);}
if (!$file) {echo "ERROR!";}
?>