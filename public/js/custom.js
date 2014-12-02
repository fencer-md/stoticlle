
function main_custom () {

    this.global = new Array();
  	
    this.init_map = function()
	{
		custom.global['coord'] = new Array();
		custom.global['coord']['america_n'] = "M4,85L15,72L30,65L70,74L100,72L114,52L122,39L145,36L186,20L199,8L248,1L271,8L232,28L222,57L241,61L269,87L256,103L273,121L294,155L265,164L246,176L234,184L234,194L220,204L223,220L262,236L239,239L212,230L200,246L215,248L218,263L237,264L228,271L212,266L207,254L194,248L177,252L159,235L142,219L129,199L116,187L108,155L87,128L72,113L53,116L31,129L2,142L22,122L7,112Z";
		custom.global['coord']['america_s'] = "M216,263L230,263L244,252L256,260L270,259L283,270L295,273L300,284L314,289L329,296L339,302L330,312L324,331L321,346L306,346L299,367L281,383L264,396L255,411L251,428L259,441L241,437L234,408L237,385L250,360L249,341L237,320L225,306L222,294L223,280L231,270Z";
		custom.global['coord']['euro'] = "M409,193L401,185L398,176L403,167L409,171L418,174L419,151L433,137L445,134L445,124L437,116L436,104L450,100L463,83L481,72L496,65L525,80L554,84L575,75L596,72L599,56L620,65L623,53L643,50L667,42L678,34L659,26L669,15L689,29L686,38L712,39L704,56L741,57L751,68L778,64L769,46L780,39L803,50L784,53L794,60L803,69L815,66L841,74L877,75L900,90L891,94L878,88L875,105L847,114L834,115L833,129L821,144L813,128L826,116L808,116L775,118L767,133L782,136L787,164L770,198L756,209L722,229L690,236L697,249L690,265L685,279L668,260L664,241L650,227L628,245L628,269L610,258L589,222L567,218L573,228L558,245L538,251L506,207L511,193L495,191L477,183L457,191L442,179L429,175L426,189Z";
		custom.global['coord']['africa'] = "M377,229L396,210L406,196L427,192L444,188L452,199L468,205L482,204L504,208L518,232L528,252L535,262L550,254L550,272L530,287L523,298L520,315L529,316L525,327L513,336L514,350L498,364L486,379L472,377L462,358L460,337L451,330L456,319L457,300L446,287L446,275L430,271L403,279L380,256Z";
		custom.global['coord']['australia'] = "M708,344L718,338L727,330L741,322L752,318L766,319L772,329L778,319L792,326L803,349L809,370L797,384L786,388L769,384L755,367L734,371L713,378L714,361Z";
				
        if ($(".map").length)
		{
			var r = Raphael("world_map" ,900 , 450);
			
			var raport_x = 900 / 360;
			var raport_y = 1050 / 360;
			var center_x = 430;
			var center_y = 290;
			
			custom.draw_continent(my_data['america_n'] , "america_n" , r);
			custom.draw_continent(my_data['america_s'] , "america_s" , r);
			custom.draw_continent(my_data['euro'] , "euro" , r);
			custom.draw_continent(my_data['africa'] , "africa" , r);
			custom.draw_continent(my_data['australia'] , "australia" , r);
		}
    }
	
	this.draw_continent = function( my_data , continent , r)
	{
		var raport_x = 900 / 360;
		var raport_y = 1050 / 360;
		var center_x = 430;
		var center_y = 290;
			
		var pop_up_x = 50;
		var pop_up_y = 50;
		
		if (continent == "euro")
		{
			pop_up_x = 500;
			pop_up_y = 100;
		}
		if (continent == "america_s")
		{
			pop_up_x = 150;
			pop_up_y = 300;
		}
		if (continent == "africa")
		{
			pop_up_x = 400;
			pop_up_y = 200;
		}
		if (continent == "australia")
		{
			pop_up_x = 720;
			pop_up_y = 330;
		}
			
			r.path(custom.global['coord'][continent]).attr({fill:"#445965" , opacity:'0' , stroke : "none" , cursor : "pointer" }) 
			  .hover(function () 
				{
					$(".pop_up_info").remove();
					this.animate({opacity: "0.3"} , 200);
					var pop_up = "<div class='pop_up_info'>";
					for (i in my_data)
					{
						var user = my_data[i];
						console.log(user['first_name']);
						pop_up += "<div class='user'>" + user['first_name'] + " " + user['last_name'] + "," + user['city'];
						pop_up += "<div class='sub_user'><div class='photo'><img src='/" + user['photo'] + "' /></div><div class='name'><b>" + user['first_name'] + " " + user['last_name'] + "</b><br />" + user['city'] +"</div><div class='clear'></div>";
						pop_up += "<div class='user_info'>Invested: " + user['totalInvested'] + "$ <br />Gained: " + user['totalReward'] + "$</div>";
						pop_up += "</div></div>";
					}
					pop_up += "</div>";
					$("#world_map").append(pop_up);
					$(".pop_up_info").css({"left" : pop_up_x , "top" : pop_up_y}).animate({"opacity" : 1} , 200 ).hover(function(){
						custom.global['in_pop'] = true;
					},function(){
						custom.global['in_pop'] = false;
					});
				},
				function()
				{
					this.animate({opacity: "0"} , 500);
					setTimeout(function(){
						if (!custom.global['in_pop'])
						{
							$(".pop_up_info").animate({"opacity" : 0} , 200 ,function(){
								$(this).remove();
							});
						}
					} , 500)
				})
				.click(function(){
				
				})
			
			
			for (user_id in my_data)
			{
				var user = my_data[user_id];
				if (user['point'])
				{
					custom.draw_point(user , r)
				}
			}
	}
	
	
	this.draw_point = function(user , r)
	{
		var raport_x = 900 / 360;
		var raport_y = 1050 / 360;
		var center_x = 430;
		var center_y = 290;
		
		var user_coord = user['coord'].split(",");
		var coord_x = user_coord[1] * raport_x + center_x;
		var coord_y = center_y - user_coord[0] * raport_y ;
			var c = r.circle(coord_x , coord_y, 4).attr({
				fill: "#000",
				"stroke-width":"1",
				stroke:"#FFF",
				title : "dasd",
				cursor:"pointer"
			});
			
			c.click(function(){
				var pop_up = "<div class='sub_user' id='user_info_"+user['id']+"' style='display:block;left:" + (coord_x + 2 )+ "px;top:"+ (coord_y + 2 )+ "px'><div class='photo'><img src='/" + user['photo'] + "' /></div><div class='name'><b>" + user['first_name'] + " " + user['last_name'] + "</b><br />" + user['city'] +"</div><div class='clear'></div>";
				pop_up += "<div class='user_info'>Invested: " + user['totalInvested'] + "$ <br />Gained: " + user['totalReward'] + "$</div>";
				pop_up += "</div>";
				$("#world_map").append(pop_up);
				
				$("#user_info_" +  user['id']).hover(function(){} , function(){
					$(this).animate({"opacity" : 0} , 200 , function(){
						$(this).remove();
					})
				})
			});
		
	}
	
}


var custom = new main_custom();
	
$(document).ready(function(){
		custom.init_map();
})




