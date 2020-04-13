<?php 
echo (new DateTime())->sub(new DateInterval('P7D'))->format("Y-m-d");
 ?>