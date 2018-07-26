<!DOCTYPE html>
<html>
<head>
	

	<title>360° Videos</title>
</head>
<body>

<div style="float: left">
<ul id="container" style="list-style-type: none">
	
	

	
	
	

</ul>
</div>

<div style="float: right">
	<iframe name="iframe_a" width="854" height="480" src="" frameborder="0" allow="autoplay; encrypted-media" 
allowfullscreen></iframe>
</div>



</body>


<script type="text/javascript">
var url_string = document.URL;
var url = new URL(url_string);
place = url.searchParams.get("q");


if (place=='Gangaur Ghat') {
  var container = document.getElementById("container") ;
  container.innerHTML = '<li> <a  href="https://www.youtube.com/embed/e_2HZO7034Q?autoplay=1&rel=0" target="iframe_a"> <img style="height: 192px; width: 342px;" src="IMG_20180726_124857.png"> </a> </li>';
  container.innerHTML += '<li> <a  href="https://www.youtube.com/embed/zLyBynBewIs?autoplay=1&rel=0" target="iframe_a"> <img style="height: 192px; width: 342px;" src="Screenshot (10).png"> </a> </li>';
  container.innerHTML += '<li> <a  href="https://www.youtube.com/embed/8tCxC5x-gCY?autoplay=1&rel=0" target="iframe_a"> <img style="height: 192px; width: 342px;" src="IMG_20180726_130259.png"> </a> </li>';

} else if (place=='Pratap Gaurav Kendra') {

    var container = document.getElementById("container") ;
  container.innerHTML = '<li> <a href="https://www.youtube.com/embed/u9wi1OhQxqs?autoplay=1&rel=0" target="iframe_a"> <img style="height: 192px; width: 342px;" src="IMG_20180726_130058.png"> </a></a> </li>';
} else {
   
}


</script>
</html>