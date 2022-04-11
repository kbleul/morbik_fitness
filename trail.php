
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Qahiri&family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="home.css">

    <script src="jquery-3.6.0.js"></script>
    <script src="index.js"></script>

    <title>Morbik Fitness</title>
</head>
<body id="dashboard_body">

    <article class="header_wrapper">
        <header class="flex">
            <a href="" id="logo_link"><img  id="logo_img" src="pics/logo.svg" alt="logo" ></a>
            <nav class="header_nav">
                <ul class="nav_list flex">
                    <li><a  class="nav_link" href="">Home</a></li>
                    <li><a  class="nav_link" href="">about</a></li>
                    <li><a class="nav_link" href="">contact</a></li>
                </ul>
            </nav>
           


        
        </header>
        <section class="setting_menu">
            <ul>
                <li><a href="account_info.php#schol_name" >Account Setting</a></li>
                <li><a href="logout.php" >Log Out</a></li>
            </ul>
        </section>
    </article>

   <main>
       <?php
$request = new HttpRequest();
$request->setUrl('https://edamam-recipe-search.p.rapidapi.com/search');
$request->setMethod(HTTP_METH_GET);

$request->setQueryData([
	'q' => 'chicken'
]);

$request->setHeaders([
	'X-RapidAPI-Host' => 'edamam-recipe-search.p.rapidapi.com',
	'X-RapidAPI-Key' => '6f086cff7fmshc85ad17d299aa15p12cc18jsn020d508320bc'
]);

try {
	$response = $request->send();

	echo $response->getBody();
} catch (HttpException $ex) {
	echo $ex;
       ?>
</main>

<script>
    const options = {
	method: 'GET',
	headers: {
		'X-RapidAPI-Host': 'edamam-recipe-search.p.rapidapi.com',
		'X-RapidAPI-Key': '6f086cff7fmshc85ad17d299aa15p12cc18jsn020d508320bc'
	}
};

const a = () = {
fetch('https://edamam-recipe-search.p.rapidapi.com/search?q=chicken', options)
	.then(response => response.json())
	.then(response => console.log(response))
	.catch(err => console.error(err));
} 
    a();
    </script>
</body>
</html>