<?php
include "includes/database.php";
if(isset($_GET['id'])){
    $id =  intval($_GET['id']);
    $db = new DBconnection();
    $dbConn = $db->getConnection();
    $sql = "SELECT * FROM Music_tbl WHERE song_id = :song_id LIMIT 1";
    $query = $dbConn->prepare($sql);
    $query->bindparam(':song_id', $id);
    $query->execute();
}
  while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
  {
    $file = $row['song_title'];
    $type = $row['song_type'];
    $size = $row['song_size'];
    $content = $row['song_file'];
		header("Content-length: $size");
		header("Content-type: $type");
		header("Content-Disposition: attachment; filename=$file");
		ob_clean();
		flush();
		$content = stripslashes($content);
		echo $content;
		//close($dbConn);
	  exit;
	  }
 ?>
