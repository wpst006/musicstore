<?php include('includes/includefiles.php'); ?>

<?php

if (isset($_GET['action'])){
    if ($_GET['action']=='delete'){
        $song_id=$_GET['song_id'];
        delete_song($song_id);
    }
}

$artists_songs_Array = get_artists_songs_Array();
$authors_songs_Array = get_authors_songs_Array();
$song_Array = get_songs_Array($artists_songs_Array, $authors_songs_Array);

//===========================================================================================================
function get_songs_Array($artists_songs_Array, $authors_songs_Array) {
    $song_sql = "SELECT * FROM `songs` " .
            "WHERE album_id='" . $_GET['album_id'] . "' " .
            "ORDER BY `title`";
    $song_result = mysql_query($song_sql) or die(mysql_error());

    $song_Array = array();

    while ($song_row = mysql_fetch_array($song_result)) {
        $song_Array[] = array(
            'song_id' => $song_row['song_id'],
            'title' => $song_row['title'],
            'length' => $song_row['length'],
            'album_id' => $song_row['album_id'],
            'song_type' => $song_row['song_type'],
            'artists' => get_artists_name($artists_songs_Array, $song_row['song_id']),
            'authors' => get_authors_name($authors_songs_Array, $song_row['song_id']),
            'filename' => $song_row['filename'],
            'unitprice' => $song_row['unitprice'],
            'vote_count' => $song_row['vote_count']
        );
    }

    return $song_Array;
}

function get_artists_songs_Array() {
    $artists_songs_sql = "SELECT `artists_songs`.`song_id`,`artists_songs`.`artist_id`,`artists`.`artistname` " .
            "FROM `artists_songs` " .
            "INNER JOIN " .
            "`artists`" .
            "ON `artists_songs`.`artist_id`=`artists`.`artist_id` " .
            "ORDER BY `song_id`, `artistname`";
    $artists_songs_result = mysql_query($artists_songs_sql) or die(mysql_error());

    $artists_songs_Array = array();

    while ($row = mysql_fetch_array($artists_songs_result)) {
        $artists_songs_Array[] = array(
            'song_id' => $row['song_id'],
            'artist_id' => $row['artist_id'],
            'artistname' => $row['artistname']
        );
    }

    return $artists_songs_Array;
}

function get_artists_name($artists_songs_Array, $song_id) {
    $artists_name = '';

    foreach ($artists_songs_Array as $item) {
        if ($item['song_id'] == $song_id) {
            $artists_name.=$item['artistname'] . ', ';
        }
    }

    //Remove last "comma" from the string
    $artists_name = rtrim($artists_name, ', ');

    return $artists_name;
}

function get_authors_songs_Array() {
    $authors_songs_sql = "SELECT `authors_songs`.`song_id`,`authors_songs`.`author_id`,`authors`.`authorname` " .
            "FROM `authors_songs` " .
            "INNER JOIN " .
            "`authors`" .
            "ON `authors_songs`.`author_id`=`authors`.`author_id` " .
            "ORDER BY `song_id`, `authorname`";
    $authors_songs_result = mysql_query($authors_songs_sql) or die(mysql_error());

    $authors_songs_Array = array();

    while ($row = mysql_fetch_array($authors_songs_result)) {
        $authors_songs_Array[] = array(
            'song_id' => $row['song_id'],
            'author_id' => $row['author_id'],
            'authorname' => $row['authorname']
        );
    }

    return $authors_songs_Array;
}

function get_authors_name($authors_songs_Array, $song_id) {
    $authors_name = '';

    foreach ($authors_songs_Array as $item) {
        if ($item['song_id'] == $song_id) {
            $authors_name.=$item['authorname'] . ', ';
        }
    }

    //Remove last "comma" from the string
    $authors_name = rtrim($authors_name, ', ');

    return $authors_name;
}

function delete_song($song_id){
    $sql="DELETE FROM songs WHERE song_id='" . $song_id . "'";    
    mysql_query($sql) or die(mysql_error());
    
    $sql="DELETE FROM authors_songs WHERE song_id='" . $song_id . "'";    
    mysql_query($sql) or die(mysql_error());
    
    $sql="DELETE FROM artists_songs WHERE song_id='" . $song_id . "'";    
    mysql_query($sql) or die(mysql_error());
    
     messageHelper::setMessage("Song ID " . $song_id . " is successfully Deleted.", MESSAGE_TYPE_SUCCESS);
//    header("Location:albums-display.php");
//    exit();
}
?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    #templatemo_content{
        float:none;
        width:100% !important;
    }

    .dataTables_wrapper {
        margin: 0 auto;
        width: 100%;
    }

    #song_table .title-column{
        width:400px;
    }
    #song_table .artist-column{
        width:300px;
    }
    #song_table .price-column{
        width:50px;
    }

    #song_table .downloaded-count-column{
        width:100px;
    }

    #song_table .download-column{
        width:50px;
    }

    #song_table .action-column{
        width:175px;
    }
    
    #song_table .length-column{
        width:50px;
    }
</style>

<?php $pageTitle = "songs display"; ?>
<?php include('includes/header.php'); ?>               

<div class="row">
    <div class="col-md-12">

        <table id="song_table">
            <thead>
                <tr>
                    <th class="title-column">Title</th>
                    <th class="length-column">Length</th>
                    <th class="songtype-column">Song Type</th>
                    <th class="artist-column">Artists</th>
                    <th class="artist-column">Authors</th>
                    <th class="price-column">Unit Price</th>
                    <th class="downloaded-count-column">Vote Count</th>
                    <th class="action-column"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($song_Array as $row) { ?>
                    <tr>
                        <td class="title-column"><?php echo $row['title']; ?></td>
                        <td class="length-column"><?php echo $row['length']; ?></td>
                        <td class="songtype-column"><?php echo $row['song_type']; ?></td>
                        <td class="artist-column"><?php echo $row['artists']; ?></td>
                        <td class="artist-column"><?php echo $row['authors']; ?></td>
                        <td class="price-column"><?php echo $row['unitprice']; ?></td>
                        <td class="downloaded-count-column">
                            <?php echo $row['vote_count']; ?>
                            <?php if ($objLogIn->isMemberLogIn() == true) { ?>
                                <br/>
                                <a href="votes.php?album_id=<?php echo $row['album_id']; ?>&song_id=<?php echo $row['song_id']; ?>" >Vote</a>
                            <?php } ?>
                        </td>
                        <!--<td class="download-column"><a href="downloadfile.php?filetype=song&file=<?php echo $row['filename']; ?>">download</a></td>-->
                        <td class="action-column">
                            <?php
                            if ($objLogIn->isMemberLogIn()) {
                                $link = "add2cart.php?song_id=" . $row['song_id'];
                                $link.="&title=" . $row['title'];
                                $link.="&artists=" . $row['artists'];
                                $link.="&price=" . $row['unitprice'];
                                $link.="&filename=" . $row['filename'];
                                $link.="&action=add2cart";
                                ?>
                                <a href="<?php echo $link; ?>"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                            <?php } ?>
                            <?php if ($objLogIn->isAdminLogIn()){ ?>
                                <a href="songs.php?album_id=<?php echo $row['album_id']; ?>&song_id=<?php echo $row['song_id']; ?>">Edit</a>
                                &nbsp;
                                <a href="song-display.php?album_id=<?php echo $row['album_id']; ?>&song_id=<?php echo $row['song_id']; ?>&action=delete" class="delete-link">Delete</a>&nbsp;
                                &nbsp;
                                <a href="awards.php?song_id=<?php echo $row['song_id']; ?>">Award</a>                                
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>       

<br/>

<div class="row">
    <div class="col-md-12 text-right">
        <?php if ($objLogIn->isAdminLogIn() == true) { ?>
            <a href="albums-display.php" class="btn btn-primary">Back to Album Listing</a>
            <a href="songs.php?album_id=<?php echo $_GET['album_id']; ?>" class="btn btn-primary">Add New Song</a>
        <?php } ?>
        <a href="export-song.php?album_id=<?php echo $_GET['album_id']; ?>" class="btn btn-default btn-info my-btn">Print</a>
    </div>
</div>



<?php include ('includes/footer.php'); ?>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#song_table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        } );
        
        $( ".delete-link" ).click(function( event ) {
            if (window.confirm("Are you sure want to delete the song?")==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        });
    });
</script>