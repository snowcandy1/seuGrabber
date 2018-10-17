var proc;
var proc2;
var S = "";
var bigCate = 0;
var courseList = [];
var currentCourse = 0;

$(document).ready(function(){
    var ck = getCookie("course");
    if (ck != 0) {
        courseList = JSON.parse(ck);
        refreshCourse();
    }
});

function doSelectCourse() {
    if (courseList.length <= 0) { alert("抢完啦"); clearInterval(proc2); return; }
    currentCourse %= courseList.length;
    $.get("/api/selectCourse.php", {"cate":courseList[currentCourse][2], "id":courseList[currentCourse][0]}, function(res) {
        $('#courseSearch').hide(200);
        S = new Date() + "<br>";
        if (res.code == 0) {
            S += courseList[currentCourse][1] + " - 选课成功！";
            $('#resp2').html(S);
            delCourse(currentCourse);
        } else {
            S += courseList[currentCourse][1] + " - 选课失败！<br>" +
                res.msg + "<br>服务端数据:<br>" + res.data;
            $("#tds" + currentCourse).css("color", "red");
            currentCourse++;
            $('#resp2').html(S);
        }

    }, "json");
    if (courseList.length > 0) { currentCourse %= courseList.length; } else { alert("抢完啦"); clearInterval(proc2); }
}

function runSelectCourse() {
    proc2 = setInterval("doSelectCourse()", 250);
}

function stopSelectCourse() {
    clearInterval(proc2);
}

function gethelp() {
    alert("在config.php中，输入你的token和cookie\n该后台抢课程序不影响正常选课操作。");
}

function runcur() {
    var needle = $("#curiname").val();
    var cate = $("#cate").val();
    var unweek = $("#unweek").val();
    var msgs = "...";
    $.get("/api/curlist.php", {"needle":needle, "cate":cate, "unweek":unweek}, function(res) {
        msgs = res.code;
        if (res.code != 0 && res.code != 1000) {
            msgs = "Error(" + res.code + "):" + res.msg;
        } else {
            if (!res.cur.courseName) {
                msgs = "未知错误！";
            } else {
                msgs = res.msg + "<br>" + res.data.msg + "<br>选中课程名：" + res.cur.courseName + "<br>任课老师：" + res.cur.teacherName +
                    "<br>" + res.cur.teachingPlace + "<br>类型：" + res.cur.publicCourseTypeName;
            }
            if (res.code == 0) clearInterval(proc);
        }
        $("#resp").html(new Date() + "<br>" + msgs);
    }, "json");
    // alert(msg);
    return msgs;
}

function startcur() {
    proc = setInterval("runcur()", 600);
}





function endcur() {
    clearInterval(proc);
}

/////

function refreshCourse() {
    S = "<table class=\"ui inverted table\">";
    $.each(courseList, function(ind, val) {
        S += "<tr id=\"trs" + ind + "\"><td id=\"tds" + ind + "\">" + val[0] + "</td><td>" + val[1] + "</td><td>" + val[2] +
            "</td><td><i class=\"trash alternate icon\" onclick=\"delCourse(" + ind + ")\"></i></td></tr>";
    });
    S += "</table>"
    $("#courseList").html(S);
    setCookie("course", JSON.stringify(courseList));
}

function delCourse(k) {
    courseList.splice(k, 1); refreshCourse();
}

function addCourse(courseId, courseDes, courseCate) {
	courseList.push([courseId, courseDes, courseCate]);
	refreshCourse();
}

function courseSearch() {
	var cate = $("#cateSearch").val();
	bigCate = cate;
	if (cate != 3) {
        S = "";
        $.get("/api/getCourse.php", {"cate":cate}, function(res) {
            $.each(res.dataList, function(ind, val) {
                S += '<div class="ui list">';
                S += '<div class="item">';
                S += '<i class="map marker icon"></i>';
                S += '<div class="content">';
                S += '<span class="header" style="color:black">' + val.courseName + '(' + val.credit + ' point)</span>';
                S += '<div class="description">';
                $.each(val.tcList, function(ind2, val2) {
                    S += '<b>>>></b> ' + val2.teacherName + '(' + val2.teachingClassID + ')  ' +
                        '<a href="#" onclick="$(\'#tch' + val2.teachingClassID + '\').show(200);">详细信息</a>  ' +
                        '<a href="#" onclick="$(\'#tch' + val2.teachingClassID + '\').hide(200);">隐藏</a>  ' +
                        '<a href="#" onclick="addCourse(\''+val2.teachingClassID+'\', \'' + val.courseName + "-" + val2.teacherName + '\', '+ bigCate +')">选择</a>' +
                        '<div hidden class="ui ignored positive message" id="tch' + val2.teachingClassID + '">上课班级：' + val2.recommendSchoolClass + '<br>上课地点：' + val2.teachingPlace + '</div><br>';
                });
                S += '</div></div></div></div>';
                // alert(S);
            });

            $("#reslist").html(S);
        }, "json");
    } else {
        S = "";
        $.get("/api/getCourse.php", {"cate":cate}, function(res) {
            $.each(res.dataList, function(ind, val) {
                S += '<div class="ui list">';
                S += '<div class="item">';
                S += '<i class="map marker icon"></i>';
                S += '<div class="content">';
                S += '<span class="header" style="color:black">' + val.courseName + '(' + val.credit + ' point)</span>';
                S += '<div class="description">';
                S += '<b>>>></b> ' + val.teacherName + '(' + val.teachingClassID + ')  ' +
                    '<a href="#" onclick="$(\'#tch' + val.teachingClassID + '\').show(200);">详细信息</a>  ' +
                    '<a href="#" onclick="$(\'#tch' + val.teachingClassID + '\').hide(200);">隐藏</a>  ' +
                    '<a href="#" onclick="addCourse(\''+val.teachingClassID+'\', \'' + val.courseName + "-" + val.teacherName + '\', '+ bigCate +')">选择</a>' +
                    '<div hidden class="ui ignored positive message" id="tch' + val.teachingClassID + '">上课地点：' + val.teachingPlace + '</div><br>';
                S += '</div></div></div></div>';
                // alert(S);
            });

            $("#reslist").html(S);
        },"json");
    }

}