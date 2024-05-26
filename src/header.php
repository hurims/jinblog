<?php function genheader($title, $date) { ?>
<html>
<head>
  <link rel="alternate" type="application/rss+xml"  title="RSS Feed for jyhur.com" href="/rss.xml" />
  <style type="text/css">

    @font-face {
      font-family: 'fabfont';
/*      font-display: optional;*/
      src: url('/font/DejaVuSansMono.woff2');
    }

    * {
       font-size: 16px;
    }

    html {
      font-family: fabfont;
      max-width: 900px;  /* For Desktop PC (see @media for Tablets/Phones) */
      padding-left: 2%;
      padding-right: 3%;
      margin: 0 auto;
      background: #F5F5F0;
  	} 
    


  	a {
      color: black;
      font-weight: bold;
    }

    img {
      border: none; 
    }

    p {
      margin-top: 0px;
      text-align: justify;
    }
    sup {
      vertical-align: 0.3em;
      font-size: 0.65em;
    }   

    pre {
      font-family: fabfont;
      background-color: white; 
      border: 1px solid Black; 
      padding-left: 2%;
      padding-top: 1ch;
      padding-bottom: 1ch;
      /* Only take care of X overflow since this is the only part that can be too wide.
         The Y axis will never overflow.
      */
      overflow: hidden;
    }

    div.heading {
      font-weight: bold;      
      text-transform: uppercase;
      margin-top: 4ch;
    }

    /** {
      font-size: 16px;
    }*/
    @media (max-width: 500px) { /* For small screen decices */
      * {
        font-size: 12px; 
      }
    }   
    .title {
      text-decoration: none;
    }

    img.pixel, canvas.pixel {
      image-rendering: pixelated;
      image-rendering: -moz-crisp-edges;
      image-rendering: crisp-edges;
    }

    blockquote { 
    background-color: #f3f3f3;
    border: dashed 1px grey; 
    width: 97.5%; 
    font-style: italic; 
    text-align: justify;

    padding: 1ch; 
    padding-top: 2ch; 
    padding-bottom: 2ch;     
    
    margin : 0ch; 
    margin-bottom: 2ch; 
    margin-top: 0ch;
  }

  blockquote div {
    text-transform: none;
    text-align: right;
    width: 100%;
  }

  code {
    /*font-size: 110%;*/
    font-weight: bold;
    background-color: #e1e1e1;
    border-radius: 0.5ch;
    padding-left: 0.3ch;
    padding-right: 0.3ch;
  }

  </style>
  <title><?echo $title;?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=12.0, minimum-scale=1.0, user-scalable=yes">
  <link rel="icon" type="image/svg" href="/jy-silver.svg">
</head>  
  <body><br><center>
    <div style="display: inline-block; vertical-align:middle;">
<a href="/" class="title"><b>Jinyoung'S WEBSITE</b><br>
</a><hr/><div style="text-align: justify;display: inline-block; width: 100%;">
<a class="title" href="/about">ABOUT</a> &nbsp;<a class="title" href="/contact/index.html">EMAIL</a></div></div>
</center><br><br>
<div style="margin-bottom: 2ch;text-transform: none;">
<?echo $date;?>
</div>
<?h($title);?>
<?} ?>