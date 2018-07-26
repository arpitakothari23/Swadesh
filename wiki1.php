<!DOCTYPE html>
<html>
<head>
	<title>Wiki</title>
</head>
<body onload="getLocation()">
   
<div id="show"></div>
   
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


	<script type="text/javascript">

//from url

//getlocation

var lat;
var lng;
var addressComponents = [];
var wikiTitles = [];
var wikiLinks = [];

var x = document.getElementById("coords");

function getLocation() {
   var url_string = document.URL;
var url = new URL(url_string);
lat = url.searchParams.get("lat");
lng = url.searchParams.get("lng");


    LocationInfo();
}

//locationInfo

function LocationInfo() {
         
            

		        var xmlhttp = new XMLHttpRequest();
		        xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {		   

                        
		                var text = this.responseText;
		                var obj = JSON.parse(text);
		              //  document.getElementById("locationinfo").innerHTML = obj +"<br>"+ obj.results +"<br>"+ obj.status +"<br>"+ obj.results[0].address_components +"<br>"+ obj.results[0].address_components[0].long_name +"<br>"+ obj.results[0].address_components.length;

                        for(var i = 0; i<obj.results[0].address_components.length ; i++)
                        {
                           if(obj.results[0].address_components[i].types== 'route' || obj.results[0].address_components[i].types== 'neighborhood,political' || obj.results[0].address_components[i].types== 'political,sublocality,sublocality_level_1'|| obj.results[0].address_components[i].types== 'locality,political'|| obj.results[0].address_components[i].types== 'administrative_area_level_2,political'|| obj.results[0].address_components[i].types== 'administrative_area_level_1,political')
                           {
                           var join = "";
                            var long = obj.results[0].address_components[i].long_name;
                            var compo = long.split(" ");

                            for(var o=0; o<compo.length;o++)
                            {
                              join= join+compo[o];
                              addressComponents.push(join); 
                            }
                            

                           }                         

                        }

                     start();
                     
		                // console.log(text );
			             
                        
		            }
		        };
		        xmlhttp.open("GET",  "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&key=AIzaSyDDExKEazq41dfC6mzsnfYDuqy6VzOt7T8" , true); 

                xmlhttp.send();
   
}


//wikiInfo
 function wikipedia(term , time)
      {
      		var wikiLink ='https://en.wikipedia.org/w/api.php?action=opensearch&search='+term+'&format=json&origin=*';

			$.ajax(wikiLink, {
      	dataType: "json",
      	data: {
        	origin: "*"
      	},
      	type: "GET",
      		success: function(data) {
      			//console.log(data);

      			for(var i =0; i< data[1].length ; i++)
      			{
      				wikiTitles.push(data[1][i]);
      			    wikiLinks.push(data[3][i]);

                if(time == addressComponents.length-1)
                {show();}

      		   }
        	

      		}
  		});

      
		}

    /*  $(document).ready(function(){
      		wikipedia();

    });

*/

//forAllLocationComponents_getWikiLink
function start()
{
  for(var i = 0; i<=addressComponents.length ; i++)
  {

    wikipedia(addressComponents[i], i);

  }

  
}

var title;
var link;

function show()
{ var show='';
	

  for(var i = 0; i<wikiTitles.length ; i++)
  {  title = wikiTitles[i];
    link =wikiLinks[i];
     show = show + "<a href='"+link+"'>"+title+"</a><br>";

  }

  document.getElementById('show').innerHTML = show;
 
}

	</script>

</body>
</html>