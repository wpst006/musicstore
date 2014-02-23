<?php include('includes/includefiles.php'); ?>

<?php
$artists_songs_Array = get_artists_songs_Array();
$song_Array = get_songs_Array($artists_songs_Array);

//===========================================================================================================
function get_songs_Array($artists_songs_Array) {
    $song_sql = "SELECT * FROM `songs` " .
            "ORDER BY `uploaded_date`";
    $song_result = mysql_query($song_sql) or die(mysql_error());

    $song_Array = array();

    while ($song_row = mysql_fetch_array($song_result)) {
        $song_Array[] = array(
            'song_id' => $song_row['song_id'],
            'title' => $song_row['title'],
            'price' => $song_row['price'],
            'artists' => get_artists_name($artists_songs_Array, $song_row['song_id']),
            'filename' => $song_row['filename'],
            'uploaded_date' => $song_row['uploaded_date'],
            'downloaded' => $song_row['downloaded_count']
        );
    }

    return $song_Array;
}

function get_artists_songs_Array() {
    $artists_songs_sql = "SELECT `artists_songs`.`song_id`,`artists_songs`.`artist_id`,`artists`.`title` " .
            "FROM `artists_songs` " .
            "INNER JOIN " .
            "`artists`" .
            "ON `artists_songs`.`artist_id`=`artists`.`artist_id` " .
            "ORDER BY `song_id`, `title`";
    $artists_songs_result = mysql_query($artists_songs_sql) or die(mysql_error());

    $artists_songs_Array = array();

    while ($row = mysql_fetch_array($artists_songs_result)) {
        $artists_songs_Array[] = array(
            'song_id' => $row['song_id'],
            'artist_id' => $row['artist_id'],
            'title' => $row['title']
        );
    }

    return $artists_songs_Array;
}

function get_artists_name($artists_songs_Array, $song_id) {
    $artists_name = '';

    foreach ($artists_songs_Array as $item) {
        if ($item['song_id'] == $song_id) {
            $artists_name.=$item['title'] . ', ';
        }
    }

    //Remove last "comma" from the string
    $artists_name = rtrim($artists_name, ', ');

    return $artists_name;
}
?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    #templatemo_content{
        float:none;
        width:100%;
    }

    .dataTables_wrapper {
        margin: 0 auto;
        width: 900px;
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
</style>

<?php include('includes/header.php'); ?>               

<div class="row">
    <div class="col-md-12">

        <table id="song_table">
            <thead>
                <tr>
                    <th class="title-column">Title</th>
                    <th class="artist-column">Artists</th>
                    <th class="price-column">Price</th>
                    <th class="downloaded-count-column">Downloaded</th>
                    <th class="download-column"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($song_Array as $row) { ?>
                    <tr>
                        <td class="title-column"><?php echo $row['title']; ?></td>
                        <td class="artist-column"><?php echo $row['artists']; ?></td>
                        <td class="price-column"><?php echo $row['price']; ?></td>
                        <td class="downloaded-count-column"><?php echo $row['downloaded']; ?></td>
                        <!--<td class="download-column"><a href="downloadfile.php?filetype=song&file=<?php echo $row['filename']; ?>">download</a></td>-->
                        <?php
                        $link = "add2cart.php?song_id=" . $row['song_id'];
                        $link.="&title=" . $row['title'];
                        $link.="&artists=" . $row['artists'];
                        $link.="&price=" . $row['price'];
                        $link.="&filename=" . $row['filename'];
                        $link.="&action=add2cart";
                        ?>
                        <td class="add2cart-column"><a href="<?php echo $link; ?>"><span class="glyphicon glyphicon-shopping-cart"></span></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

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
    });
</script>