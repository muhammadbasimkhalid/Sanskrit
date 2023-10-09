<?php include 'include/header.php'; ?>
<?php include 'admin/modals/connect.php'; ?>

<?php

if (!isset($_GET['music']) || !isset($_GET['type'])) {
    ?>
    <script>
        window.alert("Invalid selection.");
        window.location.assign("index.php");
    </script>
    <?php
}

$mid = $_GET['music'];
$type = $_GET['type'];

if ($mid == "" || $type == "") {
    ?>
    <script>
        window.alert("Invalid selection.");
        window.location.assign("index.php");
    </script>
    <?php
}

switch ($type) {
    case 'M':
        $sql = "select * from music where mid = $mid limit 1";
        break;
    case 'G':
        $sql = "select * from geeta where geeta_id = $mid limit 1";
        break;
    case 'U':
        $sql = "select * from upanishad where upanishad_id = $mid limit 1";
        break;
    default:
        ?>
        <script>
            window.alert("Invalid selection.");
            window.location.assign("index.php");
        </script>
        <?php
        break;
}


$album = "";
$lyrics = "";
$url = "";


$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();

    switch ($type) {
        case 'M':
            $album = $row['image'];
            $lyrics = $row['lyrics'];
            $url = $row['url'];
            break;
        
        default:
            break;
    }

}else {
    ?>
    <script>
        window.alert("Invalid selection.");
        window.location.assign("index.php");
    </script>
    <?php
}


?>

<div class="inner_background">
    <div class="col-md-12">
        <div class="flex-container">
            <div class="share-album">
                <img src="<?php echo $album; ?>" style="width: 100%;">
            </div>
            <div class="share-lyrics">
                <div class="slidecontainer">
                    <input type="range" min="1" max="100" value="0" class="slider" id="myRange">
                    <div class="lyrics-container">
                        <p class="share-lyrics-p" >
                            <?php echo $lyrics; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="share-seeker">
            <audio style="width:100%;" controls autoplay>
                <source src="<?php echo $url; ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
</div>

<script>

    var slider = document.getElementById("myRange");

    slider.oninput = function () {
        let fontSize = 20 + parseInt(this.value);
        let sizeStr = fontSize + 'px';
        changeBGColor(sizeStr);
    }

    function changeBGColor(val) {
        var cols = document.getElementsByClassName('lyrics-container');
        for (i = 0; i < cols.length; i++) {
            cols[i].style.fontSize = val;
        }
    }

</script>

<?php include 'include/footer.php'; ?>