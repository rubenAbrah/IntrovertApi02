<?php

require_once(__DIR__ . '/Introvert/autoload.php');
Introvert\Configuration::getDefaultConfiguration()->setHost('https://api.s1.yadrocrm.ru/tmp'); 

function getCurrentVaildDates(){

Introvert\Configuration::getDefaultConfiguration()->setApiKey('key', '23bc075b710da43f0ffb50ff9e889aed');
$api = new Introvert\ApiClient(); 

$today = date('Y-m-d');
$endThisMonth = date("Y-m-t", strtotime($today));  
$crm_user_id = array(); // int[] | фильтр по id ответственного
$status = array(41477662,41477659); // int[] | фильтр по id статуса
$id = array(); // int[] | фильтр по id
$ifmodif = ""; // string | фильтр по дате изменения. timestamp или строка в формате 'D, j M Y H:i:s'
$count = 100; // int | Количество запрашиваемых элементов
$offset = 0; // int | смещение, относительно которого нужно вернуть элементы
$res_count = $count;
$returnData = array();
try { 
    while( $res_count === $count){ 
		
    $result = $api->lead->getAll($crm_user_id, $status, $id, $ifmodif, $count, $offset);
		foreach($result['result'] as   $resValue){

			foreach(	 $resValue['custom_fields'] as  $fieldsVAlue){

				if($fieldsVAlue['id'] === 1522989 && $fieldsVAlue['id']){
					
				$fildsTimestamp = strtotime($fieldsVAlue['values'][0]['value']);

				$fildsDate =  date('Y-m-d',$fildsTimestamp); 

	 $fildsDate   >= $today && $fildsDate <= $endThisMonth ? $returnData[substr(  $fildsDate, -2)] +=1 :false;
				}	
			}
		}
	$offset+=  $count; 
    $res_count = (int)$result['count'];
	}
	return $returnData;


	} catch (Exception $e) {
		return  $e->getMessage();
	} 
}
 echo json_encode(getCurrentVaildDates()); 

?>
