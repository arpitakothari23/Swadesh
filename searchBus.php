
<!DOCTYPE html>
<html>
<head>
    <title>Bus Results</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">        
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Alice' >      
        <style type="text/css">


.table-all{border-collapse:collapse;border-spacing:0;width:100%;display:table ; border:1px solid #ccc}
.table-all tr{border-bottom:1px solid #ddd}
.table-all tr:nth-child(odd){background-color:#fff}
.table-all tr:nth-child(even){background-color:#f1f1f1}
.centered tr th,.centered tr td{text-align:center}
.table-all td{padding:8px 8px;display:table-cell;text-align:left;vertical-align:top ; font-family: 'Alice';}
.table-all th{padding:8px 8px;display:table-cell;text-align:left;vertical-align:top ; font-weight: bold ;}
.table-all th:first-child,.table-all td:first-child{padding-left:16px}


        

.header {
  overflow: hidden;
  background-color:#FDFEFE  ;
  background: url('book-library-header-2109a.jpg');
  background-repeat: repeat-x;
   background-size: contain;
	

}

.header img {
  margin-right: 0px;
  border-radius: 0px;
  float: right;
}


	.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color:#17202A  ;
   color: white;
   text-align: center;
}

.btn {
    background-color: DodgerBlue;
    border: none; 
    color: white; 
    padding: 12px 16px; 
    font-size: 20px; 
    cursor: pointer;
}
.btn:hover {
    background-color: RoyalBlue;
}
   
.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}


        </style>

        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
</head>
<body>
 
<button class="btn" onclick="history.back()"><i class="fa fa-arrow-left"></i></button> 


</body>
</html>

<?php 
ini_set('max_execution_time', 300);

if (isset($_POST["submit"])) {

       



		$connectionInfo = array( "Database"=>"VrVideos");
		$conn = sqlsrv_connect( ".\SQLEXPRESS", $connectionInfo);

		if ($conn===false) {
			die(print_r(sqlsrv_errors() , true));
		}



          $DepartFrom = $_POST["DepartFrom"];
          $DepartTo = $_POST["DepartTo"];
          
              
       
			    	$sql2 = "select Buses.BusOperator , BusDetails.DepartFrom , BusDetails.DepartTo , Buses.BusType , Buses.Amenities , BusDetails.BoardingPoint , BusDetails.DroppingPoint, convert(varchar(50), BusDetails.DepartTime, 24)  , convert(varchar(50), BusDetails.ArriveTime, 24) , BusDetails.Duration , BusDetails.price , Buses.Ratings
              from [VrVideos].[dbo].[Buses]
              left join [VrVideos].[dbo].[BusDetails] on [Buses].BusId = [BusDetails].BusId
              where 1 =1";

                      if (!empty($DepartFrom)) {
                      	$sql2  = $sql2 . "and DepartFrom like '".$DepartFrom."'";
                      }
                      if (!empty($DepartTo)) {
                      		$sql2  = $sql2 . "and DepartTo like '".$DepartTo."'";
                      }
                     



          $params = array();
          $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

		$result2 = sqlsrv_query($conn, $sql2 ,$params ,$options);
        
     
     	if ($result2===false) {
			die(print_r(sqlsrv_errors() , true));
		} 
        

   			    		$BusOperator[] = "";
		            $DepartFrom_[] = "";
		            $DepartTo_[] = "";		           		           
		            $BusType[] = "";
		            $Amenities[] = "";
		            $BoardingPoint[] = "";
		            $DroppingPoint[] = "";	
		            $DepartTime[] = "";	
		            $ArriveTime[] = "";
                $Duration[] = "";
                $price[] = "";
                $Ratings[] = "";
                
     
		for ($i = 0; $i < sqlsrv_num_rows( $result2 ); $i++)
		   {
		         $line = sqlsrv_fetch($result2);	
            $field6 =sqlsrv_get_field($result2 , 0);	        
		         $field7 =sqlsrv_get_field($result2 , 1);
		          $field8 =sqlsrv_get_field($result2 , 2);
		           $field9 =sqlsrv_get_field($result2 , 3);
		            $field10 =sqlsrv_get_field($result2 , 4);
		             $field11 =sqlsrv_get_field($result2 , 5);
		              $field12 =sqlsrv_get_field($result2 , 6);
		               $field13 =sqlsrv_get_field($result2 , 7);
		                $field14 =sqlsrv_get_field($result2 , 8);
		                 $field15 =sqlsrv_get_field($result2 , 9);
		                  $field16 =sqlsrv_get_field($result2 , 10);
                       $field17 =sqlsrv_get_field($result2 , 11);
		          
           $BusOperator[] = $field6;         
		        $DepartFrom_[] = $field7;		         
		         $DepartTo_[] = $field8;
		          $BusType[] = $field9;		             
	               $Amenities[] = $field10;
	                $BoardingPoint[] = $field11;
	                 $DroppingPoint[] = $field12;
	                  $DepartTime[] = $field13;
	                   $ArriveTime[] = $field14;
	                    $Duration[] = $field15;
	                     $price[] = $field16;
                        $Ratings[] = $field17;

		    }


$Display = "";




	$Display = $Display . "<table class='table-all centered'>" ; 
	$Display = $Display . " <tr><th>BUS OPERATOR</th><th>DEPART FROM</th><th>DEPART TO</th><th>BUS TYPE</th> <th>AMENITIES</th> <th>BOARDING POINTS</th> <th>DROPPING POINTS</th> <th>DEPART TIME</th> <th>ARRIVE TIME </th> <th>DURATION</th> <th>PRICE</th> <th>RATINGS</th> </tr> ";

	for ($i=1; $i < count($BusOperator) ; $i++) { 
      
    $str1 = "";  
    $droppingPoints = explode("*", $DroppingPoint[$i]);
    for($j=0; $j < count($droppingPoints) ; $j++)
    {
      $str1 = $str1.$droppingPoints[$j]."<br>" ;
    }

     $str2 = "";  
    $boardingPoints = explode("*", $BoardingPoint[$i]);
    for($j=0; $j < count($boardingPoints) ; $j++)
    {
      $str2 = $str2.$boardingPoints[$j]."<br>" ;
    }

     $str3 = "";  
    $amenities = explode("*", $Amenities[$i]);
    for($j=0; $j < count($amenities) ; $j++)
    {
      $str3 = $str3.$amenities[$j]."<br>" ;
    }


		$Display = $Display . "<tr><td>".$BusOperator[$i]."</td><td>".$DepartFrom_[$i]."</td><td>".$DepartTo_[$i]."</td><td>".$BusType[$i]."</td> <td>".$str3."</td> <td>".$str2."</td> <td>".$str1."</td><td>".$DepartTime[$i]."</td><td>".$ArriveTime[$i]."</td> <td>".$Duration[$i]."</td> <td>".$price[$i]."</td> <td>".$Ratings[$i]."</td></tr> ";	



}
$Display = $Display . "</table>";



echo $Display;






}

?>

