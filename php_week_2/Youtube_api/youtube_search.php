<?php
$results = [];
$totalResults = 0;

if (isset($_GET['query'])) {
    $query = urlencode($_GET['query']);
    $apiKey = 'AIzaSyDuwl-XKFIvgw9-KS7zzbBELBuY28W5HsA';
    $maxResults = 20;
    $apiUrl = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=$query&type=video&maxResults=$maxResults&key=$apiKey";

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
    <style>
        body {
            background-color: blueviolet;
            color: white;
        }
        h1 {
            color: #f87171;
        }
        img {
            width: 400px;
            height: 250px;
        }
        #results {
            margin-top: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }
        .card {
            margin-bottom: 60px;
            margin-right: 50px;
            width: 400px;
            height: auto;
        }
        .card a {
            color: white;
            text-decoration: none;
        }
        .card a:hover {
            text-decoration: underline;
        }
        .card p {
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
        }
        .left_margin {
            margin-left: 75px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top_container">
            <h1 class="left_margin">YouTube Search</h1>
            <form action="youtube_search.php" method="get">
                <input class="left_margin" type="text" name="query" placeholder="Search YouTube" required>
                <button type="submit">Search</button>
            </form>
        </div>
        <?php if (!empty($results)): ?>
            <div id="result-count" class="left_margin">
                Total Results: <?php echo $totalResults; ?>
            </div>
            <div id="results">
                <?php foreach ($results as $item): ?>
                    <?php $videoUrl = "https://www.youtube.com/watch?v=" . $item['id']['videoId']; ?>
                    <div class="card">
                        <a href="<?php echo $videoUrl; ?>" target="_blank">
                            <img src="<?php echo $item['snippet']['thumbnails']['high']['url']; ?>" alt="Thumbnail">
                            <h3><?php echo htmlspecialchars($item['snippet']['title']); ?></h3>
                        </a>
                        <p><?php echo htmlspecialchars($item['snippet']['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
