<!doctype html>  
   <head>
   <meta charset="UTF-8">
   <title>Untitled Dossin Art History Project API</title>
   <link rel="icon" href="views/images/favicon.gif" type="image/x-icon"/>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
     <![endif]-->

   <link rel="shortcut icon" href="views/images/favicon.gif" type="image/x-icon"/> 
   <link rel="stylesheet" type="text/css" href="views/css/styles.css"/>
   <link href='http://fonts.googleapis.com/css?family=Cabin+Condensed' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
   <script type="text/javascript" language="Javascript" src="views/lib/jquery-1.7.1.min.js"></script>
   </head>
   <body>

   <!--start container-->
   <div id="container">

   <!--start header-->
   <header>

   <!--start logo-->
   <!-- <a href="#" id="logo"><img src="views/images/logo.png" width="221" height="84" alt="logo"/></a>     -->
   <span style="font-size:4em;">Untitled Dossin API</span> 
   <!--end logo-->
<div style="float:right;"><img width="" height="" border="0" alt="" src="http://i.minus.com/invNS0.png"> </div>
   <!--start menu-->

   <!-- <nav>
   <ul>
   <li><a href="#" class="current">Home</a></li>
   <li><a href="#">URLs and Params</a></li>
   </ul>
   </nav> -->
   <!--end menu-->

   <!--end header-->
   </header>

   <!--start intro-->

   <div id="intro">
   <div style="position:relative;height:100%;width:100%;background-color:white;">
<div style="color:white;text-align:center;margin-right:100px;margin-top:50px;float:right;position:relative;height:200px;width:200px;border-radius:50%;background-color:#FC3;padding:100px;"><span style="padding-left:15px;font-size:3em;font-family:'Open Sans Condensed';">pre-alpha!</span><div>(if you're using this you probably know about this project)</div> </div> 
   </div> 
   <!-- <img src="views/images/banner1_alpha.jpg"  alt="baner"> -->
   </div>
   <!--end intro-->

   <header class="group_bannner_left">
   <hgroup>
   <h1>API Documentation</h1>
   <h2>Here follows preliminary documentation for this simple API into Professor Catherine Dossin's art history data. 
   </h2>
   </hgroup>
   <!-- <div class="button black"><a href="#">Read more about our fresh ideas</a></div> -->
   </header>

   <!--start holder-->

   <div class="holder_content">

   <section class="group1">
   <h3>Generally</h3>
      <p>This is a RESTish interface into data Prof. Dossin collected about artists, exhibitions,and works in Europe during the 20th century. Exhibitions have been geocoded in two ways: by city and by exhibition space (when available). The API currently only returns city geometries, pending a more complete collection of exhibition spaces.</p>
      <p>This is a project with (for now) a very specific use case and is not meant to be usable (or desirable, for that matter) by just anybody.</p> 

   <!-- <article class="holder_gallery">
   <a class="photo_hover2" href="#"><img src="images/picture2.jpg" width="150" height="99" alt="picture1"/></a>
   <h2>Lorem ipsum</h2>
   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec molestie. Sed aliquam sem ut arcu. Phasellus sollicitudin. 
   Vestibulum condimentum  facilisis nulla. In hac habitasse platea dictumst.
   </p> <span class="read more"><a href="#">Read more..</a></span>
   </article>
    
   <article class="holder_gallery">
   <a class="photo_hover2" href="#"><img src="images/picture4.jpg" width="150" height="99" alt="picture1"/></a>
   <h2>Lorem ipsum</h2>
   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec molestie. Sed aliquam sem ut arcu. Phasellus sollicitudin. 
   Vestibulum condimentum  facilisis nulla. In hac habitasse platea dictumst.
   </p> <span class="read more"><a href="#">Read more..</a></span>
   </article>

   <article class="holder_gallery">
   <a class="photo_hover2" href="#"><img src="images/picture5.jpg" width="150" height="99" alt="picture1"/></a>
   <h2>Lorem ipsum</h2>
   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec molestie. Sed aliquam sem ut arcu. Phasellus sollicitudin. 
   Vestibulum condimentum  facilisis nulla. In hac habitasse platea dictumst.
   </p> <span class="read more"><a href="#">Read more..</a></span>
   </article> -->

   </section>

   <aside class="group2">
   <h3>Latest news</h3>
   
   <article class="holder_news">
   <h4>support for spatial added
      <span>2012.01.27</span></h4>
   <p>provide WKT-formatted polygon in polyfilter (see filters, below)</p>
   </article>
   
   <article class="holder_news">
   <h4>examples added
      <span>2012.01.26</span></h4>
   <p>see bottom of page for additional examples to real queries</p>
   </article>

   <article class="holder_news">
   <h4>demo goes live
   <span>2012.01.19</span></h4>
   <p>Initial demo with a route to filtered exhibitions goes live</p>
   </article>

  </aside>

   <section class="group3">
   <h3>API Documentation: Exhibitions</h3>

   <p>Something like this…
   <pre>http://geodev.lib.purdue.edu/dossin/api/exhibitions/geojson?\
   year_start=1946&year_end=1969&abstractexpress=1</pre>
   …will do pretty much what it says: return a geojson string, filtered by the specified year range and an "abstract expressionism" flag (in this case meaning the exhibition must have featured at least one work that could be classified in that genre). The following fields will be present:
   <ul>
<li>exhib_number</li>
<li>exhib_name</li>
<li>exhib_year</li>
<li>realism</li>
<li>surrealism</li>
<li>abstractexpress</li>
<li>postexpress</li>
<li>neodada</li>
<li>pop art</li>
<li>minimal</li>
<li>conceptualart</li>
<li>ismuseum</li>
<li>onlyus</li>
<li>exhib_from_us</li>
<li>the_geom</li>
</ul>
         
   </p>
   <p>Here "the_geom" is the centroid of the city in which the exhibition appeared, formatted for the requested output (in this case geojson). See below for a gloss on the meanings of the remaining fields.</p> 

   </section>

   <section class="group3">
   <h3>API Documentation: The Format</h3>
<p>In the example above, "geojson" is the format. Other available formats include:
<ul>
   <li>kml <div class="anno">(exhibition year as the time value)</div></li>
</ul>
         
…and that's it! Just the one. Technically there's a "debug" format, but it won't help you.
</p> 
   </section>

   <section class="group3" id="filters">
   <h3>API Documentation: The Filter</h3>
<p>In the example above, the returned data are filtered by year_start, year_end, etc. Other available parameters include:
<ul>
</ul>
</p> 
   </section> 
   
      <section class="group3">
   <h3>Quick Example</h3>
<p>If I want data for exhibitions in which <em>only</em> Abstract Expressionism was exhibited from 1946 to 1969, it would look like this for kml output:
<pre>http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?\
year_start=1946&year_end=1969&abstractexpress=1&realism=0\
&surrealism=0&postexpress=0&neodata=0&popart=0&minimal=0&conceptualart=0</pre>

(forward slashes are artificial breaks in order to make sure the entire URL displays -- remove them to use)
</p> 
<p>You can even test these in <a href="http://maps.google.com/maps?q=http:%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fkml%3Fyear_start%3D1946%26year_end%3D1969%26abstractexpress%3D1%26realism%3D0%26surrealism%3D0%26postexpress%3D0%26neodata%3D0%26popart%3D0%26minimal%3D0%26conceptualart%3D0&amp;hl=en&amp;sll=37.0625,-95.677068&amp;sspn=54.22533,60.644531&amp;vpsrc=0&amp;t=m&amp;z=5">Google Maps</a> or Earth, but be warned those services use default styling, and it's likely clients of this API will be doing their own interpretations of the data.</p> 
   </section> 
   
   
   <section class="group3">
   <h3>More Examples</h3>
<p><strong>ABSTRACT EXPRESSIONISM</strong></p>

<p><strong>1.1 maps for exhibitions of Abstract Expressionism from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;abstractexpress=1">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;abstractexpress=1">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26abstractexpress%3D1%0A%0A">heat</a> (generates kml)</p></div>

<p><strong>1.2 maps for exhibitions in which only Abstract Expressionism was exhibited from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;abstractexpress=1&amp;realism=0&amp;surrealism=0&amp;postexpress=0&amp;neodada=0&amp;popart=0&amp;minimal=0&amp;conceptualart=0">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;abstractexpress=1&amp;realism=0&amp;surrealism=0&amp;postexpress=0&amp;neodada=0&amp;popart=0&amp;minimal=0&amp;conceptualart=0">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26abstractexpress%3D1%26realism%3D0%26surrealism%3D0%26postexpress%3D0%26neodada%3D0%26popart%3D0%26minimal%3D0%26conceptualart%3D0%0A%0A">heat</a></p></div>

<p><strong>1.3 maps for museum exhibitions of Abstract Expressionism from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;abstractexpress=1&amp;ismuseum=1">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;abstractexpress=1&amp;ismuseum=1">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26abstractexpress%3D1%26ismuseum%3D1%0A%0A">heat</a></p></div>

<p><strong>1.4 maps for exhibitions of Abstract Expressionism sent from the United States from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;abstractexpress=1&amp;exhib_from_us=1">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;abstractexpress=1&amp;exhib_from_us=1">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26abstractexpress%3D1%26exhib_from_us%3D1%0A%20%0A">heat</a></p></div>

<br /> <br /> 
<p><strong>POP ART</strong></p>

<p><strong>2.1 maps for exhibitions of Pop Art from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;popart=1">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;popart=1">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26popart%3D1%0A%0A">heat</a></p></div>

<p><strong>2.2 maps for exhibitions in which only Pop Art was exhibited from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;abstractexpress=0&amp;realism=0&amp;surrealism=0&amp;postexpress=0&amp;neodada=0&amp;popart=1&amp;minimal=0&amp;conceptualart=0">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;abstractexpress=0&amp;realism=0&amp;surrealism=0&amp;postexpress=0&amp;neodada=0&amp;popart=1&amp;minimal=0&amp;conceptualart=0">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26abstractexpress%3D0%26realism%3D0%26surrealism%3D0%26postexpress%3D0%26neodada%3D0%26popart%3D1%26minimal%3D0%26conceptualart%3D0%0A%0A">heat</a></p>
</div>
<p><strong>2.3 maps for museum exhibitions of Pop Art from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;popart=1&amp;ismuseum=1">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;popart=1&amp;ismuseum=1">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26popart%3D1%26ismuseum%3D1%0A%0A">heat</a></p>
</div>
<p><strong>2.4 maps for exhibitions of Pop Art sent from the United States from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;popart=1&amp;exhib_from_us=1">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;popart=1&amp;exhib_from_us=1">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26popart%3D1%26exhib_from_us%3D1%0A%0A">heat</a></p>
</div>
<br /> <br /> 
<p><strong>EXHIBITIONS BY ARTIST</strong></p>

<p><strong>3.1 maps for exhibitions of Jackson Pollock from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;artistid=83">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;artistid=83">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26artistid%3D83%0A%0A">heat</a></p>
</div>
<p><strong>3.2 maps for exhibitions of Mark Rothko from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;artistid=127">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;artistid=127">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26artistid%3D127%0A%0A">heat</a></p>
</div>
<p><strong>3.3 maps for exhibitions of Robert Rauschenberg from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;artistid=171">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;artistid=171">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26artistid%3D171%0A%0A">heat</a></p>
</div>
<p><strong>3.4 maps for exhibitions of Roy Lichtenstein from 1946 to 1969</strong></p>

<div class="anno"><p><a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/kml?year_start=1946&amp;year_end=1969&amp;artistid=179">kml</a> <a href="http://geodev.lib.purdue.edu/dossin/api/exhibitions/debug?year_start=1946&amp;year_end=1969&amp;artistid=179">debug</a> <a href="http://geo.lib.purdue.edu/heatmapr/api/geojson/400/classic.kml?surl=http%3A%2F%2Fgeodev.lib.purdue.edu%2Fdossin%2Fapi%2Fexhibitions%2Fgeojson%3Fyear_start%3D1946%26year_end%3D1969%26artistid%3D179">heat</a></p> 
   </div>   </section>   

   </div>
   <!--end holder-->

   </div>
   <!--end container-->

   <!--start footer-->
   <footer>
   <div class="container">  
  <!--  <div id="FooterTwo"> © 2011 Fresh ideas </div>
   <div id="FooterTree"> Valid html5, css3, design and code by <a href="http://www.marijazaric.com">marija zaric - creative simplicity</a>   </div> --> 
   </div>
   </footer>
   <!--end footer-->
   <!-- Free template distributed by http://freehtml5templates.com --> 
   <script type="text/javascript" language="Javascript">


$.getJSON('http://geodev.lib.purdue.edu/dossin/api/dbfields/json', function(data) {

  var items = [];

  var results = data[1];


// alert(results.attname);

  $.each(results, function() {
   
    items.push('<li>'+ this.attname + " ("+this.type+")"+"<div class='anno'>" + this.desc +'</div></li>');

    
  });


// items.join('');

$('#filters > ul').append(items.join(''));

var nonstandardfilters = '<li>polylimit (<a href="http://en.wikipedia.org/wiki/Well-known_text">WKT-formatted</a> polygon)<div class="anno">only exhibitions located <em>within</em> the supplied polygon will be returned -- the string MUST be url encoded and should only include the coordinate pairs (not the "POLYGON((…" part nor the closing parentheses. As with WKT, the polygon should be closed off such that the last coordinate pair is the same as the first.</div> </li>';

$('#filters > ul').append(nonstandardfilters);

});


   </script>   
   </body>
</html>