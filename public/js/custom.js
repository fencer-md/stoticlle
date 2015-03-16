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
		
		map.areasSettings = {		
			autoZoom: true,
			alpha: 0.8,
			outlineColor: "#c1c1c1",
			rollOverOutlineColor: "#c1c1c1",
			rollOverColor:"#05478a",
			selectedColor: "#05478a",
			unlistedAreasColor: "#fff",
			unlistedAreasAlpha: 1,
			color: "#ffffff",
			rollOverScale: 3
		};

		//map.addTitle("Population of the World in 2011", 14);
		//map.addTitle("source: Gapminder", 11);
		
		var dataProvider = {
			mapVar:  AmCharts.maps.continentsLow,
			alpha: 1,
			images: [],
			areas: [{
			"id": "africa",
			"title": "Africa",
		}, {
			"id": "asia",
			"title": "Asia",
		}, {
			"id": "australia",
			"title": "Australia",
		}, {
			"id": "europe",
			"title": "Europe",
		}, {
			"id": "north_america",
			"title": "North America",
		}, {
			"id": "south_america",
			"title": "South America",
		}]
		}
		map.zoomControl = {
			buttonFillColor:"#05478a", 
			buttonRollOverColor:"#1E8BC3"
		};
		
		//map.imagesSettings.balloonText = "<div >[[title]]</div>";
		
		
		for (i in my_data)
		{
			cont = my_data[i];
			
			for (z in cont)
			{
				user = cont[z];
				if (user['point'])
				{
					var user_coord = user['coord'].split(",");
					var vall= "<span class='sub_user sub_user_map' id='user_info_"+user['id']+"' ><span class='photo'><img src='/" + user['photo'] + "' /></span><span class='name'><b>" + user['first_name'] + " " + user['last_name'] + "</b><br />" + user['city'] +"</span><span class='clear'></span>";
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
						stroke: "#ffffff",
						"stroke-width":"1",
						color: "#1E8BC3",
						longitude: user_coord[1],
						latitude: user_coord[0],
						value: vall,
						title: vall,
						groupId: i,
						outline:1,
					});
				}
			}
		}
		
		map.dataProvider = dataProvider;
		

		
		map.addListener("clickMapObject", function (event) {
		   $(".pop_up_overlay").remove();/*pop_up_info*/
		   $(".op_up_overlay2").remove();
		   $("#login-register").hide();

		   var info = event.chart.getDevInfo();
		   var id = event.mapObject.id;
		   console.log(info);
		   var pop_up = "<div class='pop_up_overlay'><div class='pop_up_info' style='margin:32px auto 0;'>";
			
			 var users = my_data[id];
			 for (i in users)
			 {
				if(i>10){break} 
				
				var user = users[i];
				//var rand = Math.random()<.5;
			
				pop_up += "<div class='user'><div class='sub-user-border'>" + user['first_name'] + " " + user['last_name'] + " – <span class='city'>" + user['city']+"</span>";
				
				if(user['online'] == 1){
					pop_up +="<span class='online'>online</span>";
				}
				pop_up += "<div class='sub_user'>";
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

				pop_up += "</div></div></div>";
			}
			pop_up += "</div></div>";
				//event.mapObject - obiectul
			// print out dev info
			
			
			$(".amcharts-chart-div").append(pop_up);
			
		});  
		/* Custom*/
		var pop_up_generator = "<div class='pop_up_overlay'><div class='pop_up_info' style='margin:32px auto 0;'>";
		
		for ( i in my_data ) {
			var region = my_data[i]
			for (j in region) {
				var person = region[j];
				
				pop_up_generator += "<div class='user'><div class='sub-user-border'>" + person['first_name'] + " " + person['last_name'] + " – <span class='city'>" + person['city']+"</span>";
				if( person['online'] == 1) {
					pop_up_generator +="<span class='online'>online</span>";
				}
				/*Start Sub-user*/
				pop_up_generator += "<div class='sub_user'>";
				if (person.photo.length) {
					pop_up_generator += "<div class='photo'><img src='/" + person['photo'] + "' /></div>";
				}
				pop_up_generator += "<div class='name'><b>" + person['first_name'] + " " + person['last_name'] + "</b><br />" + person['city'] + "</div>";
				
				if(person['totalInvested']!=null || person['totalInvested']>1){
				pop_up_generator += "<div class='user_info'>Invested: ";
				pop_up_generator += person['totalInvested'];
				pop_up_generator += "$ <br />";
				
				if(user['totalReward']!=null || person['totalReward']>1){
				pop_up_generator += "Gained: " ;
				pop_up_generator += person['totalReward']; 
				pop_up_generator += "$";
				}
				pop_up_generator += "</div>";
				}
				if (person.social != null) {
					pop_up_generator += '<div class="social_links">';
					for (var l in person.social) {
						pop_up_generator += '<a href="' + person.social[l] + '" class="social_link"><span class="' + social_link_class(l) + '"></span></a>';
					}
					pop_up_generator += "</div>";
				}

				/*End Sub user*/
				pop_up_generator += "</div></div>";
				/*End User*/
			  pop_up_generator += "</div>";
			}
		}
		pop_up_generator += "</div>";
		/*End Custom*/
		
		map.write("world_map");
		$(".amcharts-chart-div").append(pop_up_generator);
		
	})	
})
