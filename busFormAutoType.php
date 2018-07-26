<?php

		$connectionInfo = array( "Database"=>"VrVideos");
		$conn = sqlsrv_connect( ".\SQLEXPRESS", $connectionInfo);

		if ($conn===false) {
			die(print_r(sqlsrv_errors() , true));
		}
         
        $field = $_GET["field"];
        $value = $_GET["value"];
       
		$sql = "select distinct ".$field." from BusDetails                
                where ".$field." like '".$value."%'; " ;
		       
		  

          $params = array();
          $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

		$result = sqlsrv_query($conn, $sql ,$params ,$options);
             
     	if ($result===false) {
			die(print_r(sqlsrv_errors() , true));
		} 
        
   					$fieldData[] = "";
		           
     
		for ($i = 0; $i < sqlsrv_num_rows( $result ); $i++)
		   {
		         $line = sqlsrv_fetch($result);	
		         $field =sqlsrv_get_field($result , 0);		         
		         $fieldData[] = $field;		                
		    }

    
		     $h="";
			for ($i=0; $i < count($fieldData) ; $i++) { 
			global $fieldData;
		    $h=$h.$fieldData[$i].",";		           
		      
			}

			echo $h;


       $hint = "";
	   foreach($fieldData as $name) {	
	            $hint = $name;
	                           	}   
	  	if($hint === ""){echo "No Suggestion";}

?>
