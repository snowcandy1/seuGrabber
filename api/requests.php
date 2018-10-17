<?php
function spcQuery($url, $posts, $key = 'querySetting') {
	global $token, $cookie;
	$post = array( 
		$key => json_encode($posts), 
		'electiveBatchCode' => $posts['data']['electiveBatchCode']
	);
	$ref = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/*default/grablessons.do?token='.$token;
	$headers = array(
			'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
			'token: '.$token
	);
	$api = sendRequest($url, $post, $cookie, $headers, $ref);
	return json_decode($api, 1);
}

/**
  * 系统推荐课程查询
  * http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/recommendedCourse.do
  * @ querySetting 解读
  * --- teachingClassType: TJKC
  * --- checkConflict 筛选冲突课程
  *   | ---- 0 筛选不冲突课程
  *   | ---- 1 筛选冲突课程
  *   | ---- 2 筛选所有课程
  * --- checkCapacity 筛选满员课程
  *   | ---- 0 筛选未满员课程
  *   | ---- 1 筛选已满员课程
  *   | ---- 2 筛选所有课程
  * --- queryContent 选择条件 [search]是搜索关键字
  *   | ---- "[search]"         不限
  *   | ---- "KCXZ:03,[search]" 限选
  *   | ---- "KCXZ:01,[search]" 必修
  *   | ---- "KCXZ:02,[search]" 任选
  * --- order 排序方式
  *   | ---- ""  不排序
  *   | ---- "+" 正序
  *   | ---- "-" 倒序
 **/
function getRecommendedCur($posts) {
	$url = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/recommendedCourse.do';
	return spcQuery($url, $posts);
}

/**
  * 通识选修课程查询
  * http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/publicCourse.do
  * @ querySetting 解读
  * --- teachingClassType: XGXK
  * --- checkConflict 筛选冲突课程
  *   | ---- 0 筛选不冲突课程
  *   | ---- 1 筛选冲突课程
  *   | ---- 2 筛选所有课程
  * --- checkCapacity 筛选满员课程
  *   | ---- 0 筛选未满员课程
  *   | ---- 1 筛选已满员课程
  *   | ---- 2 筛选所有课程
  * --- queryContent 选择条件 [search]是搜索关键字
  *   | ---- "[search]"                    No
  *   | ---- "[search],XGXKLBDM:01"        人文社科
  *   | ---- "[search],XGXKLBDM:02"        经济管理
  *   | ---- "[search],XGXKLBDM:03"        自然科学
  * --- order 排序方式
  *   | ---- ""  不排序
  *   | ---- "+" 正序
  *   | ---- "-" 倒序
 **/
function getPublicCur($posts) {
	$url = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/publicCourse.do';
	return spcQuery($url, $posts);
}

/**
  * 方案内/体育课程查询
  * http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/programCourse.do
  * @ querySetting 解读同推荐课程
  * --- teachingClassType: 方案内FANKC/体育课TYKC
 **/

function getProgramCur($posts) {
	$url = 'http://newxk.urp.seu.edu.cn/xsxkapp/sys/xsxkapp/elective/programCourse.do';
	return spcQuery($url, $posts);
}

function instr($p1, $p2, $p3) {
	foreach ($p3 as $K) {
		if (strlen($K) < 1 || strstr($p1, $K) || strstr($p2, $K)) return true;
	}
	return false;
}

