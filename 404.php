<?
/*
   -------------------------------------------------------------------
   quick script to grab a random BOFH excuse.

    - Peter Lowe // pgl@yoyo.org // http://pgl.yoyo.org/bofh/

   credit to Jeff Ballard <ballard@NOSPAMcs.wisc.edu> for the original
   bofh excuse server: http://www.cs.wisc.edu/~ballard/bofh/ 
   -------------------------------------------------------------------
   [2004-08-28] odd:

      http://wiki.asleep.net/BOFHInetdPHP?show_comments=1
      http://pgl.yoyo.org/bofh/ripoff.html (local copy)

   someone's ripped off this code and signed it with

      "author A.Sleep <a.sleep@asleep.net>"

   it's not exactly the same, but it's definitely based off this code.
   how strange. oh well.
   -------------------------------------------------------------------
*/

// or you can use a url to make sure you're using the latest excuses file:
$excusefile     = 'http://www.cs.wisc.edu/~ballard/bofh/excuses';


function excuse($excusefile) {
    if (!$excuses = @file($excusefile))
        return "couldn't read excuse file '$excusefile'";

    mt_srand((double)microtime()*1000000); // not necessary after php 4.2.0
    return $excuses[mt_rand(0, count($excuses)-1)];
    }
?>
<html>
<title>
404 ERROR
</title>
<head>
<style type="text/css">
html{
 background-color:#0202AC;
 color:#FFFFFF;
 font-family:"Lucida Console",Lucida,sans-serif;
 padding-left:15%;
 padding-right:15%;
 line-height:125%;
}
.title{
 width:auto;
 text-align:center;
 background-color:#FFFFFF;
 color:#0202AC;
 font-size:1.5em;
 font-weight:bold;
}
.search, .search:hover, .search:focus{
 outline: none;
 text-align:left;
 background-color: transparent;
 margin: 0;
 font: inherit;
 border: none;
 color: inherit;
}
 
</style>
<br/><br/><br/><br/><div class="title">
404 ERROR
</div>
</head>

<body>
<br/>
<br/>

<?=excuse($excusefile)?><br/>
The page that you were looking for could not be found.<br/><br/><br/>
To continue:<br/>
-Check the spelling of the URL<br/>
-Search for the item you are trying to find below<br/>
-If a link from this site got you here, email webmaster@team2896damien.com<br/>
<br/><br/>
<form role="search" class="search" method="get" id="searchform" action="http://team2896damien.com/">
    <label class="screen-reader-text" for="s" class="search">Search></label>
    <input type="text" name="s" id="s" class="search" autocomplete="off" autofocus/>
    <input type="submit" id="searchsubmit" value="Search" style="visibility: hidden;"/>
    </form>
</body>

</html>