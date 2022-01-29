<?php

function statistics( $what )
{
	$db = \app\core\Application::$app->db;
	$value=0;
	switch($what){
		case "users":
			$stm = $db->pdo->prepare("SELECT COUNT(*) AS 'users' FROM `users`");
			$stm->execute();
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
				$value = $row['users'];
			}
			break;
		case "week":
			$stm = $db->pdo->prepare("SELECT CONCAT( LPAD(FLOOR(seconds / 3600), 2, '0'), ':', LPAD(FLOOR((seconds % 3600) / 60), 2, '0'), ':', LPAD(seconds % 60, 2, '0')) as time FROM (SELECT SUM(CAST(SUBSTRING(time, 1, 2) AS UNSIGNED) * 3600 + CAST(SUBSTRING(time, 4, 2) AS UNSIGNED) * 60 + CAST(SUBSTRING(time, 7, 2) AS UNSIGNED)) AS seconds FROM completedtasks WHERE YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1)) AS summary; ");
			$stm->execute();
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
				$value = $row['time'];
			}
			break;
		case "month":
			$stm = $db->pdo->prepare("SELECT CONCAT( LPAD(FLOOR(seconds / 3600), 2, '0'), ':', LPAD(FLOOR((seconds % 3600) / 60), 2, '0'), ':', LPAD(seconds % 60, 2, '0')) as time FROM (SELECT SUM(CAST(SUBSTRING(time, 1, 2) AS UNSIGNED) * 3600 + CAST(SUBSTRING(time, 4, 2) AS UNSIGNED) * 60 + CAST(SUBSTRING(time, 7, 2) AS UNSIGNED)) AS seconds FROM completedtasks WHERE MONTH(`created_at`) = MONTH(CURRENT_DATE()) AND YEAR(`created_at`) = YEAR(CURRENT_DATE())) AS summary; ");
			$stm->execute();
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
				$value = $row['time'];
			}
			break;
		case "year":
			$stm = $db->pdo->prepare("SELECT CONCAT( LPAD(FLOOR(seconds / 3600), 2, '0'), ':', LPAD(FLOOR((seconds % 3600) / 60), 2, '0'), ':', LPAD(seconds % 60, 2, '0')) as time FROM (SELECT SUM(CAST(SUBSTRING(time, 1, 2) AS UNSIGNED) * 3600 + CAST(SUBSTRING(time, 4, 2) AS UNSIGNED) * 60 + CAST(SUBSTRING(time, 7, 2) AS UNSIGNED)) AS seconds FROM completedtasks WHERE YEAR(`created_at`) = YEAR(CURRENT_DATE())) AS summary; ");
			$stm->execute();
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
				$value = $row['time'];
			}
			break;
		case "beginning":
			$stm = $db->pdo->prepare("SELECT CONCAT( LPAD(FLOOR(seconds / 3600), 2, '0'), ':', LPAD(FLOOR((seconds % 3600) / 60), 2, '0'), ':', LPAD(seconds % 60, 2, '0')) as time FROM (SELECT SUM(CAST(SUBSTRING(time, 1, 2) AS UNSIGNED) * 3600 + CAST(SUBSTRING(time, 4, 2) AS UNSIGNED) * 60 + CAST(SUBSTRING(time, 7, 2) AS UNSIGNED)) AS seconds FROM completedtasks) AS summary; ");
			$stm->execute();
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
				$value = $row['time'];
			}
			break;
	}
	
	if( ($what=="week" || $what=="month" || $what=="year" || $what=="beginning") && $value!=0 ){
		$h=substr($value, 0,2);
		$m=substr($value, 3,2);
		$s=substr($value, 6,2);
		$value="Hours <em>".$h."</em> Minutes <em>".$m."</em> Seconds <em>".$s."</em>";
	}
	
	if($value=="" || $value==NULL || empty($value)){
		$value="<em>None</em>";
	}
	
	return $value;
}
?>