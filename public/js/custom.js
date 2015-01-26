function social_link_class(site) {
    var result = null;
    switch (site) {
        case 'facebook':
            result = 'icon-facebook';
            break;
        case 'twitter':
            result = 'icon-twitter-3';
            break;
        case 'pinterest':
            result = 'icon-pinterest';
            break;
        case 'odnoklassniki':
            result = 'icon-odnoklassniki';
            break;
        case 'vkontacte':
            result = 'icon-rus-vk-02';
            break;
    }
    return result;
}

	
$(document).ready(function(){
	
	/* show hide login box */	
	$('#show-login').click(function() {
	  if($(this).next().is(':visible')) {
	    $(this).next().hide();
	}
	else{
		$(this).next().show();
		$('.login-form, .login-msg').show();
	}
	});
	/* ////// end shouw hide login box */

	/* 	show register box */
	$('#join').click(function(){
	$('.login-form, .login-msg').hide();
	})
	/* //////	end show register box */

		//custom.init_map();		
		/* 	nice center the map	 */
		//var mapWidth = ($(".container-fluid").width() - 900 - $(".info.pull-right").width())/2;
		//$("#world_map").css("left",mapWidth);
		//var mapWidth = ($(".container-fluid").height() - 650);
		//$("#world_map").css("top",mapWidth);
})


$(document).ready(function(){
	//console.log("a")
var map;

	 // build map
	AmCharts.ready(function() {
		//console.log("b")
		AmCharts.theme = AmCharts.themes.dark;
		map = new AmCharts.AmMap();
		map.pathToImages = "http://www.amcharts.com/lib/3/images/";

		//map.addTitle("Population of the World in 2011", 14);
		//map.addTitle("source: Gapminder", 11);
		map.areasSettings = {
			autoZoom: true,
			unlistedAreasColor: "#fff",
			unlistedAreasAlpha: 0.1,
			selectedColor: "#fff"
		};
		
		//map.imagesSettings.balloonText = "<div >[[title]]</div>";
		
				
		var dataProvider = {
			mapVar:  AmCharts.maps.continentsLow,
			images: [],
			areas: [{
			"id": "africa",
			"title": "Africa",
			"pattern": {
				"url": "http://subtlepatterns.com/patterns/squairy_light.png",
				width: 200,
				height: 200
			}
		}, {
			"id": "asia",
			"title": "Asia",
			"pattern": {
				"url": "http://subtlepatterns.com/patterns/squairy_light.png",
				width: 200,
				height: 200
			}
		}, {
			"id": "australia",
			"title": "Australia",
			"pattern": {
				"url": "http://subtlepatterns.com/patterns/squairy_light.png",
				width: 200,
				height: 200
			}
		}, {
			"id": "europe",
			"title": "Europe",
			"pattern": {
				"url": "http://subtlepatterns.com/patterns/squairy_light.png",
				width: 200,
				height: 200
			}
		}, {
			"id": "north_america",
			"title": "North America",
			"pattern": {
				"url": "http://subtlepatterns.com/patterns/squairy_light.png",
				width: 200,
				height: 200
			}
		}, {
			"id": "south_america",
			"title": "South America",
			"pattern": {
				"url": "http://subtlepatterns.com/patterns/squairy_light.png",
				width: 200,
				height: 200 			
				}
		}]
		}
		
		for (i in my_data)
		{
			cont = my_data[i];
			
			for (z in cont)
			{
				user = cont[z];
				if (user['point'])
				{
					var user_coord = user['coord'].split(",");
					var vall= "<span class='sub_user' id='user_info_"+user['id']+"' ><span class='photo'><img src='/" + user['photo'] + "' /></span><span class='name'><b>" + user['first_name'] + " " + user['last_name'] + "</b><br />" + user['city'] +"</span><span class='clear'></span>";
					vall += "<span class='user_info'>Invested: "; 
					vall += user['totalInvested'];
					vall += "$ <br />Gained: ";
					vall += user['totalReward'];
					vall += "$</span>";
					vall += "</span>";
					
					
					dataProvider.images.push({
						type: "circle",
						width: 7,
						height: 7,
						stroke: "#ccc",
						"stroke-width":"1",
						color: "red",
						longitude: user_coord[1],
						latitude: user_coord[0],
						value: vall,
						title: vall,
						groupId: i,
						outline:1,
						rollOverScale: 2
					});
				}
			}
		}
		
		map.dataProvider = dataProvider;

		map.addListener("clickMapObject", function (event) {
		   $(".pop_up_info").remove();
		   var info = event.chart.getDevInfo();
		   var id = event.mapObject.id;
		   console.log(info);
		   var pop_up = "<div class='pop_up_info' style='margin:10px 20%;'>";
			
			var users = my_data[id];
			for (i in users)
			{
				if(i>10){break}
				var user = users[i];
				//var rand = Math.random()<.5;
			
				pop_up += "<div class='user'>" + user['first_name'] + " " + user['last_name'] + " – <span class='city'>" + user['city']+"</span>";
				
				if(user['online'] == 1){
					pop_up +="<span class='online'>online</span>";
				}
				pop_up += "<div class='sub_user'><div class='triangle'></div>";
				if (user.photo.length) {
					pop_up += "<div class='photo'><img src='/" + user['photo'] + "' /></div>";
				}
				pop_up += "<div class='name'><b>" + user['first_name'] + " " + user['last_name'] + "</b><br />" + user['city'] + "</div>";
				if(user['totalInvested']!=null || user['totalInvested']>1){
				pop_up += "<div class='user_info'>Invested: ";
				pop_up += user['totalInvested'];
				pop_up += "$ <br />";
				
				if(user['totalReward']!=null || user['totalReward']>1){
				pop_up += "Gained: " ;
				pop_up += user['totalReward']; 
				pop_up += "$";
				}
				pop_up += "</div>";
				}
				// Social links.
				if (user.social != null) {
					pop_up += '<div class="social_links">';
					for (var l in user.social) {
						pop_up += '<a href="' + user.social[l] + '" class="social_link"><span class="' + social_link_class(l) + '"></span></a>';
					}
					pop_up += "</div>";
				}

				pop_up += "</div></div>";
			}
			pop_up += "</div>";
				//event.mapObject - obiectul
			// print out dev info
			
			
			$(".amcharts-chart-div").append(pop_up);
			
		});
		
		map.write("world_map");
		
		
	})	
})

