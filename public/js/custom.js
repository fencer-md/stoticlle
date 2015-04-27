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

$(document).ready(function () {
    // show hide login box
    $('#show-login').click(function () {
        if ($(this).next().is(':visible')) {
            $(this).next().hide();
        }
        else {
            $(this).next().show();
            $('.login-form, .login-msg').show();
        }
    });

    var worldDataProvider = {
        map: "worldLow",
        images: [],
        getAreasFromMap: true
    };

    var continentsDataProvider = {
        map: "continentsLow",
        alpha: 1,
        images: [],
        areas: [{
            id: "africa",
            title: "Africa",
            linkToObject: worldDataProvider,
            passZoomValuesToTarget: true
        }, {
            id: "asia",
            title: "Asia",
            linkToObject: worldDataProvider,
            passZoomValuesToTarget: true
        }, {
            id: "australia",
            title: "Australia",
            linkToObject: worldDataProvider,
            passZoomValuesToTarget: true
        }, {
            id: "europe",
            title: "Europe",
            linkToObject: worldDataProvider,
            passZoomValuesToTarget: true
        }, {
            id: "north_america",
            title: "North America",
            linkToObject: worldDataProvider,
            passZoomValuesToTarget: true
        }, {
            id: "south_america",
            title: "South America",
            linkToObject: worldDataProvider,
            passZoomValuesToTarget: true
        }]

    };

    var map;

    // build map
    AmCharts.ready(function () {
        AmCharts.theme = "none";
        map = new AmCharts.AmMap();
        map.pathToImages = "http://www.amcharts.com/lib/3/images/";

        map.areasSettings = {
            autoZoom: true,
            alpha: 0.8,
            outlineColor: "#c1c1c1",
            rollOverOutlineColor: "#c1c1c1",
            rollOverColor: "#05478a",
            selectedColor: "#05478a",
            unlistedAreasColor: "#fff",
            unlistedAreasAlpha: 1,
            color: "#ffffff",
            rollOverScale: 3
        };
        map.zoomControl = {
            buttonFillColor: "#05478a",
            buttonRollOverColor: "#1E8BC3"
        };


        for (var i in my_data) {
            var cont = my_data[i];

            for (var z in cont) {
                var user = cont[z];
                if (user['point']) {
                    var user_coord = user['coord'].split(",");
                    var vall = "<span class='sub_user sub_user_map' id='user_info_" + user['id'] + "' ><span class='photo'><img src='/" + user['photo'] + "' /></span><span class='name'><b>" + user['first_name'] + " " + user['last_name'] + "</b><br />" + user['city'] + "</span><span class='clear'></span>";
                    vall += "<span class='user_info'>Invested: ";
                    vall += user['totalInvested'];
                    vall += "$ <br />Gained: ";
                    vall += user['totalReward'];
                    vall += "$</span>";
                    vall += "</span>";

                    continentsDataProvider.images.push({
                        type: "circle",
                        width: 7,
                        height: 7,
                        stroke: "#ffffff",
                        "stroke-width": "1",
                        color: "#1E8BC3",
                        longitude: user_coord[1],
                        latitude: user_coord[0],
                        value: vall,
                        title: vall,
                        groupId: i,
                        outline: 1
                    });

                    worldDataProvider.images.push({
                        type: "circle",
                        width: 7,
                        height: 7,
                        stroke: "#ffffff",
                        "stroke-width": "1",
                        color: "#1E8BC3",
                        longitude: user_coord[1],
                        latitude: user_coord[0],
                        value: vall,
                        title: vall,
                        groupId: i,
                        outline: 1
                    });
                }
            }
        }

        map.dataProvider = continentsDataProvider;

        /*
         map.addListener("click", function (event) {
         var info = map.getDevInfo();
         map.zoomToLongLat( map.zoomLevel() * 1.2, info.longitude, info.latitude );
         });
         */

        //loadUsers(map.mapObject.id);

        /*
         map.addListener("clickMapObject", function (event) {
         var mapID = event.mapObject.id;
         console.log(mapID);
         loadUsers(mapID);
         });

         */


        map.addListener("clickMapObject", function (event) {
            var mapID = event.mapObject.id;
            console.log('map click', mapID);

            var loadUsersbyRegion = function (obj, reg) {
                var pop_up = "<div class='pop_up_overlay'><div class='pop_up_info' style='margin:32px auto 0;'>";
                var ca = [];

                for (var i in obj[reg]) {
                    if (i > 10) {
                        break;
                    }
                    console.log(obj[reg][i]);
                    if (obj[reg][i] == reg) {
                        var user = obj[i];
                        //var rand = Math.random()<.5;

                        pop_up += "<div class='user'><div class='sub-user-border'>" + user['first_name'] + " " + user['last_name'] + " – <span class='city'>" + user['city'] + "</span>";

                        if (user['online'] == 1) {
                            pop_up += "<span class='online'>online</span>";
                        }
                        pop_up += "<div class='sub_user'>";
                        if (user.photo.length) {
                            pop_up += "<div class='photo'><img src='/" + user['photo'] + "' /></div>";
                        }
                        pop_up += "<div class='name'><b>" + user['first_name'] + " " + user['last_name'] + "</b><br />" + user['city'] + "</div>";
                        if (user['totalInvested'] != null || user['totalInvested'] > 1) {
                            pop_up += "<div class='user_info'>Invested: ";
                            pop_up += user['totalInvested'];
                            pop_up += "$ <br />";

                            if (user['totalReward'] != null || user['totalReward'] > 1) {
                                pop_up += "Gained: ";
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

                    /*
                     if(ca.indexOf(my_data[reg][key].country) == -1) {
                     ca.push(my_data[reg][key].country);
                     }
                     */
                }
                pop_up += "</div></div>";
                return pop_up;
            };

            // Example to call it:
            var arrKeys = loadUsersbyRegion(my_data, mapID);
            //$(".amcharts-chart-div").append(arrKeys);
            console.log(arrKeys);

        });

        /* Custom*/
        var pop_up_generator = "<div class='pop_up_overlay'><div class='pop_up_info' style='margin:32px auto 0;'>";

        for (i in my_data) {
            var region = my_data[i]
            for (j in region) {
                var person = region[j];

                pop_up_generator += "<div class='user'><div class='sub-user-border'>" + person['first_name'] + " " + person['last_name'] + " – <span class='city'>" + person['city'] + "</span>";
                if (person['online'] == 1) {
                    pop_up_generator += "<span class='online'>online</span>";
                }
                /*Start Sub-user*/
                pop_up_generator += "<div class='sub_user'>";
                if (person.photo.length) {
                    pop_up_generator += "<div class='photo'><img src='/" + person['photo'] + "' /></div>";
                }
                pop_up_generator += "<div class='name'><b>" + person['first_name'] + " " + person['last_name'] + "</b><br />" + person['city'] + "</div>";

                if (person['totalInvested'] != null || person['totalInvested'] > 1) {
                    pop_up_generator += "<div class='user_info'>Invested: ";
                    pop_up_generator += person['totalInvested'];
                    pop_up_generator += "$ <br />";

                    if (user['totalReward'] != null || person['totalReward'] > 1) {
                        pop_up_generator += "Gained: ";
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
    });

    // Show registration form.
    $('#join').click(function (e) {
        e.preventDefault();

        $('.register-form').show();
        $('.login-form').hide();
    });

});
