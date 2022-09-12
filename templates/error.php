<?php
/**
 * Error Template
 *
 */
?><!DOCTYPE html>
<html>
<head>
  <title><?= $errorTitle ?></title>

  <style type="text/css">
    html, body {
      margin: 0;
      padding: 0;
    }
    body {
      background: #f1f1f1;
      font: 400 100%/1.2 "Lucida Sans Unicode", "Lucida Grande", sans-serif;
      margin-left: 5%;
      margin-right: 5%;
    }
    .container {
      background: #fff4f4;
      color: #4e3131;
      margin: 10% auto;
      max-width: 700px;
      padding: 15px;
      box-shadow: 1px 2px 10px -4px #555;
    }
    h2 {
      border-bottom: 1px solid #ddd;
      font-size: 1em;
      margin: 0 0 8px;
      padding: 0 0 5px;
    }
    .error-message {
      font-size: .9em;
    }
  </style>
</head>
<body>
  <div class="error">
    <div class="container">
      <h2><?= $errorHeading ?></h2>
      <div class="error-message"><?= $errorMessage ?></div>
    </div>
  </div>
</body>
</html>
