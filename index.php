<?php
// JustNowTrends v0.1
// (c) 2017 RunStorage Technologies

$title = "JustNowTrends";
$mail = "support@example.com";
?>
<!doctype html>
<head>
    <!-- JustNowTrends v0.1 - (c) RunStorage Technologies - https://github.com/leveled-up/just-now-trends -->
    <title><?=$title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#67696b">
    <link rel="stylesheet" href="https://www.runstorageapis.com/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.runstorageapis.com/css/bootstrap-theme.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="icon" href="https://www.runstorageapis.com/img/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://www.runstorageapis.com/js/bootstrap.min.js"></script>
    <style>
      body {
        font-family: 'Roboto', sans-serif;
      }
    </style>
</head>
<body>
  <br />
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <span style="font-size: x-large;">
          <center>
            <a href=""><?=$title?></a>
            <br />
          </center>
        </span>
      </div>
      <div class="col-sm-8">
        <p><?=$title?> is an online platform that lets you see the latest music trends from <a href="https://www.youtube.com">YouTube</a> almost real-time. If there are any questions, feel free to <a href="mailto:<?=$mail?>">contact us</a>.</p>
      </div>
    </div>
    <br />

    <?php include("jn-table.php"); ?>

    <br /> <hr />
  </div>
  <div class="footer">
    <center>
      &copy; RunStorage Technologies &middot; <i>YouTube</i> is a registered trademark of <i>YouTube, LLC</i>.
    </center>

    <br /> <br />
  </div>
</body>
