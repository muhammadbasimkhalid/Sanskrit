
<?php include 'include/header.php'; ?>

    
    <div class="inner_background" >
        <div class="click-loader">
                <div class="loader"></div>
        </div>
        <div class="error_box">
            <p>Data Not Found</p>
        </div>
        <div class="sans_songs">
            <p>Songs</p>
         </div>
        <div>
            <center id="main_center"></center>
        </div>
    <div class="song_popup">
        <div class="song_pop_close">x</div>                
        <div class="inner_background_pop">
            <div>
                <center>
                    <div class="col-md-8 music_popup">
                            <div class="music-bg">
                                    <div class="lyrics">
                                        <div class="music-single" id="lyrics"></div>
                                    </div>
                            </div>
                            <audio class="audio" id="audio" style="width:100%; outline: none;" controls autoplay type="audio/mpeg">
                                
                                Your browser does not support the audio element.
                            </audio>
                    
                        </div>
                </center>
            </div>
            <div class="deliveryOverlay"></div>
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?>


<script>
$(document).ready(function(){

     var url = new URL(document.URL);
     var q = url.searchParams.get("q");
    var request = new XMLHttpRequest();
    request.open('GET', 'api/index.php?q='+q+'', true);

    request.onreadystatechange = function (oEvent) {  
    if (request.readyState === 4) {  
        if (request.status === 200) {  
          
                request.onload = function () {
                $(".click-loader").fadeOut();
                $(".inner_background").fadeIn(); 
                var data = JSON.parse(this.response);
                // console.log(data);
                    for (var i =0; i < data.data.length; i++) {
                        var title = data.data[i].name;
                        var bgImg =data.data[i].image;
                        var lyrics = data.data[i].lyrics;
                        var songUrl = data.data[i].url;
                        var div = '<div class="col-md-2 music-list"><div class="music-bg" style="background-image: url('+bgImg+');"><div class="music" title="Play Song" url='+songUrl+'><span class="lyrics" style="display:none;">'+lyrics+'</span><div class="play_btn"><img src="images/play.png" alt="Play Button"></div></div></div><div class="song_name" title="Song: '+ title+ '"><p><span class="song_head">Song:</span>'+ title+ '</p></div></div>';
                        $("#main_center").append(div);           
                    }

                $(".music-list").click(function(){
                        var bg_img = $(this).children().attr("style");
                        var song_url = $(this).children().children().attr("url");
                        var lyrics = $(this).children().children().children(".lyrics").html();
                        $(this).parent().parent().siblings(".song_popup").children(".inner_background_pop").children().children().children().children(".music-bg").attr("style",bg_img);
                        $(this).parent().parent().siblings(".song_popup").children(".inner_background_pop").children().children().children().children(".music-bg").children().children().append(lyrics);
                        $(this).parent().parent().siblings(".song_popup").children(".inner_background_pop").children().children().children().children("audio").attr("src",song_url);
                        $(".song_popup").fadeIn();
                        $(".audio").attr("autoplay","true");
                        $(".audio").attr("controls","true");
                    });
                    $(".song_pop_close").click(function(){
                        $("#lyrics").html(" ");
                        $(".audio").attr("autoplay","false");
                        $("#audio").get(0).pause();
                        $(".song_popup").fadeOut();
                    });
                };
        } else {  
            $(".inner_background").fadeIn(); 
            $(".inner_background").css({"height":"35em"});
            $(".click-loader").fadeOut();
          $(".error_box").fadeIn();
        }  
    }  
}; 

    request.send(null);


});
  

    

      


</script>