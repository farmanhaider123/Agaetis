
<!DOCTYPE html>
<html lang="en">
<head>
<style>
<meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</style>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

 
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
 
  <title>Weather App</title>
</head>
<body>
    <div class="container">
       
      <h1>What's The Weather?</h1> 
           
    <form>
  <fieldset class="form-group">
    <label for="city">Enter the name of a city.</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value = " ">
  </fieldset>
   <div id="contact_form">
 </div>
  <button type="submit" class="btn btn-primary">Submit</button>
 

  <div id="weather">
<?php
 $weather = "";
    $error = "";
    if ($_GET['city']) {
 $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=76226406d36653ba3f507915b6d69cb6");
         
        $weatherArray = json_decode($urlContents, true);
         
        if ($weatherArray['cod'] == 200) {
 
            $tempInCelcius = intval($weatherArray['main']['temp'] - 273);
 
            $weather .= " The temperature is ".$tempInCelcius."&deg;C ";
            
        } else {
             
            $error = "Could not find city - please try again.";
             
        }
         
    }
 
               
             
                   
               if ($error) {
                   
         echo '.$error.';
               
                   
              }
               
              ?></div>
      </div>
 
    
    </form>
</html>
<?php
  function convert2cen($value,$unit){
    if($unit=='C'){
      return $value;
    }else if($unit=='F'){
      $cen = ($value - 32) / 1.8;
        return round($cen,2);
      }
  }
?>
<?php
$cache_file = 'data.json';
if(file_exists($cache_file)){
  $data = json_decode(file_get_contents($cache_file));
}else{
  $api_url = 'https://content.api.nytimes.com/svc/weather/v2/current-and-seven-day-forecast.json';
  $data = file_get_contents($api_url);
  file_put_contents($cache_file, $data);
  $data = json_decode($data);
}
$current = $data->results->current[0];
$forecast = $data->results->seven_day_forecast;
?>
<style>
  body{
  
background: #21487F;
background: -webkit-radial-gradient(top, #21487F, #26454D);
background: -moz-radial-gradient(top, #21487F, #26454D);
background: radial-gradient(to bottom, #21487F, #26454D);
  }
  .wrapper .single{
    color:#fff;
    width:100%;
    padding:10px;
    text-align:center;
    margin-bottom:10px;
  }
  .aqi-value{
    font-family : "Noto Serif","Palatino Linotype","Book Antiqua","URW Palladio L";
    font-size:40px;
    font-weight:bold;
  }
  h1{
    text-align: center;
    font-size:3em;
  }
  .forecast-block{
    background-color: #3b463d!important;
    width:20% !important;
  }
  .title{
    background-color:#673f3f;
    width: 100%;
    color:#fff;
    margin-bottom:0px;
    padding-top:10px;
    padding-bottom: 10px;
  }
  .bordered{
    border:1px solid #fff;
  }
  .weather-icon{
    width:40%;
    font-weight: bold;
    background-color: #673f3f;
    padding:10px;
    border: 1px solid #fff;
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous" />
<div class="container wrapper">
  <br>
  
  <div class="row">
    <h3 class="title text-center bordered">Weather Report for <?php echo  $_GET['city'] ?></h3>
    <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
      <div class="single bordered" style="padding-bottom:25px;background:url('back.jpg') no-repeat ;border-top:0px;background-size: cover;">
        <div class="row">
          <div class="col-sm-9" style="font-size:20px;text-align:left;padding-left:70px;">
            <p class="aqi-value">
           <?php 
                   echo $tempInCelcius; 
                     ?>°C</p>
            
            <p class="weather-icon">
              
              <?php echo "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";?>
            </p>
            
  </div>
  <br><br>
  <div class="row">
    <h3 class="title text-center bordered">5 Days Weather Forecast for <?php echo $_GET['city'];?></h3>
    <?php $loop=0; foreach($forecast as $f){ $loop++;?>
      <div class="single forecast-block bordered">
        <h3><?php echo $f->day;?></h3>
        <p style="font-size:1em;" class="aqi-value"><?php echo convert2cen($f->low,$f->low_unit);?> °C - <?php echo convert2cen($f->high,$f->high_unit);?> °C </p>
        <hr style="border-bottom:1px solid #fff;">
        <img src="<?php echo $f->image;?>">
        <p><?php echo $f->phrase;?></p>
      </div>
    <?php } ?>
  </div>
<style>

*{
    box-sizing: border-box;
    margin:0;
    padding:0;
}

body{
    background:url('https://images.unsplash.com/photo-1621274403997-37aace184f49?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1');
    background-repeat: no-repeat;
    background-size:cover;
    overflow:hidden;
    height: 100vh;
    font-family: 'Poppins', sans-serif;
}


</style>
