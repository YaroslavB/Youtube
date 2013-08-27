<?php require_once "Zend/Loader/Autoloader.php";


Zend_Loader_Autoloader::getInstance();
$kt = new Zend_Gdata_YouTube();
 if(isset($_GET['q']))
 {
    $queryString = $_GET['q'];
 }
 else
 {
    $queryString = 'Death metal';
 }
$q= $kt->newVideoQuery();
$q->setQuery($queryString);
$q->setStartIndex(1);
$q->setMaxResults(20);
//$q->setTime('this_week');
$feed=$kt->getVideoFeed($q);


foreach ($feed as $key=>$value)
{
    
  $video_id=$value->getVideoId(); 
  $thumbnail=$value->mediaGroup->thumbnail[0]->url;
    $title=(string) $value->mediaGroup->title; 
    $desc=(string) $value->mediaGroup->description; 
    // через цыкл выводим видео
    foreach ($value->mediaGroup->content as $c)
    {
        if($c->type == 'application/x-shockwave-flash'){
            $flashUrl = $c->url;
            break;
        }
       
    }
    
    echo"<h3>".$title."</h3><br/>" ;
    echo"<a href='{$flashUrl}'><img src='{$thumbnail}' height=\"150\" alt='' title='{$title}'/></a>" ;
    echo "<p>".$desc."</p>";
    echo "<a href='{$flashUrl}'>{$flashUrl}</a>";
    echo "<hr/>";
}
