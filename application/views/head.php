<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/board_codeigniter/static/css/head.css">
        <!-- Bootstrap -->
        <link href="/board_codeigniter/static/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <style type="text/css">
          body{
            padding-top: 60px;
          }
        </style>
        <link href="/board_codeigniter/static/lib/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    </head>
    <body>
      <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">

            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>

            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="#">Cedeigniter study</a>

            <!-- Everything you want hidden at 940px or less, place within here -->
            <div class="nav-collapse collapse">
              <ul class="nav pull-right">
                  <?php
                  if ($this->session->userdata('is_login')) {
                  ?>
                    <li><a href="../auth/logout">Logout</a></li>
                  <?php
                  } else {
                  ?>
                    <li><a href="../auth/login">Login</a></li>
                    <li><a href="../auth/register">Register</a></li>
                  <?php
                  }
                  ?>

              </ul>
            </div>

          </div>
        </div>
      </div>
      <div class="container">
        <?php
        if ($this->config->item('is_dev')) {
        ?>
        <div class="well">
          This page is a development environment
        </div>
        <?php
        }
        ?>
        <div class="row-fluid">
