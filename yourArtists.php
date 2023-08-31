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
        off();
    })

    var page_title = "Your Artists";
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
    $(document).ready(function () {
        var sortArtistBy = localStorage.getItem('sortArtistBy') || 1;
        sortArtists(sortArtistBy);
        $("#artistSelect").val(sortArtistBy).change();
        $(".shuffleAll").append('Shuffle All (' + $(".allArtistGridViewItem").length + ')');
    })

    var itemss = $('.allArtistContainer > .allArtistGridViewItem').get();
    $.each(itemss, function (e, i) { e.originalIndex = i; });


    $("#artistSelect").on('change', function () {
        var sortby = $("#artistSelect").val();
        sortArtists(sortby);

    });

    function sortArtists(abcd) {
        console.log(abcd);
        var items = $('.allArtistContainer > .allArtistGridViewItem').get();
        localStorage.setItem('sortArtistBy', abcd);
        if (abcd == 1) {

            var ull = $('.allArtistContainer');
            $.each(itemss, function (a, i) {
                ull.append(i); /* This removes li from the old spot and moves it */
            });
        }
        else if (abcd == 2) {
            items.sort(function (a, b) {
                var keyA = $(a).text();
                var keyB = $(b).text();

                if (keyA < keyB) return -1;
                if (keyA > keyB) return 1;
                return 0;
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











<span class="mainContentTop">Your Artists... </span>


<div class="allArtistContainer yourMusicOne">
    <div class="yourMusicOptions">
        <span onclick="shuffleAll()" class="shuffleAll" role="link"><img
                src="assets/images/icons/shuffle all.png"></span>

        <span>
            Sort by:

            <select id="artistSelect" role='link'>
                <option value="1">Date added</option>
                <option value="2">A to Z</option>
            </select>

        </span>
    </div>

    <?php
    $artistquery = mysqli_query($con2, "SELECT DISTINCT artist FROM $username ORDER BY id DESC");

    while ($row = mysqli_fetch_array($artistquery)) {
        $artistId = $row['artist'];
        $artist = new Artist($con, $artistId);
        echo "<div class='allArtistGridViewItem' >
                        <div class='allArtistGridViewImage' role='link'>
                            <img src='" . $artist->getPic() . "' style='border-radius: 50%' class='zoomless hover-shadow' onclick='openPage(\"artist.php?id=" . $artistId . "\")'>
                            <img class='playIconShortcut zoom' src='assets/images/icons/playIconShortcut.png' onclick='playIconShortcut(\"artist\", " . $artistId . ")'>
                            <input type='hidden' class='id' value='" . $artistId . "' name='artist'>
                            <img class='addIconShortcut zoom optionsButton' src='assets/images/icons/addIconShortcut.png' onclick='showOptionsMenu(this)'>
                        </div>
                        <div role='link' class='gridViewInfo'>"
            . $artist->getName() .
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