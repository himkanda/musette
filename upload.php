<?php include("includes/includedfiles.php");

$artistquery = mysqli_query($con, "SELECT * FROM artists");
$genrequery = mysqli_query($con, "SELECT * FROM genres");
$username = $userLoggedIn->getUsername();

if ($username != 'HimanshuK') {
    exit();
}

?>
<script>
    $(document).ready(function () {
        off();
    })
    var page_title = "Upload";
    document.title = page_title;
    themeSwitch();
    $("body").scrollTop(0); 
</script>

<style>
    form * {
        color: blue;

    }

    #albumuploadcontainer {
        padding: 20px;
        background: #a0a0a0;
        margin: 5px;
    }

    input,
    select,
    textarea {
        margin: 10px 0;
        padding: 5px;
    }
</style>

<script>
    $(document).ready(function () {
        $('input[name="artworkpath"]').val('assets/images/artwork/');
        $('input[name="artistpic"]').val('assets/images/artistpic/');
        /*$('input[name="artworkpath"]').val('some value');
        $('input[name="artworkpath"]').val('some value');
        */
    });
    var changeTimer = false;

    $("#inputwiki").on("change keyup paste", function () {

        if (changeTimer !== false) clearTimeout(changeTimer);
        changeTimer = setTimeout(function () {
            var valyu = $("#inputwiki").val();

            valyu = valyu.replace(/ /g, "_");

            $.post("includes/handlers/ajax/wikipedia.php", { valyu: valyu }, function (data) {
                data = JSON.parse(data);
                var artistinfo = data[0][0];
                var albumart = data[1][0];
                var artist = data[2][0];
                console.log(albumart);
                artistinfo = artistinfo.replace(/"/g, "");
                artistinfo = artistinfo.replace(/'/g, "'");
                $("#textareawiki").val(artistinfo);


                console.log(data);
                var win = window.open('https://www.google.co.in/search?q=' + artist + '+300x300+pic&tbm=isch');
                return;
            })
            changeTimer = false;
        }, 1000);

    });


</script>


<div id="albumuploadcontainer">

    <span class="mainContentTop">Upload your album</span>
    <form action="includes/handlers/ajax/album-upload-form.php" method="post" id="album-upload-form">
        <input type="text" name="title" id="">Title <br>
        <input type="text" name="year" id=""> year <br>
        <input type="text" name="artworkpath" id=""> artworkpath <br>

        <select name="artists" id="artists"> artist <br>
            <option value="">select artist</option>
            <?php
            while ($row = mysqli_fetch_array($artistquery)) {
                echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
            }
            ?>
        </select>
        <select name="genres" id="genres"> genre <br>
            <option value="">select genre</option>
            <?php
            while ($row = mysqli_fetch_array($genrequery)) {
                echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
            }
            ?>
        </select>

        <input type="submit" name="submitalbum">

    </form>



</div>



<div id="albumuploadcontainer">

    <span class="mainContentTop">Upload your artist</span>
    <form action="includes/handlers/ajax/album-upload-form.php" method="post" id="album-upload-form">
        <input type="text" name="name2" id="inputwiki">Name <br>
        <input type="text" name="country" id=""> country <br>
        <input type="text" name="artistpic" id=""> artistpic <br>
        <textarea name="artistinfo" cols="40" rows="8" style="width: 90%" id="textareawiki"></textarea>artistinfo <br>




        <input type="submit" name="submitartist">

    </form>



</div>



<div id="albumuploadcontainer">

    <span class="mainContentTop">Upload your GENRES</span>
    <form action="includes/handlers/ajax/album-upload-form.php" method="post" id="album-upload-form">

        <input type="text" name="genreupload" id=""> genre <br>





        <input type="submit" name="submitgenre">

    </form>



</div>