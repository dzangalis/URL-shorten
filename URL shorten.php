<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>URL Shortener</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $longUrl = $_POST['longUrl'];
    $apiUrl = "https://cleanuri.com/api/v1/shorten";

    $serverTransfer = curl_init($apiUrl);

    $data = http_build_query(array('url' => $longUrl));

    curl_setopt($serverTransfer, CURLOPT_POST, 1);
    curl_setopt($serverTransfer, CURLOPT_POSTFIELDS, $data);
    curl_setopt($serverTransfer, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($serverTransfer, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

    $postRequest = curl_exec($serverTransfer);

    $decodeJson = json_decode($postRequest);
    $shortUrl = $decodeJson['result_url'];

    echo "<p>Short URL: <a href='$shortUrl'>$shortUrl</a></p>";
    curl_close($serverTransfer);
}
?>

<form method="post" action="">
    <label for="longUrl">Enter Long URL:</label>
    <input type="url" id="longUrl" name="longUrl" required>
    <button type="submit">Shorten URL</button>
</form>
</body>
</html>
