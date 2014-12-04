<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Testemiteanu</title>
<link href="/theme/site_theme/css/default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/theme/site_theme/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script src="/theme/site_theme/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="/theme/site_theme/js/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript"></script>
<script src="/theme/site_theme/js/custom.js" type="text/javascript"></script> 
<script src="/theme/site_theme/js/raphael-min.js" type="text/javascript"></script> 
<script>
var part1 = "M283,112L308,73L333,68L393,87L384,101L383,126L362,117L349,130L334,125L304,159L300,120Z";


var start = function () {
    // storing original coordinates
    this.ox = this.attr("cx");
    this.oy = this.attr("cy");
    this.attr({"r": 6});
},
move = function (dx, dy) {
    // move will be called with dx and dy
    this.attr({cx: this.ox * 1 + dx, cy: this.oy * 1 + dy});
	var id = this.attr('title');
	
	$("input[name='x"+id+"']").val(this.ox * 1 + dx) ;
	$("input[name='y"+id+"']").val(this.oy * 1 + dy);
	render();
	
},
up = function () {
    // restoring state
    this.attr({"r": 4});
};


	window.onload = function () {
		var r = Raphael("content" , 600 , 485);
		r.path(part1 ).attr({"stroke-width":"0.172",stroke:"#000",fill:"#f00" , opacity:'.2'});
		
		
		
		var obj=$("svg").children("path");
		var coord = obj.attr("d");
		
		coord = coord.replace("M","");
		coord = coord.replace("Z","");
		
		
		var final_coord = coord.split("L");
		var l = final_coord.length;
		var tmp_coord = final_coord[0].split(",");
		$("#start_X").val(tmp_coord[0]) + " " + $("#start_Y").val(tmp_coord[1]);
		
		
		for (i=0; i< l ; i++)
			{
			
			var tmp_coord = final_coord[i].split(",");
			var final = "<input type='text' value='"+tmp_coord[0]+"' name='x"+i+"' style='width:30px;' />";
			final += "<input type='text' value='"+tmp_coord[1]+"' name='y"+i+"' style='width:30px;' /><br />"
			var c = r.circle(tmp_coord[0], tmp_coord[1], 4).attr({
				fill: "#000",
				"stroke-width":"1",
				stroke:"#FFF",
				title : i
			}).drag(move, start, up);
			$("#points").append(final)
			}
		
		$("#add").click(function(){
			var final = "M";
			var obj=$("svg").children("path");
			var coord = obj.attr("d");
			
			coord = coord.replace("M","");
			coord = coord.replace("Z","");
			
			var final_coord = coord.split("L");
			var l = final_coord.length;
			
			for (i=0 ; i< l ; i++)
				{
				var ox = $("input[name='x"+i+"']").val();
				var oy = $("input[name='y"+i+"']").val();
				
				if (i>0) final += "L";
				final += ox + "," + oy;
				var tmp_final =  "L" + (ox ) + "," + (oy*1 + 30);
				}
			
			final += tmp_final + "Z";
			
			var input_final = "<input type='text' value='" + (ox ) + "' name='x"+i+"' style='width:30px;' />";
			input_final  += "<input type='text' value='" + (oy*1 + 30) + "' name='y"+i+"' style='width:30px;' /><br />"
			
			var c = r.circle(ox , oy*1 + 30, 4).attr({
				fill: "#000",
				"stroke-width":"1",
				stroke:"#FFF",
				title : i
			}).drag(move, start, up);
			
			$("#points").append(input_final )
			
			obj.attr({"d" : final});

		})
	};

function render(){
	
	
	var obj=$("svg").children("path");
	var coord = obj.attr("d");
	
	coord = coord.replace("M","");
	coord = coord.replace("Z","");
	
	$("#description p").text(coord);
	
	var final_coord = coord.split("L");
	var l = final_coord.length;
	var tmp_coord = final_coord[0].split(",");
		
	var final = "M";
	
	for (i=0; i< l ; i++)
		{
		var ox = $("input[name='x"+i+"']").val();
		var oy = $("input[name='y"+i+"']").val();
		
		if (i>0) final += "L";
		final += ox + "," + oy;
		}
	final += "Z";
	obj.attr({"d" : final});
	
	$("#main_coord").text(final);
		
}

</script>
</head>

<body>

<div class="wrapper">
	
		<div id="content" style="background:url('http://stoticlle.com/images/map.png') no-repeat 0 0; background-size:900px auto"></div> 
		<!-- content -->
		
		<div id="description" style="padding:5px">
			
			<div id="points"></div>
			<hr />
			<input type="button" id="add" value="Add" />
			<div id="final"></div>
			
		</div><!-- description -->
	</div><!--up_part-->
	
</div><!-- wrapper -->	
	
</body>
</html>
