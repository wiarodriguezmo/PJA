<?php
$date = new DateTime();
        $date2 = new DateTime('2012/06/15');
        
        $date->setTimeZone( new DateTimeZone('America/Bogota') );

        $interval = $date->diff( $date2 );

        echo $interval->format('%y Años');

?>
