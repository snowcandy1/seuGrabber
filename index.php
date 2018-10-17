<?php
$title = '东南大学选课外挂';
include 'header.php';
?>
<script src="/static/js/cookie.js"></script>
<script src="/static/js/cheat.js"></script>
<div class="ui two column doubling grid">
    <div class="column test">
        <p><h2>>> 抢选修课</h2></p>
        <p><a href="javascript:void(0);" onclick="gethelp()">设置帮助</a></p>
        <div class="ui input">
            请输入你欲选择的课程关键词，用|分割：<input type="text" placeholder="课程关键词" id="curiname">
        </div>
        <div class="ui input">
            课程类型：人文01 经管02 自然03：<input type="text" placeholder="默认为人文" id="cate">
        </div>
        <div class="ui input">
            用数字输入无法上课的星期数：<input type="text" placeholder="e.g.124" id="unweek">
        </div>
        <p>
            <button class="ui orange button" onclick="startcur()">开始抢课</button>
            <button class="ui blue button" onclick="endcur()">停止抢课</button>
        </p>
        <div id="resp" class="ignored ui info message">在这里返回选课结果</div>
    </div>
    <div class="column test">
        <p><h2>>> 抢指定课程</h2></p>
        <p>搜索课程 <a href="javascript:void(0);" onclick="$('#courseSearch').show(200)">展开</a> <a href="javascript:void(0);" onclick="$('#courseSearch').hide(200)">折叠</a></p>
		<div id="courseList"></div>
        <div id="resp2" class="ignored ui info message">在这里返回选课结果</div>
		<div hidden id="courseSearch">
			<div class="ui action input">
			  <select id="cateSearch" class="ui compact selection dropdown">
				<option selected="" value="0">推荐课程</option>
				<option value="1">方案内课程</option>
				<option value="4">方案外课程</option>
				<option value="2">体育课程</option>
				<option value="3">选修课程</option>
			  </select>
			  <div class="ui button" onclick="courseSearch()">搜索</div>
			</div>
			<div id="reslist" style="height:250px;overflow-y:scroll">
				<div class="ui list" >
					<div class="item">
						<i class="map marker icon"></i>
						<div class="content">
							<span class="header" style="color:black">课程</span>
							<div class="description">课程描述.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <button class="ui orange button" onclick="runSelectCourse()">开始抢课</button>
        <button class="ui blue button" onclick="stopSelectCourse()">停止抢课</button>
    </div>

</div>

</div>
</body>
