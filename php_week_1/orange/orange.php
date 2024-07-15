<?php 
$phones = [
    [ 
        'name' => 'Samsung Galaxy Note 20 Ultra',
        'img_url' =>'https://images-ext-1.discordapp.net/external/ba28bNFyUmDwpif1GVL6NuNI3F4MguRgpgU5wXQNa4M/%3Fwid%3D1144%26hei%3D1144%26fmt%3Djpeg%26qlt%3D90%26.v%3D1635202842000/https/store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/refurb-iphone-12-pro-graphite-2020?format=webp&width=662&height=662',
        'rate' => '5',
        'brand' => 'Samsung',
        'price' => 'JOD 759.00',
        'is_out_of_stock' => '1'
    ],
    [ 
        'name' => 'INFINIX Zero 8',
        'img_url' =>'./images/p3.png',
        'rate' => '0',
        'brand' => 'Infinix',
        'price' => 'JOD 205.00',
        'is_out_of_stock' => '1'
    ],
    [ 
        'name' => 'Apple iPhone 12 Pro',
        'img_url' =>'./images/p4.png',
        'rate' => '0',
        'brand' => 'Apple',
        'price' => 'JOD 973.00',
        'is_out_of_stock' => '1'
    ],
    [ 
        'name' => 'ITEL A48',
        'img_url' =>'./images/p6.png',
        'rate' => '0',
        'brand' => 'iTel',
        'price' => 'JOD 66.00'
    ],
    [ 
        'name' => 'Samsung Galaxy S21 Ultra',
        'img_url' =>'./images/p7.png',
        'rate' => '0',
        'brand' => 'Samsung',
        'price' => 'JOD 799.00'
    ],
    [ 
        'name' => 'Galaxy A52',
        'img_url' =>'./images/p10.png',
        'rate' => '0',
        'brand' => 'Samsung',
        'price' => 'JOD 267.00'
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Phone | Orange Jordan E shop</title>
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/css/orange-helvetica.min.css" rel="stylesheet" integrity="sha384-ARRzqgHDBP0PQzxQoJtvyNn7Q8QQYr0XT+RXUFEPkQqkTB6gi43ZiL035dKWdkZe" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/css/boosted.min.css" rel="stylesheet" integrity="sha384-Di/KMIVcO9Z2MJO3EsrZebWTNrgJTrzEDwAplhM5XnCFQ1aDhRNWrp6CWvVcn00c" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="https://boosted.orange.com/docs/5.1/assets/brand/orange-logo.svg" width="50" height="50" role="img" alt="Boosted" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <?php foreach ($phones as $phone) : ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $phone['name']; ?></h5>
                            <p class="card-text">Rating: <?php echo $phone['rate']; ?></p>
                            <img src="<?php echo $phone['img_url']; ?>" class="card-img-top" alt="<?php echo $phone['name']; ?>">
                            <p class="card-text">Brand: <?php echo $phone['brand']; ?></p>
                            <p class="card-text">Price: <?php echo $phone['price']; ?></p>
                            <?php if (isset($phone['is_out_of_stock']) && $phone['is_out_of_stock'] == '1') : ?>
                                <p class="text-danger">Out of stock</p>
                            <?php else : ?>
                                <p class="text-success">In stock</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-Go0vJb6GhKNIBtwt9rCwOyrtCoxOvFsN6EUgpL8W/CXYM4GDXU8t4QWROceKpFTe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.bundle.min.js" integrity="sha384-PGAphkEesS3SSVh5I8GlXtdClICqW6fFqWyv7NDb3LsDqDX0PyQBxDOX9D5UtrtX" crossorigin="anonymous"></script>
</body>
</html>
