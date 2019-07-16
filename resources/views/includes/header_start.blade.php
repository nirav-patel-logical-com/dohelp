<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <?php
        $site_path = env('APP_URL');
        $site_path = $site_path.'public/';
        ?>
        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{$site_path}}assets/images/favicon.ico">

        <!-- App title -->
        <title>Man Help</title>

        <!-- Switchery css -->
        <link href="{{$site_path}}plugins/switchery/switchery.min.css" rel="stylesheet" />
