<?php
if (isset($_GET['pokemon'])) {
    $pokemonName = strtolower($_GET['pokemon']);
    $apiUrl = "https://pokeapi.co/api/v2/pokemon/$pokemonName";

    $response = file_get_contents($apiUrl);
    $pokemon = json_decode($response, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Search Results</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top: 50px;
        }
        .content, .sidebar {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .content {
            flex: 2;
            margin-right: 20px;
        }
        .sidebar {
            flex: 1;
            max-width: 300px;
        }
        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .card img {
            max-width: 150px;
        }
        .card-details {
            text-align: center;
        }
        .card-header {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-header h3 {
            margin-left: 20px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar li {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Pokémon Search Results</h1>
            <form action="pokemon_search.php" method="get">
                <input type="text" name="pokemon" placeholder="Search Pokémon" required>
                <button type="submit">Search</button>
            </form>
            <?php if (isset($pokemon) && !empty($pokemon)): ?>
                <div class="card">
                    <div class="card-header">
                        <img src="<?php echo $pokemon['sprites']['front_default']; ?>" alt="<?php echo $pokemon['name']; ?>">
                        <h3><?php echo ucfirst($pokemon['name']); ?></h3>
                    </div>
                    <div class="card-details">
                        <p>Height: <?php echo $pokemon['height']; ?></p>
                        <p>Weight: <?php echo $pokemon['weight']; ?></p>
                        <p>Base Experience: <?php echo $pokemon['base_experience']; ?></p>
                        <p>Ability: <?php echo $pokemon['abilities'][0]['ability']['name']; ?></p>
                    </div>
                </div>
            <?php else: ?>
                <p>Pokémon not found. Please try again.</p>
            <?php endif; ?>
        </div>
        <div class="sidebar">
            <h2>Pokémon Names</h2>
            <ul>
                <li>Bulbasaur</li>
                <li>Charmander</li>
                <li>Squirtle</li>
                <li>Pikachu</li>
                <li>Jigglypuff</li>
                <li>Meowth</li>
                <li>Psyduck</li>
                <li>Machop</li>
                <li>Magnemite</li>
                <li>Geodude</li>
                <li>Onix</li>
                <li>Exeggcute</li>
                <li>Cubone</li>
                <li>Rhyhorn</li>
                <li>Chansey</li>
                <li>Kangaskhan</li>
                <li>Horsea</li>
                <li>Staryu</li>
                <li>Scyther</li>
                <li>Electabuzz</li>
            </ul>
        </div>
    </div>
</body>
</html>
