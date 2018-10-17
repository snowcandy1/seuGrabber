<!DOCTYPE html>
<html>

<head>
    <title><?=$title?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="referrer" content="always">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/jquery.countdown.min.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/semantic-ui/2.2.13/semantic.min.css" />
    <script src="/static/js/semantic.min.js"></script>
    <style>
        body {
            background-image: url('/static/bg.jpg');background-position: center center;background-repeat: no-repeat;background-attachment: fixed;background-size: cover;
        }
        .test {
                      background-color: rgba(255, 255, 255, 0.6); border-radius:8px;
            text-shadow: 0 0 3px black;
                  }
        .test a {
            text-shadow: 0 0 3px red;
            color: black;
        }

    </style>
</head>
<body style="">
<div class="ui inverted menu">
    <a class="header item" href="/">SEUGraber</a>
    <a class="item" href="/event/">...</a>
    <a class="item" href="/news/">...</a>
    <div class="ui dropdown item" tabindex="0">...
        <i class="dropdown icon"></i>
        <div class="menu" tabindex="-1">
            <a class="item" href="/ranking/level">???</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.tabular.menu .item').tab();
    $('.ui.dropdown').dropdown();
</script>
<div class="ui container">