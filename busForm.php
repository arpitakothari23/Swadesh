<!DOCTYPE html>
<html>
<head>
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<title>Search Bus</title>
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Prosto One' >
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Acme' >
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
	<style type="text/css">


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
		
.basic-grey {

    max-width: 560px;
    background: #F2F3F4;
    padding: 25px 15px 25px 10px;
    font: 15px Georgia, "Times New Roman", Times, serif;
    color: #888;
    text-shadow: 1px 1px 1px #FFF;
    border:1px solid #E4E4E4;
}
.basic-grey h1 {
    font-size: 25px;
    padding: 0px 0px 10px 40px;
    display: block;
    border-bottom:1px solid #E4E4E4;
    margin: -10px -15px 30px -10px;;
    color: #888;
}
.basic-grey h1>span {
    display: block;
    font-size: 12px;
}
.basic-grey label {
    display: block;
    margin: 0px;
}
.basic-grey label>span {
    float: left;
    width: 20%;
    text-align: right;
    padding-right: 10px;
    margin-top: 10px;
    color: #424949;
     font-family:  'Acme' ;
}
.basic-grey input[type="text"], .basic-grey input[type="email"], .basic-grey textarea, .basic-grey select {
    border: 1px solid #DADADA;
    color: #888;
    height: 30px;
    margin-bottom: 6px;
    margin-right: 6px;
    margin-top: 2px;
    outline: 0 none;
    padding: 3px 3px 3px 5px;
    width: 70%;
    font-size: 12px;
    line-height:15px;
    box-shadow: inset 0px 1px 4px #ECECEC;
    -moz-box-shadow: inset 0px 1px 4px #ECECEC;
    -webkit-box-shadow: inset 0px 1px 4px #ECECEC;
}

.basic-grey select {
    background: #FFF url('down-arrow.png') no-repeat right;
    background: #FFF url('down-arrow.png') no-repeat right);
    appearance:none;
    -webkit-appearance:none; 
    -moz-appearance: none;
    text-indent: 0.01px;
    text-overflow: '';
    width: 70%;
    height: 35px;
    line-height: 25px;
}

.basic-grey .button {
	margin-left: 450px;
    background: #3498DB  ;
    border: none;
    padding: 10px 25px 10px 25px;
    color: #FFF;
    box-shadow: 1px 1px 5px #B6B6B6;
    border-radius: 3px;
    text-shadow: 1px 1px 1px #9E3F3F;
    cursor: pointer;
}
.basic-grey .button:hover {
    background: #1F618D
}
.basic-grey .required{
    color:red;
}
  .heading  {
    font-size: 40px;
    padding: 10px 0px 10px 40px;
    display: block;
    border-bottom:1px solid #E4E4E4;
    margin: -10px -15px 30px -10px;
    color: #424949  ;
    font-family:'Prosto One';

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
</head>
<body>
  
<h1 class="heading">Search Bus</h1>
<form action="searchBus.php" name="searchBus" method="post" class="basic-grey" >
	
	
	 
	<label><span>From</span><input type="text" name="DepartFrom" list="DepartFrom" onkeyup="showHint(this.value , this.name)" required> <datalist id="DepartFrom"></datalist></label><br>
  <label><span>To</span><input type="text" name="DepartTo" list="DepartTo" onkeyup="showHint(this.value , this.name)" required> <datalist id="DepartTo"></datalist></label><br>
  <label><span>Depart Date</span><input type="date" name="depart" required> </label><br>
	
	<label><input type="submit" name="submit" class="button" value="Search"></label>
	

</form>
<button class="btn" onclick="history.back()"><i class="fa fa-arrow-left"></i></button> 



	<script type="text/javascript">

		
			function showHint(str , nam ) {
          
		    if (str.length == 0) { 		        
		        return;
		    } else {
		        var xmlhttp = new XMLHttpRequest();
		        xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {		   


		                var text = this.responseText;
		                var arrayText = text.split(",");
                        

				                       
					  var options = '';
					  for(var i = 0; i < arrayText.length; i++){
					  options += '<option value="'+arrayText[i]+'" />';}					  
					   document.getElementById(nam).innerHTML = options;
			             
                     
		            }
		        };
		        xmlhttp.open("GET",  "busFormAutoType.php?q="+str+"&value="+str+"&field="+nam , true);
                xmlhttp.send();
    }
}

	</script>

 
</body>
</html>
