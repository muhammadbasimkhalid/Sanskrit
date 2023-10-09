<?php include 'include/header.php'; ?>
<div class="inner_background">
    
    <div class="container border_bg">
        <div class="row">
            <div class="col-sm-12">
                <center>
                <input class="col-sm-9" type="text" name="text" id="searchText">
                <input class="col-sm-2" type="button" id="submitButton" value="Search">
                </center>
            </div>
        </div>
    </div>

    <div class="container border_bg">
        <div class="row">
            <div class="col-sm-12">
                <section class="chapter_main" style="padding-top: 0px;">
                    <div class="chapter_head">
                        <p>Search Results</P>
                    </div>
                </section>
                <div class="shlok_main">
                    <div class="shlok_container">
                        <div id="noResultContainer" class="empty-result">
                            <p>No Result Found</p>
                        </div>
                        <div id="loadingContainer" class="shlok-loader">
                            <div class="loader"></div>
                        </div>
                        <div id="listContainer" class="search-list-container clearfix">
                            <center id="list">
                                <!-- <div class="search-list col-sm-3">
                                    <div class="search-text">
                                        <p><span>song:</span> Hello</p>
                                    </div>
                                    <div class="search-play">
                                        <img src="images/play.png" alt="Play Button">
                                    </div>
                                </div> -->
                            </center>
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
                                                                <input type="range" min="12" max="65"
                                                                    id="font_control" />
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
                                                <audio class="audio" id="audio" style="width:100%; outline: none;"
                                                    controls type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>

                                        </div>
                                    </div>
                            </center>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include 'include/footer.php'; ?>

<script type="text/javascript">

    $(document).ready(function(){

        $('#loadingContainer').css("display", "none");
        $('#listContainer').css("display", "none");
        $('#noResultContainer').css("display", "block");

        $('#submitButton').click(function() {
            
            let searchText = $('#searchText').val();
            
            $('#loadingContainer').css("display", "block");
            $('#listContainer').css("display", "none");
            $('#noResultContainer').css("display", "none");

            $.ajax({
                url: "api/search.php?text="+searchText+"",
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    if (data.status == 200) {
                        $('#list').empty();
                        for (let index = 0; index < data.data.length; index++) {
                            let item = data.data[index];
                            let type = getSearchResultTypeName(item.type);
                            let name = getSearchResultName(item);
                            let songURL = item.song_url;
                            let lyrics = item.lyrics;
                            let listDiv = '<div class="search-list col-sm-3" onClick="$(this).shlok();"><div class="search-text"><p><span>'+ type +':</span> '+ name +'</p></div><div songurl="'+ songURL +'" class="search-play"><div style="display: none;" class="lyrics">'+ lyrics +'</div><img src="images/play.png" alt="Play Button"></div></div>';
                            $('#list').append(listDiv);
                        }
                        $('#loadingContainer').css("display", "none");
                        $('#listContainer').css("display", "block");
                        $('#noResultContainer').css("display", "none");
                    }else {
                        $('#loadingContainer').css("display", "none");
                        $('#listContainer').css("display", "none");
                        $('#noResultContainer').css("display", "block");
                    }

                },error: function (textStatus, errorThrown) {
                    $('#loadingContainer').css("display", "none");
                    $('#listContainer').css("display", "none");
                    $('#noResultContainer').css("display", "block");
                }
            });

        });

        $.fn.shlok = function() {
            var music = $(this).children(".search-play").attr("songurl");
            var lyrics = $(this).children(".search-play").children(".lyrics").html();

            // let check = $(this).children("")

            console.log(lyrics);

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