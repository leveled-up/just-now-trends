<?php
// JustNowTrends CronJob
// NOTE: Run this via "php jn-cron.php" every minute

// Settings
// Cron Access Key
$keys["access"] = "";

// API Key for the YT Data API v3
// https://console.developers.google.com/apis/api/youtube.googleapis.com/overview
$keys["yt_api"] = "";

// Target Path
$target_path = "archive/videos.json";

// Archival of old videos.json
$archive = true;
$archive_dir = "archive/";

// Authorize only if correct Access Key is provided
if($_GET["key"] != $keys["access"])
  exit("403");

// Prepare Request
$base_url = "https://www.googleapis.com/youtube/v3/videos?key=".$keys["yt_api"];
$params = array(
  "part" => "snippet",
  "chart" => "mostPopular",
  // 10 = Music (for others: https://developers.google.com/youtube/v3/docs/videoCategories)
  "videoCategoryId" => 10,
  // You may customize your region here (US for global)
  "regionCode" => "US",
  // Top-x-Charts (specify "x" below)
  "maxResults" => 10
);

foreach($params as $param_name => $param_value)
  $param_str .= "&$param_name=$param_value";

$request_url = $base_url.$param_str;

// Run Request
$result_str = file_get_contents($request_url);
$result_date = time();
if($result_str == "")
  exit("500; Request Failed");

// Process Reqsults
$result = json_decode($result_str, true);
if($result["kind"] != "youtube#videoListResponse")
  exit("500; Invalid Response Kind");

if(count($result["items"]) != $params["maxResults"])
  exit("500; Invalid Amount of Videos");

// Loop through Results
$videos = array(
  "refresh_date" => $result_date,
  "items" => array()
);

foreach($result["items"] as $video) {

  if($video["kind"] != "youtube#video")
    exit("500; Invalid Item Kind");

  $videos["items"][] = array(
    "id" => $video["id"],
    "link" => "https://youtu.be/{$video[id]}",
    "mp3" => "https://www.youtubeinmp3.com/fetch/?video=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3D{$video[id]}",
    "thumbnail" => $video["snippet"]["thumbnails"]["standard"],
    "title" => $video["snippet"]["title"],
    "channel" => $video["snippet"]["channelTitle"]
  );

}

// Make JSON
$videos_str = json_encode($videos);

if($archive and is_dir($archive_dir) and file_exists($target_path))
  if(!rename($target_path, $archive_dir.filemtime($target_path).".json"))
    exit("500; Archival Failed");

if(!file_put_contents($target_path, $videos_str))
  exit("500; Saving to $target_path Failed");
