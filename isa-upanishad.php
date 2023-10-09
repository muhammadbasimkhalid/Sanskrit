
<?php include 'include/header.php'; ?>
<div class="inner_background shlok_inner" style="padding:0px;">
    <section class="banner_main">
        <div class="gita_banner">
            <div class="banner_img">
                <img src="images/isa-upanishad.jpeg" alt="Gita Banner">
            </div>
            <div class="banner_head">
                <p>ĪŚOPANIṢAD</p>
            </div>
            <div class="book_img">
                <img src="images/gita_open.png" alt="Gita Banner">
            </div>
        </div>
    </section>
    <!-- <section class="chapter_main">
        <div class="chapter_head">
            <p>ĪŚOPANIṢAD CHAPTERS</P>
        </div>
        <div class="chapter_container">
            
        </div>
    </section> -->
    <section class="shlok">
        <div class="shlok_main">
            <div class="shlok_container">
                <div class="shlok_other">
                    <div class="shlok-loader" style="display:none; height:0px;">
                        <div class="loader"></div>
                    </div>
                    <div class="error_box_shlok">
                        <p>Data Not Found</p>
                    </div>
                </div>
                <div class="shlok_area">
                </div>
            </div>
        </div>
        <div class="song_popup">
            <div class="deliveryOverlay"></div>
            <div class="song_pop_close">x</div>
            <div class="inner_background_pop">
                <div>
                    <center>
                        <div class="col-md-8 music_popup">
                            <div class="music-bg">
                                <div class="music_box_contral">
                                    <div class="music_pro">
                                        <div class="font_control">
                                            <div class="sild_controler">
                                                <div class="slid_cont_head"><b>Font Size: &nbsp;&nbsp;</b></p>
                                                    <div class="slid_cont_contaler">
                                                        <p style="font-size:18px ; margin-top: 6px;"> 12px</p>
                                                        <input type="range" min="12" max="65" id="font_control" />
                                                        <p style="font-size:18px ; margin-top: 6px;">65px</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <img class="projector_mode" src="images/projector_black.png"
                                                alt="Projector Mode" />
                                            <div class="projector_close">X</div>
                                        </div>
                                    </div>
                                    <div class="lyrics">
                                        <div class="music-single" id="lyrics"> </div>
                                        <audio class="audio" id="audio" style="width:100%; outline: none;" controls
                                            type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>

                                </div>
                            </div>
                    </center>
                </div>

            </div>
        </div>
    </section>
</div>
<?php include 'include/footer.php'; ?>
<script type="text/javascript">

    $(document).ready(function(){
        
        // for(var i = 1; i <= 18; i++ ){
        //     var chapter = '<div class="chapter" href="gita.php?q='+i+'"><div class="chapter_img"><img src="images/gita_book.jpg" alt="Chapter Background"></div><div class="chapter_num"> <p>'+i+'</p></div></div>';
        //     $(".chapter_container").append(chapter);
        // };

        $(".shlok_other").fadeIn();
        $(".shlok_other").children(".shlok-loader").fadeIn();
        $(".shlok").fadeIn();
        
        $.ajax({
            url: "api/upanishad.php?b=Isa Upanishad&q=0",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(data.message == "No Data found"){
                    $(".shlok_container").css({"height":"15em"});
                    $(".shlok_other").fadeIn();
                    $(".shlok_other").children(".shlok-loader").fadeOut();
                    $(".shlok_other").children(".error_box_shlok").fadeIn(); 
                }else{
                    for (var i =0; i < data.data.length; i++) {
                        $(".shlok_container").attr("style"," ");
                        $(".shlok_other").fadeIn();
                        $(".shlok_other").children(".shlok-loader").fadeOut();
                        $(".shlok_other").children(".error_box_shlok").fadeOut(); 
                        var shlok_no = data.data[i].shlok_no;
                        var lyrics = data.data[i].lyrics;
                        var songUrl = data.data[i].music;
                        var shlok_name = upanishadName(shlok_no);
                        
                        var div = '<div class="shlok_img" onClick="$(this).shlok();" ><img src="images/sletter.png" alt="Shlok Background"><div class="shlok_num"><p>'+shlok_name+'</p></div><div class="shlok_play" songUrl='+songUrl+'><span class="lyrics" style="display:none;">'+lyrics+'</span><img src="images/play.png" alt="Play Button"></div></div>';
                        $(".shlok_area").append(div);

                    }
                }
            },
            error: function (textStatus, errorThrown) {
                $(".shlok_container").css({"height":"15em"});
                    $(".shlok_other").fadeIn();
                    $(".shlok_other").children(".shlok-loader").fadeOut();
                    $(".shlok_other").children(".error_box_shlok").fadeIn(); 
                Success = false;

            }
        });

        
        /*
        var chapter = '<div class="chapter"><div class="chapter_img"><img src="images/gita_book.jpg" alt="Chapter Background"></div><div class="chapter_num"> <p>Whole Book</p></div></div>';
        $(".chapter_container").append(chapter);

        $(".chapter").click(function() {
           
            $(".shlok_other").fadeIn();
            $(".shlok_other").children(".shlok-loader").fadeIn();
            $(".shlok").fadeIn();
            $(this).parent().parent().fadeOut();
            // $(".shlok_head").children().text("CHAPTER " + $(this).children(".chapter_num").children("p").text());
            var chapNum = $(this).children(".chapter_num").children().text();
            
            if (chapNum == 'Whole Book') {
                chapNum = '0';
            }

            $.ajax({
                url: "api/upanishad.php?b=Isa Upanishad&q="+chapNum+"",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if(data.message == "No Data found"){
                        $(".shlok_container").css({"height":"15em"});
                        $(".shlok_other").fadeIn();
                        $(".shlok_other").children(".shlok-loader").fadeOut();
                        $(".shlok_other").children(".error_box_shlok").fadeIn(); 
                    }else{
                        for (var i =0; i < data.data.length; i++) {
                            $(".shlok_container").attr("style"," ");
                            $(".shlok_other").fadeIn();
                            $(".shlok_other").children(".shlok-loader").fadeOut();
                            $(".shlok_other").children(".error_box_shlok").fadeOut(); 
                            var shlok_no = data.data[i].shlok_no;
                            var lyrics = data.data[i].lyrics;
                            var songUrl = data.data[i].music;

                            var shlok_name = shlok_no;
                            if (shlok_no == 0) {
                                shlok_name = "Whole Chapter";
                            }else if (shlok_no == 99) {
                                shlok_name = "End of Chapter";
                            }

                            var div = '<div class="shlok_img" onClick="$(this).shlok();" ><img src="images/sletter.png" alt="Shlok Background"><div class="shlok_num"><p>'+shlok_name+'</p></div><div class="shlok_play" songUrl='+songUrl+'><span class="lyrics" style="display:none;">'+lyrics+'</span><img src="images/play.png" alt="Play Button"></div></div>';
                            $(".shlok_area").append(div);

                        }
                    }
                },
                error: function (textStatus, errorThrown) {
                    $(".shlok_container").css({"height":"15em"});
                        $(".shlok_other").fadeIn();
                        $(".shlok_other").children(".shlok-loader").fadeOut();
                        $(".shlok_other").children(".error_box_shlok").fadeIn(); 
                    Success = false;

                }
            });
        });

        $(".select_chap").click(function(){
            $(".shlok_other").fadeIn();
            $(".shlok_other").children(".shlok-loader").fadeIn();
            $(".shlok").fadeOut();
            $(".shlok").fadeIn();
            $(".shlok_area").html(" "); 
            var select = $(this).siblings("select").val();
            if(select ==  "Select"){
                alert("Select Chapter Again");
                $(".shlok_head").children().text("CHAPTER ");
            }else{
                $(".shlok_head").children().text("CHAPTER " + $(this).siblings("select").val());
            }
            var chapNum = $(this).siblings("select").val();
            console.log(chapNum);
            $.ajax({
                url: "api/upanishad.php?b=Isa Upanishad&q="+chapNum+"",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if(data.message == "No Data found"){
                        $(".shlok_container").css({"height":"15em"});
                        $(".shlok_other").fadeIn();
                        $(".shlok_other").children(".shlok-loader").fadeOut();
                        $(".shlok_other").children(".error_box_shlok").fadeIn(); 
                        }else{
                        for (var i =0; i < data.data.length; i++) {
                            
                            $(".shlok_container").attr("style"," ");
                            $(".shlok_other").fadeIn();
                            $(".shlok_other").children(".shlok-loader").fadeOut();
                            $(".shlok_other").children(".error_box_shlok").fadeOut(); 
                            var shlok_no = data.data[i].shlok_no;
                            console.log( shlok_no == "1");
                            var lyrics = data.data[i].lyrics;
                            var songUrl = data.data[i].music;
                                
                            var shlok_name = shlok_no;
                            if (shlok_no == 0) {
                                shlok_name = "Whole Chapter";
                            }else if (shlok_no == 99) {
                                shlok_name = "End of Chapter";
                            }

                            var div = '<div class="shlok_img" onClick="$(this).shlok();" ><img src="images/sletter.png" alt="Shlok Background"><div class="shlok_num"><p>'+shlok_name+'</p></div><div class="shlok_play" songUrl='+songUrl+'><span class="lyrics" style="display:none;">'+lyrics+'</span><img src="images/play.png" alt="Play Button"></div></div>';
                            $(".shlok_area").append(div);
                            
                        };
                    };
                },error: function (textStatus, errorThrown) {
                    $(".shlok_container").css({"height":"15em"});
                        $(".shlok_other").fadeIn();
                        $(".shlok_other").children(".shlok-loader").fadeOut();
                        $(".shlok_other").children(".error_box_shlok").fadeIn(); 
                    Success = false;

                }
            });

        });

        $(".back_chapter").click(function(){
            $(".shlok").fadeOut();
            $(".chapter_main").fadeIn();
            $(".shlok_area").html(" ");
        });

        */

        $.fn.shlok = function() {
            var music = $(this).children(".shlok_play").attr("songurl");
            var lyrics = $(this).children(".shlok_play").children(".lyrics").html();
            $(".audio").attr("src", music);
            $(".music-single").html(lyrics);
            $(".song_popup").fadeIn();
            
            $(".audio").attr("controls","true");
        };

        $(".song_pop_close").click(function(){
            $("#audio").get(0).pause();
            $(".song_popup").fadeOut();
            $(".music-single").html(" ");
            $(".audio").attr("src", " ");
        });

        
        $(".projector_mode").click(function(){

            $(this).parent().parent().parent().parent().parent().removeClass("col-md-8").addClass("col-md-12");
            $(".song_pop_close").hide();
            $(this).hide();
            $(".sild_controler").show();
            $(".projector_close").fadeIn();
            $(".music-single").addClass("music_pad");
            $(".lyrics").css({"font-size":"40px"});
            $(".music-single").css({"max-height": "65vh"});
            $(".music-single").css({"padding":"1em 4em"});
            
        });

        $(".projector_close").click(function(){
            $(".music-single").html(" ");
            $(".audio").attr("src", " ");
            $(".song_popup").hide();
            $("#audio").get(0).pause();
            $(".song_popup").hide();
            $(".music-single").removeClass("music_pad");
            $(".song_pop_close").show();
            $(".projector_mode").show()
            $(this).hide();
            $(".sild_controler").hide();
            $(".lyrics").css({"font-size":"17px"});
            $(".music-single").css({"padding":"1em 7em"});
            $(".music-single").css({"max-height": "65vh"});
            $(this).parent().parent().parent().parent().parent().removeClass("col-md-12").addClass("col-md-8");
        });

        $('#font_control').on('change',function(){
            var val = $(this).val();
            console.log(val);
            $(".music-single p").css({"font-size":val+"px"});
        });
        
    });

</script>