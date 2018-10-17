<?php
include '../config.php';
// 在里面配置 $cookie $stunum $batch $token
include '../func.php';

include 'requests.php';

header('Content-type: application/json');

error_reporting(0);

/**
  * @ author zixi123
**/

$url = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/deleteVolunteer.do';
$posts = array(
			'data' => array(
				"studentCode" => $stunum,
				"electiveBatchCode" => $batch,
				"isMajor" => '1',
				"teachingClassID" => '201820192B00JG01105', 
				// 关键字里改这个决定三个函数 
				// TJKC 推荐课程  XGXK 通识选修 TYKC 体育课
				"operationType" => "2"
			)
		); 
$api = spcQuery($url, $posts, 'deleteParam');

print_r($api);