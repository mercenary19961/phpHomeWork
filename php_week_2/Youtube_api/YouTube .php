<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Search</title>
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
