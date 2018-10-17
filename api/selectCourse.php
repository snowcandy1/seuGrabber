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

if (!isset($_REQUEST['cate'])) $cate = 'UNDEFINED'; else $cate = $_REQUEST['cate'];
if (!isset($_REQUEST['id'])) exit('{"code":20000,"msg":"missing param"}'); else $id = $_REQUEST['id'];


switch($cate) {
	case 0: // 推荐课程
		$posts = array(
			'data' => array(
					'operationType' => '1',
					'studentCode' => $stunum,
					'electiveBatchCode' => $batch,
					'teachingClassId' => $id,
					'isMajor' => '1',
					'campus' => '1',
					'teachingClassType' => 'TJKC'
				)
		);
		$url = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/volunteer.do';
		$api = spcQuery($url, $posts, 'addParam');
		break;
	case 1: // 方案内课程
		$posts = array(
			'data' => array(
					'operationType' => '1',
					'studentCode' => $stunum,
					'electiveBatchCode' => $batch,
					'teachingClassId' => $id,
					'isMajor' => '1',
					'campus' => '1',
					'teachingClassType' => 'FANKC'
				)
		);
		$url = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/volunteer.do';
		$api = spcQuery($url, $posts, 'addParam');
		break;
	case 4: // 方案内课程
		$posts = array(
			'data' => array(
					'operationType' => '1',
					'studentCode' => $stunum,
					'electiveBatchCode' => $batch,
					'teachingClassId' => $id,
					'isMajor' => '1',
					'campus' => '1',
					'teachingClassType' => 'FAWKC'
				)
		);
		$url = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/volunteer.do';
		$api = spcQuery($url, $posts, 'addParam');
		break;
	case 2: // 体育课程
		$posts = array(
			'data' => array(
					'operationType' => '1',
					'studentCode' => $stunum,
					'electiveBatchCode' => $batch,
					'teachingClassId' => $id,
					'isMajor' => '1',
					'campus' => '1',
					'teachingClassType' => 'TYKC'
				)
		);
		$url = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/volunteer.do';
		$api = spcQuery($url, $posts, 'addParam');
		break;
	case 3: // 通识选修
		$posts = array(
			'data' => array(
					'operationType' => '1',
					'studentCode' => $stunum,
					'electiveBatchCode' => $batch,
					'teachingClassId' => $id,
					'isMajor' => '1',
					'campus' => '1',
					'teachingClassType' => 'XGXK'
				)
		);
		$url = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/volunteer.do';
		$api = spcQuery($url, $posts, 'addParam');
		break;
	default:
		exit('{"code":20000,"msg":"wrong param"}');
		break;
}
if ($api['code'] == '1') {
	$resp = array('code' => 0, 'msg'=> '选择课程成功', 'data' => json_encode($api, 384), 'id' => $id);
} else {
	$resp = array('code' => 1000, 'msg'=> '选择课程出错', 'data' => json_encode($api, 384), 'id' => $id);
}
echo json_encode($resp, 384);