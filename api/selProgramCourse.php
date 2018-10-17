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

//////////////////////////////
$posts = array(
	'data' => array(
            'operationType' => '1',
            'studentCode' => $stunum,
            'electiveBatchCode' => $batch,
            'teachingClassId' => '201820192B07M003003',
            'isMajor' => '1',
            'campus' => '1',
            'teachingClassType' => 'FANKC'
        )
);
$url = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/volunteer.do';
$api = spcQuery($url, $posts, 'addParam');
print_r($api);