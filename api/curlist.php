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
$unneedweek = str_split(isset($_GET['unweek'])?$_GET['unweek']:'');
$unneed = [0, 0, 0, 0, 0, 0, 0, 0];
foreach ($unneedweek as $t) {
	$unneed[intval($t)] = 1;
} 
$posts = array(
	'data' => array(
		"studentCode" => $stunum,
        "campus" => '1',
        "electiveBatchCode" => $batch,
        "isMajor" => '1',
        "teachingClassType" => 'XGXK', 
		// 关键字里改这个决定三个函数 
		// TJKC 推荐课程  XGXK 通识选修 TYKC 体育课
        "checkConflict" => '0',
        "checkCapacity" => '0',
        "queryContent" => (!isset($_GET['cate']) || strlen($_GET['cate']) < 1) ? '' : 'XGXKLBDM:'.$_GET['cate']
	),
	'pageSize' => '1000',
    'pageNumber' => '0',
    'order' => ''
); // 通识选修课程示例
$api = getPublicCur($posts);

if (!isset($api) || !is_array($api)) exit('{"code":10000, "msg":"访问出错","data":'.json_encode($api, 384).'}');
if ($api['code'] == 302) exit('{"code":302, "msg":"登录Cookie/token有误","data":'.json_encode($api, 384).'}');
if (!is_array($api["dataList"])) exit('{"code":2000, "msg":"没有可选课程或已退出登录", "data":'.json_encode($api, 384).'}');
$res = [];
foreach ($api["dataList"] as $r) {
	$res[] = array(
		'teachingClassID' => $r['teachingClassID'], 
		'courseName' => $r['courseName'],
		'teacherName' => $r['teacherName'],
		'teachingPlace' => $r['teachingPlace'],
		'publicCourseTypeName' => $r['publicCourseTypeName'],
		'timelist' => $r['teachingTimeList']
		// 'others' => $r
	);
}

// echo json_encode($res, 384);
shuffle($res);

$ind = 0; $extramsg = '(没有符合条件的课程，已随机选择。)';
$needle = explode('|', $_GET['needle']);

foreach ($res as $ind => $r) {
	if (isset($r['timelist']) && is_array($r['timelist'])) {
		$f = 0;
		foreach($r['timelist'] as $TL) {
			if($unneed[$TL['dayOfWeek']] == 1) {$f = 1; break;}
		}
		if ($f == 1) continue;
	}
	if (instr($r['courseName'], $r['teacherName'], $needle)) {
		$extramsg = ''; break;
	}
}

$posts = array(
	'data' => array(
            'operationType' => '1',
            'studentCode' => $stunum,
            'electiveBatchCode' => $batch,
            'teachingClassId' => $res[$ind]['teachingClassID'],
            'isMajor' => '1',
            'campus' => '1',
            'teachingClassType' => 'XGXK'
        )
);
$url = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/volunteer.do';
$api = spcQuery($url, $posts, 'addParam');

if ($api['code'] == '1') {
	$resp = array('code' => 0, 'msg'=> '选择课程成功'.$extramsg,'data' => $api, 'cur' => $res[$ind]);
} else {
	$resp = array('code' => 1000, 'msg'=> '选择课程出错'.$extramsg,'data' => $api, 'cur' => $res[$ind]);
}
echo json_encode($resp, 384);