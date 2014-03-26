<?php

class voteHelper {

    public static function vote_SelectBy_songID_and_memberID($song_id, $member_id) {
        $sql = "SELECT * FROM `votes` " .
                "WHERE song_id='" . $song_id . "' " .
                "AND member_id='" . $member_id . "'";

        $result = mysql_query($sql) or die(mysql_error());

        $output = array();

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'vote_id' => $row['vote_id'],
                'vote_date' => $row['vote_date'],
                'member_id' => $row['member_id'],
                'song_id' => $row['song_id'],
                'messagedetails' => $row['messagedetails'],
            );
        }

        return $output;
    }

    public static function isMemberAlreadyVote($song_id, $member_id) {
        $sql = "SELECT * FROM `votes` " .
                "WHERE song_id='" . $song_id . "' " .
                "AND member_id='" . $member_id . "'";

        $result = mysql_query($sql) or die(mysql_error());

        if (mysql_fetch_array($result)) {
            return true;
        }

        return false;
    }

}

