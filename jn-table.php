<?php
// Generate Table

// Source Path
$source_path = "archive/videos.json";

// Get & Decode
$videos_str = file_get_contents($source_path);
$videos = json_decode($videos_str, true);

if(!isset($videos["refresh_date"]))
  exit("500; Videos/refresh_date Invalid");

$current_time = time();
$time = $current_time - $videos["refresh_date"];
$time_str = "trending $time seconds ago";

// Generate Table
$table = "<table class=\"table\">";

foreach($videos["items"] as $video) {

  $table_item = "<tr>
    <td>
      <center>
        <a href=\"{$video[link]}\" target=\"_blank\">
          <img src=\"{$video[thumbnail]}\" alt=\"Thumbnail\" width=\"128px\" />
        </a>
      </center>
    </td>
    <td>
      <center>
        <b>
          <a href=\"{$video[link]}\" target=\"_blank\">
            {$video[channel]}<br />
            {$video[title]}
          </a>
        </b> <br />
        <span style=\"color: grey;\">
          $time_str
        </span>

        <br /> <br />
        <div class=\"btn-group btn-group-sm\">
          <a href=\"{$video[link]}\" target=\"_blank\" class=\"btn btn-danger\">Watch <i class=\"fa fa-youtube-play\"></i></a>
          <a href=\"{$video[mp3]}\" target=\"\" class=\"btn btn-default\">Download MP3 <i class=\"fa fa-external-link\"></i></a>
        </div>
      </center>
    </td>
  </tr>";
  $table .= $table_item;

}

$table .= "</table>";
echo $table;
