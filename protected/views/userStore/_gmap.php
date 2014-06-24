<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
if(isset($model))
{
	$location = $model->address . ', '. $model->location_id . ', ' . $model->state_id . ' '. $model->zip;
	$cName = $model->name;
}
else
{
	$location = '1600 Amphitheatre Pky Mountain View CA';
	$cName = 'PledgeON';
}

/*
$this->widget('application.extensions.gmap.GMap', array(
    'id' => 'gmap',//id of the <div> container created
    //'key' => '...', //goole API key, should be obtained for each site,it's free
    'label' => $cName, //text written in the text bubble
    'address' => array(
        'address' => $location,//address of the place
        'city' => '', //city
        //'state' => 'CA'//state
        //'country' => 'USA' - country
        //'zip' => 'XXXXX' - zip or postal code
        )
));
*/

$location = str_replace('#','',$location);
$location = str_replace(' ','+',trim($location));
$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$location.'&sensor=false');
$output= json_decode($geocode);
$lat = $output->results[0]->geometry->location->lat;
$long = $output->results[0]->geometry->location->lng;
/*
$x = 'http://maps.google.com/staticmap?&size=240x280&center='.$lat.','.$long.'&markers='.$lat.','.$long.'&zoom=14&maptype=roadmap$sensor=false';
*/
//echo "<img src='$model->image_path' width=240 height=280>";
?>


<iframe id="map" width="340" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?z=14&amp;output=embed&amp;ll=<?php echo $lat; ?>, <?php echo $long; ?>&amp;q=<?php echo $location; ?>&amp;iwloc=A"></iframe>
