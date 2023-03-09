<?php
$id = (int)$_GET['id'];
$postFields = 'f game.id, game.name,url,game.first_release_date,game.summary,game.platforms.slug,game.platforms.name,game.genres.name; 
where id = ' . $id . '; l 1;';

function getData($url = "",  $postFields = "")
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_HTTPHEADER => array(
            'Client-ID: 1gdsndj0p60xua0ac6a6n7kcldeho8',
            'Authorization: Bearer im5fl0se5llzvdjv4py7eyvbsnaijk',
            'Content-Type: text/plain',
            'Cookie: __cf_bm=i6Ct3Bu80LLr8boRVUD1wxvgulosh8XFKTwuawwkfJQ-1678262079-0-AS34GswIhE0/1Ex1L6yfy/Av/Bcd19Ks+BwZ4W9MqR2TanALgtaOjKY62QlTvCm+BpUKZUqUeQ+J7autpnE0eo4='
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

$url = "https://api.igdb.com/v4/covers";
$response = getData($url, $postFields);

/*
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}*/

//echo $response;
$response_data = json_decode($response);
$game_data = $response_data;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gamestyle.css">
    <link rel="stylesheet" href="css/menu.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Game2Racker</title>
</head>

<body>
    <nav>
        <div class="banner">Game2Racker</div>
    </nav>

    <div class="container">




    <?php
    foreach ($game_data as $game) {
      
        echo "<div class = \"flex\">";
        echo "<div class = \"flex2\">";
        echo "<h1>" . $game->game->name . "</h1>";
        $timestamp = $game->game->first_release_date;
        echo gmdate("Y-m-d", $timestamp);
        echo "<p style = \"font-weight: bold;\">Genres</p>";
        foreach ($game->game->genres as $genre) {
            echo "<p>" . $genre->name . "</p>";
        }
        echo "<p style = \"font-weight: bold;\">Platforms</p>";
        foreach ($game->game->platforms as $platform) {
            echo "<p>" . $platform->name . "</p>";
        }
        
        echo "</div>";
        echo "<div class = \"flexkep\"";
        echo "<div class = \"kep\">";
        echo "<img src=\"" . str_replace("t_thumb", "t_1080p", $game->url) . "\">";
        echo "Rating";
        echo "<div class = \"rating\"";
        echo "
        
        <input type=\"radio\">
        <input type=\"radio\">
        <input type=\"radio\">
        <input type=\"radio\">
        <input type=\"radio\">
        <input type=\"radio\">
        <input type=\"radio\">
        <input type=\"radio\">
        <input type=\"radio\">
        <input type=\"radio\">
        <input type=\"radio\">
        ";
        echo "</div>";
        echo "</div>"; 
        echo "</div>"; 
        echo "</div>";
        echo "<div class = \"summary\"";
        echo "<p>" . $game->game->summary . "</p>";
        echo "</div>";
        echo "<div class = \"flex3\">";
        echo "<div class = \"comment\">
        <h1>Comment</h1>
    </div>";
        echo "</div>";
        
    }


    ?>
    <input type="radio" name="" id="">
</div>

</body>

</html>