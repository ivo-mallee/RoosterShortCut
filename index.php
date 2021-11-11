<?PHP

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
@$selectedClass = $queries['Class'];
$ShortCut = array_key_exists('Class',$queries);

$currentWeekNumber = date('W');
echo "Weeknummer: $currentWeekNumber <br>";
$username = "ICT";
$password = "!135m3n";
$i = 10;
while (true) {
if (!$ShortCut) {$remote_url = "https://roosters.rocmondriaan.nl/ict/student/P2/$currentWeekNumber/c/c000$i.htm";}
if ($ShortCut) {$remote_url = "https://roosters.rocmondriaan.nl/ict/student/P2/$currentWeekNumber/c/c000$selectedClass.htm";}

  // Create a stream
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header' => "Authorization: Basic " . base64_encode("$username:$password")                 
  )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
@$file = file_get_contents($remote_url, false, $context);

@$Part1 = explode('<font size="6" face="Arial" color="#0000FF">',$file);
@$Part2 = explode('&nbsp',$Part1[1]);
@$class = $Part2[0];
if (str_contains($file, "TD") && !$ShortCut) {echo "<a href='?Class=$i'>Create $class Shortcut</a>";}
if (str_contains($file, "TD")) {echo "$file <br><br><br><br><br>";}
if (!$file) {break; echo "ERROR!";}
$i++;
if ($ShortCut) {break;}
}


if ($ShortCut) {echo "<a href='?'>Show All Schedules</a>";}


?>


