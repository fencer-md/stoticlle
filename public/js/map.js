$(document).ready(function () {
    AmCharts.themes.none = {};
    var worldDataProvider = {
        map: "worldLow",
        images: [],
        getAreasFromMap: true
    };

    var continentsDataProvider = {
        map: "continentsLow",
        alpha: 1,
        images: [],
        areas: [
            {
                id: "africa",
                title: "Africa",
                cname: "continent",
                linkToObject: worldDataProvider,
                passZoomValuesToTarget: true
            },
            {
                id: "asia",
                title: "Asia",
                cname: "continent",
                linkToObject: worldDataProvider,
                passZoomValuesToTarget: true
            },
            {
                id: "australia",
                title: "Australia",
                cname: "continent",
                linkToObject: worldDataProvider,
                passZoomValuesToTarget: true
            },
            {
                id: "europe",
                title: "Europe",
                cname: "continent",
                linkToObject: worldDataProvider,
                passZoomValuesToTarget: true
            },
            {
                id: "north_america",
                title: "North America",
                cname: "continent",
                linkToObject: worldDataProvider,
                passZoomValuesToTarget: true
            },
            {
                id: "south_america",
                title: "South America",
                cname: "continent",
                linkToObject: worldDataProvider,
                passZoomValuesToTarget: true
            }
        ]
    };

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

    function usersByContinent(id){
        var i, users = [];
        for (i in mapData) {
            if (mapData[i].continent == id) {
                users.push(mapData[i]);
            }
        }
        return users;
    }

    function usersByCountry(id){
        var i, users = [];
        for (i in mapData) {
            if (mapData[i].country == id) {
                users.push(mapData[i]);
            }
        }
        return users;
    }

    for (var i in mapData) {
        var user = mapData[i];
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
                groupId: user['continent'],
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
                groupId: user['country'],
                outline: 1
            });
        }
    }

    var map = AmCharts.makeChart("chartdiv", {
        type: "map",
        theme: "none",
        pathToImages: "/maps/images/",
        backgroundZoomsToTop: true,
        mouseWheelZoomEnabled: true,
        showObjectsAfterZoom: true,
        areasSettings: {
            autoZoom: true,
            alpha: 0.8,
            outlineColor: "#c1c1c1",
            rollOverOutlineColor: "#c1c1c1",
            rollOverColor: "#05478a",
            selectedColor: "#05478a",
            unlistedAreasColor: "#fff",
            unlistedAreasAlpha: 1,
            color: "#ffffff"
        },
        zoomControl: {
            buttonFillColor: "#05478a",
            buttonRollOverColor: "#1E8BC3",
            maxZoomLevel: 30,
            zoomControlEnabled: true
        },
        dataProvider: continentsDataProvider
    });

    function renderMapOverlay (users) {
        var i, user, pop_up = '<div class="pop_up_overlay" id="map-overlay"><div class="pop_up_info">';
        users = users.slice(0, 10);
        for (i in users) {
            user = users[i];
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
        pop_up += "</div></div>";
        return pop_up;
    }

    map.addListener("clickMapObject", function (event) {
        var mapID = event.mapObject.id;
        console.log(event.mapObject);
        var users = [];

        if (event.mapObject.cname == "continent") {
            users = usersByContinent(mapID);
        } else if(event.mapObject.cname == "MapArea") {
            users = usersByCountry(mapID);
        } else {
            users = mapData;
        }

        // Example to call it:
        var arrKeys = renderMapOverlay(users);
        $("#map-overlay").replaceWith(arrKeys);
    });

    map.write("world_map");
    $("#world_map").append(renderMapOverlay(mapData));
});
