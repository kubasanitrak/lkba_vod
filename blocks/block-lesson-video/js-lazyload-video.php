<script>
	(function(){
		var youtube = document.querySelectorAll( ".youtube" );

		function setVideoThumbnail(vidDiv) {
		    if (vidDiv.dataset.vidhost == "vimeo") {
		        var x = new XMLHttpRequest();
		        x.open("GET", "http://vimeo.com/api/v2/video/" + vidDiv.dataset.embed +".xml", true);
		        x.onreadystatechange = function () {
		          if (x.readyState == 4 && x.status == 200)
		          {
		            var doc = x.responseXML;
		            source = doc.getElementsByTagName("thumbnail_large")[0].innerHTML;
		            var image = new Image();
		            image.src = source;
		            image.style.top = "0%";
		            image.addEventListener( "load", function() {
		                vidDiv.appendChild( image );
		            });
		          }
		        };
		        x.send(null);
		    } else {
		        var source = "https://img.youtube.com/vi/"+ vidDiv.dataset.embed +"/0.jpg";
		        var source = "http://img.youtube.com/vi/"+ vidDiv.dataset.embed +"/sddefault.jpg";
		        
		        var image = new Image();
		        image.src = source;
		        image.addEventListener( "load", function() {
		            vidDiv.appendChild( image );
		        });
		    } 
		}
		    
	    for (var i = 0; i < youtube.length; i++) {
	        setVideoThumbnail(youtube[i]);
	    }

	})();
</script>
<script >
	(function(){
		function setClickResponseFunction(vidDiv) {
		    var embedSrc;
		    if (vidDiv.dataset.vidhost === "vimeo") {
		        embedSrc = "https://player.vimeo.com/video/" + vidDiv.dataset.embed + "?autoplay=1";
		        // console.log("vimeo");
		    } else {
		    	// console.log("youtube");
		        embedSrc = "https://www.youtube.com/embed/" + vidDiv.dataset.embed + "?rel=0&showinfo=0&autoplay=1";
		    } 
		    
		    vidDiv.addEventListener( "click", function() {
		        var iframe = document.createElement( "iframe" );

		        iframe.setAttribute( "frameborder", "0" );
		        iframe.setAttribute( "allowfullscreen", "" );
		        iframe.setAttribute( "src", embedSrc );

		        this.innerHTML = "";
		        this.appendChild( iframe );
		    } );
		}

		function loadLazyVideos() {
		    var youtube = document.querySelectorAll( ".youtube" );
		    
		    for (var i = 0; i < youtube.length; i++) {
		        // setVideoThumbnail(youtube[i]);
		        setClickResponseFunction(youtube[i]);
		    }
		}

		loadLazyVideos();
	})();
</script>