<?php 
if (isset($_GET['movieSmt'])) {

	$recentMovies=$_GET['movie'];
	setcookie("movie",$recentMovies, time() + (86400 * 30), "/");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Movie Details|| <?php if(!empty($_GET['movie'])) echo $_GET['movie'];?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel = "icon" type = "image/png" href = "<?php if (isset($_GET['movieSmt'])) {
		echo $posterUrl;
	}?>">
	<style>
	body{
		background-image: url('');
		color:#000;
	}
		.ratings_wrapper {
		    float: right;
		    position: relative;
		    margin-left: 5px;
		    width: 185px;
		    z-index: 2;
		}
		.rating{
			    background: url(https://m.media-amazon.com/images/G/01/imdb/images/title/title_overview_sprite-1705639977._V_.png) no-repeat;
    background-position: -15px -118px;
    float: left;
    font-size: 11px;
    height: 40px;
    line-height: 13px;
    padding: 2px 0 0 34px;
    width: 58px;
		}
		.subtext{
			    font-size: 11px;
    			color: #FFF;
		}

		.poster{
			border: 2px solid #FFF;
		}
		.plot{
			background-color: #000;
			-webkit-box-shadow: 3px 9px 4px 3px #28547e ; /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
  -moz-box-shadow:    3px 9px 4px 3px #28547e ; /* Firefox 3.5 - 3.6 */
  box-shadow:         3px 9px 4px 3px #28547e ; /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */
		}
		.info{
			background-color: #212529cf;
			color: #FFF;
		}
		.main{
			background-color: #11668db8;
			padding: 5px;
			-webkit-box-shadow: 3px 3px 5px 6px #ccc;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
  -moz-box-shadow:    3px 3px 5px 6px #ccc;  /* Firefox 3.5 - 3.6 */
  box-shadow:         3px 3px 5px 6px #ccc;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */
		}


	</style>
</head>
<body>
<div class="container">
		<h5 class="enter">Enter the name of the movie you want to view details about</h5>
	<form method="GET">
  <div class="form-group">
    <label for="exampleInputEmail1" class="enter">Movie Name</label>
    <input type="text" class="form-control" aria-describedby="movieHelp" placeholder="Enter movie name" name="movie" value="<?php if(isset($_GET['movieSmt'])) echo $_GET['movie'];?>">
</div>
<label>Select Parameters to display:</label><br>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" value="T" id="defaultCheck1" name="plot" checked>
  <label class="form-check-label" for="defaultCheck1">
    Plot
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" value="T" id="defaultCheck2" name="director" checked>
  <label class="form-check-label" for="defaultCheck1">
    Director(s)
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" value="T" id="defaultCheck3" name="writer" checked>
  <label class="form-check-label" for="defaultCheck1">
Writer(s)
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" value="T" id="defaultCheck4" name="star" checked>
  <label class="form-check-label" for="defaultCheck1">
Stars
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="T" id="defaultCheck5" name="boc" checked>
  <label class="form-check-label" for="defaultCheck1">
Box Office Collection 
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" value="T" id="defaultCheck6" name="production" checked>
  <label class="form-check-label" for="defaultCheck1">
    Production
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" value="T" id="defaultCheck7" name="lang" checked>
  <label class="form-check-label" for="defaultCheck1">
Language Available
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="T" id="defaultCheck8" name="dvd" checked>
  <label class="form-check-label" for="defaultCheck1">
 DVD release
  </label>
</div>
  <button type="submit" class="btn btn-primary" name="movieSmt">Search</button>
</form><br>
<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://www.omdbapi.com/?apikey=41a2a50d&t=".urlencode($_GET['movie']),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Postman-Token: 97c1e692-a523-4cae-9cff-6e59d24552ae",
    "cache-control: no-cache"
  ),
));

$movie_json = curl_exec($curl);
$movie_array=json_decode($movie_json,true);
$err = curl_error($curl);
$posterUrl=$movie_array['Poster'];

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
}
else{
?>
<!-- Styling of the result -->

	<div class="main">
		

		<div class="ratings_wrapper">
		<div class="rating"><h4><?php echo $movie_array['Ratings'][0]['Value'];?></h4></div>
		</div>
		<h3><?php echo $movie_array['Title'];?>(<?php echo $movie_array['Year'];?>)</h3>
		<div class="subtext"><?php echo $movie_array['Rated'].'   |   '.$movie_array['Runtime'].'   |   '.$movie_array['Genre'].'   |   '.$movie_array['Released'];?></div><br>
		<div class="poster"><img src="<?php echo $posterUrl;?>" alt="<?php echo $movie_array['Title'];?>" title="<?php echo $movie_array['Title'];?>"/ height="350px" width="250px"></div>
		<div class="plot text-white" style="display: <?php if(empty($_GET['plot'])) echo 'none';?>"><h3>Plot:</h3><p><?php echo $movie_array['Plot'];?></p></div>
		
		<div class="info">
			<span style="display: <?php if(empty($_GET['director'])) echo 'none';?>"><b>Director: </b><?php echo $movie_array['Director'];?><br></span>
			<span style="display: <?php if(empty($_GET['writer'])) echo 'none';?>"><b>Writers: </b><?php echo $movie_array['Writer'];?><br></span>
			<span style="display: <?php if(empty($_GET['star'])) echo 'none';?>"><b>Stars: </b><?php echo $movie_array['Actors'];?><br></span>
			<span style="display: <?php if(empty($_GET['boc'])) echo 'none';?>"><b>Box Office Collection:</b><?php echo $movie_array['BoxOffice'];?><br></span>
			<span style="display: <?php if(empty($_GET['production'])) echo 'none';?>"><b>Production:</b><?php echo $movie_array['Production'];?><br></span>
			<span style="display: <?php if(empty($_GET['lang'])) echo 'none';?>"><b>Language Available:</b><?php echo $movie_array['Language'];?><br></span>
			<span style="display: <?php if(empty($_GET['dvd'])) echo 'none';?>"><b>DVD Release: </b><?php echo $movie_array['DVD'];?><br></span>

		</div>
	</div>
</div>
<?php	
}
?>
</body>
</html>