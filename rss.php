<?php


$r=$_GET["r"];

//Figure out the selected feed. 
if($r=="Google") {
  $xml=("http://news.google.com/news?ned=us&topic=h&output=rss");
} elseif($r=="NBC") {
  $xml=("http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml");
}
elseif($r=="ABC") {
  $xml=("http://feeds.abcnews.com/abcnews/topstories");
}
elseif($r=="Forest Service") {
  $xml=("http://www.fs.fed.us/pnw/RSS/news.xml");
}
$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//Get channel elements 
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;

//Output channel elements. 
echo("<p><a href='" . $channel_link
  . "'>" . $channel_title . "</a>");
echo("<br>");
echo($channel_desc . "</p>");

//Get item elements. Then output item elements. 
$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=2; $i++) {
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;
  echo ("<p><a href='" . $item_link
  . "'>" . $item_title . "</a>");
  echo ("<br>");
  echo ($item_desc . "</p>");
}
?>