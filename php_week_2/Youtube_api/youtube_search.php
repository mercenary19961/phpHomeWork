<?php
if (isset($_GET['query'])) {
    $query = urlencode($_GET['query']);
    $apiKey = 'AIzaSyDuwl-XKFIvgw9-KS7zzbBELBuY28W5HsA';
    $apiUrl = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=$query&type=video&key=$apiKey";

    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    if ($data && isset($data['items'])) {
        $results = $data['items'];
        $totalResults = count($results);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Search Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>YouTube Search</h1>
        <form action="youtube_search.php" method="get">
            <input type="text" name="query" placeholder="Search YouTube" required>
            <button type="submit">Search</button>
        </form>
        <?php if (isset($results) && !empty($results)): ?>
            <div id="result-count">
                Total Results: <?php echo $totalResults; ?>
            </div>
            <div id="results">
                <?php foreach ($results as $item): ?>
                    <div class="card">
                        <img src="<?php echo $item['snippet']['thumbnails']['default']['url']; ?>" alt="Thumbnail">
                        <h3><?php echo $item['snippet']['title']; ?></h3>
                        <p><?php echo $item['snippet']['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
