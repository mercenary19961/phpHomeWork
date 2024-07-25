<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Search</title>
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
            <h1>Pokémon Search</h1>
            <form action="pokemon_search.php" method="get">
                <input type="text" name="pokemon" placeholder="Search Pokémon" required>
                <button type="submit">Search</button>
            </form>
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
