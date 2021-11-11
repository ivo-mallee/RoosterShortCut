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
$remote_url = "https://roosters.rocmondriaan.nl/ict/student/P2/$currentWeekNumber/c/c000$i.htm";
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

if (!$ShortCut) {if ($file && $class!=NULL) {echo "<a href='?Class=$class'>Create $class Shortcut</a> $file <br><br><br><br><br>";}}
if ($ShortCut) {if ($file && $class!=NULL && str_contains($class, $selectedClass)) {echo "<a href='?Class=$class'>Create $class Shortcut</a> $file <br><br><br><br><br>";}}


if (!$file) {break; echo "ERROR!";}
$i++;
}


echo "<a href='?'>Show All Schedules</a>"


?>