rsz = function() {
		if ($(document).width() < 600) {
			// alert($(".mainform").right);
			$(".mainform").css("right", "2%");
			$(".problist").fadeOut(100);
		} else {
			$(".mainform").css("right", "155px");
			$(".problist").css("left", ($(document).width() - 145) + "px");
			$(".problist").fadeIn(100);
			// $('.alerter').fadeOut(100);
			// $('.cardbg').fadeIn(100);
			// var h = $('#profilepanel').width() * 2/3;
			// var h1= $('#profilepanel').width() / 1.9;
			// var intro= $('#intro').width() / 1.6;
			// $('#profilepanel').height(h);
			// $('.cunit').height(h);
			// $('.cunit').width(h);
			// $('.profile').width(h1);
			// $('#intro').height(intro);
			// var scale = h / 720;
			// var scaledbg = 1024 * scale * 0.9;
			// var h = $('#profilepanel').height();
			// $('.cunit').css("background-position-x", -180 * scale);
			// $('.cunit').css("background-position-y", -142 * scale);
			// $('.cunit').css("background-size", scaledbg);
		}
	};
$(document).ready(rsz); $(window).resize(rsz);

