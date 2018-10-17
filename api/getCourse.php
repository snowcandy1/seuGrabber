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

switch($cate) {
	case 0: // 推荐课程
		$posts = array(
			'data' => array(
				"studentCode" => $stunum,
				"campus" => '1',
				"electiveBatchCode" => $batch,
				"isMajor" => '1',
				"teachingClassType" => 'TJKC', 
				// 关键字里改这个决定三个函数 
				// TJKC 推荐课程  XGXK 通识选修 TYKC 体育课
				"checkConflict" => '0',
				"checkCapacity" => '0',
				"queryContent" => ''
			),
			'pageSize' => '1000',
			'pageNumber' => '0',
			'order' => ''
		); // 通识选修课程示例
		$api = getRecommendedCur($posts);
		break;
	case 1: // 方案内课程
		$posts = array(
			'data' => array(
				"studentCode" => $stunum,
				"campus" => '1',
				"electiveBatchCode" => $batch,
				"isMajor" => '1',
				"teachingClassType" => 'FANKC', 
				// 关键字里改这个决定三个函数 
				// TJKC 推荐课程  XGXK 通识选修 TYKC 体育课
				"checkConflict" => '0',
				"checkCapacity" => '0',
				"queryContent" => ''
			),
			'pageSize' => '1000',
			'pageNumber' => '0',
			'order' => ''
		); // 通识选修课程示例
		$api = getProgramCur($posts);
		break;
	case 4: // 方案内课程
		$posts = array(
			'data' => array(
				"studentCode" => $stunum,
				"campus" => '1',
				"electiveBatchCode" => $batch,
				"isMajor" => '1',
				"teachingClassType" => 'FAWKC', 
				// 关键字里改这个决定三个函数 
				// TJKC 推荐课程  XGXK 通识选修 TYKC 体育课
				"checkConflict" => '0',
				"checkCapacity" => '0',
				"queryContent" => ''
			),
			'pageSize' => '1000',
			'pageNumber' => '0',
			'order' => ''
		); // 通识选修课程示例
		$api = getProgramCur($posts);
		break;
	case 2: // 体育课程
		$posts = array(
			'data' => array(
				"studentCode" => $stunum,
				"campus" => '1',
				"electiveBatchCode" => $batch,
				"isMajor" => '1',
				"teachingClassType" => 'TYKC', 
				// 关键字里改这个决定三个函数 
				// TJKC 推荐课程  XGXK 通识选修 TYKC 体育课
				"checkConflict" => '0',
				"checkCapacity" => '0',
				"queryContent" => ''
			),
			'pageSize' => '1000',
			'pageNumber' => '0',
			'order' => ''
		); // 通识选修课程示例
		$api = getProgramCur($posts);
		break;
	case 3: // 通识选修
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
				"queryContent" => ''
			),
			'pageSize' => '1000',
			'pageNumber' => '0',
			'order' => ''
		); // 通识选修课程示例
		$api = getPublicCur($posts);
		break;
	default:
		exit('{"code":20000,"msg":"wrong param"}');
		break;
}
echo json_encode($api, 384);