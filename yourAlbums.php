<?php
include("includes/includedFiles.php");
$username = $userLoggedIn->getUsername();
$songQueryAll = mysqli_query($con2, "SELECT library FROM $username ORDER BY RAND()");
$songIdArrayAll = array();
while ($row = mysqli_fetch_array($songQueryAll)) {
    array_push($songIdArrayAll, $row['library']);
}

?>
<script>
    $(document).ready(function () {
        var sortAlbumBy = localStorage.getItem('sortAlbumBy') || 1;
        sortAlbums(sortAlbumBy);
        $("#albumSelect").val(sortAlbumBy).change();
        off();
        $(".shuffleAll").append('Shuffle All (' + $(".allArtistGridViewItem").length + ')');
    })
    var page_title = "Your Music";
    document.title = page_title;
    var tempSongIdsAll = '<?php echo json_encode($songIdArrayAll); ?>';
    tempPlaylistAll = JSON.parse(tempSongIdsAll);
    function shuffleAll() {
        setTrack(tempPlaylistAll[0], tempPlaylistAll, true);
    }
    themeSwitch();
    $("body").scrollTop(0); 
</script>


<script>

    var itemss = $('.allArtistContainer > .allArtistGridViewItem').get();
    $.each(itemss, function (e, i) { e.originalIndex = i; });


    $("#albumSelect").on('change', function () {
        var sortby = $("#albumSelect").val();
        sortAlbums(sortby);

    });

    function sortAlbums(abcd) {
        console.log(abcd);
        var items = $('.allArtistContainer > .allArtistGridViewItem').get();
        localStorage.setItem('sortAlbumBy', abcd);
        if (abcd == 1) {

            var ull = $('.allArtistContainer');
            $.each(itemss, function (a, i) {
                ull.append(i); /* This removes li from the old spot and moves it */
            });
        }
        else if (abcd == 2) {
            items.sort(function (a, b) {
                var keyA = $(a).children('.allArtistGridViewInfo').text();
                var keyB = $(b).children('.allArtistGridViewInfo').text();

                if (keyA < keyB) return -1;
                if (keyA > keyB) return 1;
                return 0;
            })
        }
        else if (abcd == 3) {
            items.sort(function (a, b) {
                var keyA = $(a).children('.allArtistGridViewInfo2').text();
                var keyB = $(b).children(".allArtistGridViewInfo2").text();

                if (keyA < keyB) return -1;
                if (keyA > keyB) return 1;
                return 0;
            })
        }
        else if (abcd == 4) {
            items.sort(function (a, b) {
                var keyA = $(a).children('.allArtistGridViewInfo3').text();
                var keyB = $(b).children('.allArtistGridViewInfo3').text();

                return keyB - keyA;
            })
        }


        if (abcd != 1) {
            var ul = $('.allArtistContainer');
            $.each(items, function (i, li) {
                ul.append(li); /* This removes li from the old spot and moves it */
            });
        }
        /* checkContainer();*/

    }

    /* var count = 0;
    function checkContainer () {
        
        themeSwitch();  //Adds a grid to the html
        count++;
        
        if (count < 30) setTimeout(checkContainer, 50); //wait 50 ms, then try again
        else count=0;
        
    } */



</script>





<span class="mainContentTop">Your Albums... </span>

<div class="allArtistContainer yourMusicTwo">
    <div class="yourMusicOptions">
        <span onclick="shuffleAll()" class="shuffleAll" role="link"><img
                src="assets/images/icons/shuffle all.png"></span>
        <span style='cursor: not-allowed'>Genre: All genres</span>
        <span>
            Sort by:

            <select id="albumSelect" role='link'>
                <option value="1">Date added</option>
                <option value="2">A to Z</option>
                <option value="3">Artist</option>
                <option value="4">Release year</option>
            </select>

        </span>

    </div>
    <?php

    $albumquery = mysqli_query($con2, "SELECT DISTINCT album FROM $username ORDER BY id DESC");

    while ($row = mysqli_fetch_array($albumquery)) {
        $albumId = $row['album'];
        $album = new Album($con, $albumId);
        echo "<div class='allArtistGridViewItem'>
                        <div class='allArtistGridViewImage' role='link'>
                            <img role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $albumId . "\")' src='" . $album->getArtworkPath() . "' class='hover-shadow zoomless' > 
                            <img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"album\", " . $albumId . ")'>
                            <input type='hidden' class='id' value='" . $albumId . "' name='album'>
                            <img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>

                        </div>
                        

                        <div class='allArtistGridViewInfo'>"
            . $album->getTitle() .
            "</div>

                        <div role='link' class='allArtistGridViewInfo2' onclick='openPage(\"artist.php?id=" . $album->getArtist()->getId() . "\")'>"
            . $album->getArtist()->getName() .
            "</div>    
                        <span class='big-dot'>•</span>
                        <div class='allArtistGridViewInfo3'>"
            . $album->getYear() .
            "</div>
                    
                </div>";
    }
    ?>
    <nav class="optionsMenu">
        <input type="hidden" class="id" name=''>
        <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
        <div class='item' onclick='addToQueue(this)'><img class='addToQueue zoom' src='assets/images/icons/add.png'>Add
            to Queue</div>
        <div class='item' onclick='addToNext(this)'><img class='addToNext zoom'
                src='assets/images/icons/play-next.png'>Play Next</div>
    </nav>
</div>