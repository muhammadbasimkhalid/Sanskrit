<?php include 'include/header.php'; ?>
<div class="inner_background">
    <div>
        <center>
            <?php
            
            if (!isset($_GET['s'])) {
                ?>
                <script>
                    window.alert("Please select a song.");
                    window.location.assign("index.php");
                </script>
                <?php
            }

            $s = $_GET['s'];

            $sql = "select * from music where mid = $s";
            $res = $conn->query($sql);
            if ($res->num_rows > 0) {
                $row = $res->fetch_assoc();
                ?>
                <div class="col-md-8">
                    <div class="music-bg" style="background-image: url('<?php echo $row['image']; ?>');">
                        <div class="lyrics">
                            <div class="music-single"><?php echo $row['lyrics']; ?></div>
                        </div>
                    </div>
                    <audio style="width:100%;" controls autoplay>
                        <source src="<?php echo $row['url']; ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                <?php
            }else {
                ?>
                <script>
                    window.alert("wrong selection. Please try again");
                    window.location.assign("index.php");
                </script>
                <?php
            }
            ?>
        </center>
    </div>
    <!-- <div class="container border_bg">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="inner_head">PRONUNCIATION</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="images/ppt_1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="images/ppt_2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="images/ppt_3.jpg" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="images/ppt_4.jpg" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="images/ppt_5.jpg" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="images/ppt_6.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>


        </div>
    </div>
    <div class="container border_bg">
        <div class="row">
            <div class="col-lg-12">
                <div class="image_text">
                    We provide Elementary Grammar books to learn Sanskrit as well as
                    two workbooks to learn the Devanagari Script in which Sanskrit is written.<br /></div>
                <p class="mt-3 p_txt">These books are used in our Primary School and elsewhere. <br> They are available
                    in <br>
                    Vedanta Bookhouse, Bangalore; <br> SPES, 49 Northumberland Road, D4,
                    Ireland <br> or by using the message section on this website. </p>
                <div class="box">
                    <p><span>1.</span> Saralaṃ Saṃskṛitam - Sanskrit The Easy Way Part 1 (€ 15)</p>
                    <p><span>2.</span> Saralaṃ Saṃskṛitam - Sanskrit The Easy Way Part 2 (€ 10)</p>
                    <p><span>3.</span> Saralaṃ Saṃskṛitam - Sanskrit The Easy Way Part 3 (€ 15)</p>
                    <p><span>4.</span> Paṭha Likha 1 – Reading And Writing Workbook 1 (€ 5)</p>
                    <p><span>5.</span> Paṭha Likha 2 – Reading And Writing Workbook 2 (€ 5)</p>
                </div>
            </div>
        </div>
    </div> -->
</div>
<?php include 'include/footer.php'; ?>