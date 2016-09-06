//地图动态获取行政村名称
function xzcName(xzId) {
  
    map.clearOverlays();
    document.getElementById("map").style.display = "none";
    document.getElementById("mapRelation").style.display = "none";
    document.getElementById("map_xiangzhen").style.display = "none";
    document.getElementById("map").style.display = "block";
    document.getElementById("map_zirancun").style.display = "none";
//    document.getElementById("map_zirancuninfo").style.display = "none";

    $(function () {
        $.ajax({
            url: '/Admin/index.php?m=Map&a=json&rank=3',
            type: 'get',
            dataType: 'json',
            data: {
                'xzID': xzId
            },
            success: function (json) {
                if (json != null && json != '') {
                    succFunction_xzc(json);
                }
            },
            error: function (json) {

            }

        })

    });
}


var objmap = [];
var str = '';
var lat_Zoom_xingzhengcun;
var lng_Zoom_xingzhengcun;
var backatlevel = '';
function succFunction_xzc(strs) {  
    var str = '';
    var qxqId = '';
    var qxqName = '';
 //   alert(456);
    if (strs != null) {
        var i = 1;
        for (i = 0; i < strs.length; i++) {
            str += "{qxqId :" + strs[i].qxqId + ",qxqName:\"" + strs[i].qxqName + "\",xzId :" + strs[i].xzId + ",xzName:\"" + strs[i].xzName + "\",name :" + strs[i].nameId + ",content:\"" + strs[i].name + "\", title: \"" + strs[i].name + "\", imageOffset: { width: 0, height: 3 }, position: { lat:" + strs[i].Y_flag + ", lng:" + strs[i].X_flag + "} },"
            qxqId = strs[i].nameId;
            qxqName = strs[i].qxqName;
        }

        objmap = eval('[' + str + ']');
        str = '';
        initmap_xzc(qxqId, qxqName);
    } else {
        alert("没有返回数据信息！");
    }

}

//创建和初始化自然村一级地图函数：
var map;
function initmap_xzc(qxqId, qxqName) {
   
  //  createmap(); //创建地图
   // setMapEvent_xingzhengcun(); //设置地图事件
    addMapControl_xingzhengcun(); //向地图添加控件  
    addMapTool_xingzhengcun(); //向地图添加工具
    addMapOverlay_xingzhengcun(); //向地图添加自然村一级覆盖物  
    mapAddSvgOverlay_xingzhengcun(qxqId, qxqName); //向地图中添加行政区划
}


function mapAddSvgOverlay_xingzhengcun(qxqId, qxqName) {
    //获取行政区划边界
    var Request = new UrlSearch();
    for (var index = 0; index < chifengSVG.length; index++) {
        if (qxqName == chifengSVG[index].name) {
            addPolygon(chifengSVG[index].qixinaqu, 0.8, "#ff0000", 0.5, chifengSVG[index].svgcolor, 3, chifengSVG[index].name);
            map.centerAndZoom(new BMap.Point(chifengSVG[index].position.lng, chifengSVG[index].position.lat), 9); //重置中心点和级别
        }
    }

    function addPolygon(points, lineOpacity, lineColor, fillOpacity, fillColor, strokeWeight, name) {
        return mapAddPolygon(map, points, lineOpacity, lineColor, fillOpacity, fillColor, strokeWeight, name);
    }
    //添加覆盖物面,并返回覆盖物
    function mapAddPolygon(map, points, lineOpacity, lineColor, fillOpacity, fillColor, strokeWeight, name) {
        if (strokeWeight == null) {
            strokeWeight = 1;
        }
        var ply = new BMap.Polygon(points, {
            strokeWeight: strokeWeight,
            strokeColor: fillColor
        });
        ply.setFillOpacity(fillOpacity);
        ply.setFillColor(fillColor);
        ply.setStrokeOpacity(lineOpacity);
        map.addOverlay(ply);
        ply.addEventListener('click', function () {
            alert(qxqName);
        });
        return ply;
    }
}

//设置地图事件
function setMapEvent_xingzhengcun() {
    //行政村一级地图
    defaultCursor = map.getDefaultCursor(); 				   //初始化鼠标
    map.centerAndZoom(new BMap.Point(centX, centY), minLevel); // 定位到地图中心点 
    map.addControl(new BMap.NavigationControl({ type: BMAP_NAVIGATION_CONTROL_LARGE })); 		// 添加导航控件
    //            map.addControl(new BMap.ScaleControl({ anchor: BMAP_ANCHOR_TOP_LEFT })); // 添加比例尺控件
    map.enableScrollWheelZoom(); // 启用滚轮放大缩小
    map.enableKeyboard(); //启用键盘操作
    map.enableDragging();
   
}
//测距工具
function myDistance_xingzhengcun() {

    var myDis = new BMapLib.DistanceTool(map); //自然村一级
    function openDis() {
        myDis.open(); // 开启测距
    }
    function closeDis() {
        myDis.close(); // 关闭测距
    }
    //自定义控件工具
    function ZoomControl_xingzhengcun() {
        // 设置默认停靠位置和偏移量  
        this.defaultAnchor = BMAP_ANCHOR_TOP_LEFT;
        this.defaultOffset = new BMap.Size(70, 10);
    }
    // 通过JavaScript的prototype属性继承于BMap.Control   
    ZoomControl_xingzhengcun.prototype = new BMap.Control();
    //自定义控件必须实现initialize方法，并且将控件的DOM元素返回   
    // 在本方法中创建个div元素作为控件的容器，并将其添加到地图容器中
    ZoomControl_xingzhengcun.prototype.initialize = function (map) {
        // 创建一个DOM元素   
        var div = document.createElement("div");
        // div设置样式    
        div.style.cursor = "pointer";
        div.style.border = "0px solid gray";
        div.style.width = "50px";
        div.style.height = "50px";
        div.setAttribute("name", "close");
        // 添加测距
        div.innerHTML = "<img src='/Admin/Public/map/distanceruler.png' style='width:50px;height:50px;'/>";
        // 绑定事件，点击添加测距
        div.onclick = function (e) {
            if (div.getAttribute("name") == "close") {
                div.innerHTML = "<img src='/Admin/Public/map/distanceruleropen.png' style='width:50px;height:50px;'/>";
                div.setAttribute("name", "open");
                myDis.open();
                myDis.addEventListener("drawend", function (e) {
                    mapAddSvgOverlay_xingzhengcun(qxqId, qxqName); //向地图中添加行政区划
                    //map.clearOverlays();
                    addMapOverlay_xingzhengcun();
                    addMapControl_xingzhengcun();

                    var p1 = e.points[0];
                    var p2 = e.points[e.points.length - 1];
                    DrivingRoute_xingzhengcun(p1, p2);
                    driving.clearResults();
                    driving.search(p1, p2);
                    myDis._clearCurData();
                });

            }
            else {
                div.innerHTML = "<img src='/Admin/Public/map/distanceruler.png' style='width:50px;height:50px;'/>";
                div.setAttribute("name", "close");
                myDis.close();
                myDis._clearCurData();

            }
        }
        // 添加DOM元素到地图中   

        map.getContainer().appendChild(div);
        // 将DOM元素返回  
        return div;
    }
    var myZoomCtrl = new ZoomControl_xingzhengcun();

    map.addControl(myZoomCtrl);

}
//在线离线切换
function OnLineOff_xingzhengcun() {
    //自定义控件工具
    function ZoomControl_xingzhengcun() {
        // 设置默认停靠位置和偏移量  
        this.defaultAnchor = BMAP_ANCHOR_TOP_LEFT;
        this.defaultOffset = new BMap.Size(120, 10);
    }
    // 通过JavaScript的prototype属性继承于BMap.Control   
    ZoomControl_xingzhengcun.prototype = new BMap.Control();
    //自定义控件必须实现initialize方法，并且将控件的DOM元素返回   
    // 在本方法中创建个div元素作为控件的容器，并将其添加到地图容器中
    ZoomControl_xingzhengcun.prototype.initialize = function (map) {
        // 创建一个DOM元素   
        var div = document.createElement("div");
        // div设置样式    
        div.style.cursor = "pointer";
        div.style.border = "0px solid gray";
        div.style.width = "50px";
        div.style.height = "50px";
        div.setAttribute("name", "online");
        // 在线离线切换
        div.innerHTML = "<img src='/Admin/Public/map/offline.png' style='width:50px;height:50px;'/>";
        var mapType2 = new BMap.MapTypeControl({ mapTypes: [BMAP_NORMAL_MAP, BMAP_HYBRID_MAP], anchor: BMAP_ANCHOR_TOP_LEFT, offset: new BMap.Size(120, 55) });
        //根据cookies确定图标
        if (getCookie_xingzhengcun("name") == "tileMapType") {
            div.innerHTML = "<img src='/Admin/Public/map/offline.png' style='width:50px;height:50px;'/>";
        }
        else {
            div.innerHTML = "<img src='/Admin/Public/map/online.png' style='width:50px;height:50px;'/>";
            map.addControl(mapType2); //为地图添加2D3D切换控件
        }
        // 绑定事件，点击添加测距
        div.onclick = function (e) {
            if (div.getAttribute("name") == "offline") {
                div.innerHTML = "<img src='/Admin/Public/map/online.png' style='width:50px;height:50px;'/>";
                div.setAttribute("name", "online");
                map.addControl(mapType2); //为地图添加2D3D切换控件
                addMapOverlay_xingzhengcun();
            }
            else {
                div.innerHTML = "<img src='/Admin/Public/map/offline.png' style='width:50px;height:50px;'/>";
                div.setAttribute("name", "offline");
                map.removeControl(mapType2); //行政村一级地图
                var tileLayer = new BMap.TileLayer();
                tileLayer.getTilesUrl = function (tileCoord, zoom) {
                    var x = tileCoord.x;
                    var y = tileCoord.y;
                    var url = outputPath + zoom + '/' + x + '/' + y + format;
                    return url;
                }
                var tileMapType = new BMap.MapType('tileMapType', tileLayer, { minZoom: minLevel, maxZoom: 18 });
                map.setMapType(tileMapType); //行政村一级
            }
        }
        // 添加DOM元素到地图中   
        map.getContainer().appendChild(div);
        // 将DOM元素返回  
        return div;
    }
    var myZoomCtrl = new ZoomControl_xingzhengcun();
    map.addControl(myZoomCtrl);

}
//自定义控件调用
function addMapTool_xingzhengcun() {
    myDistance_xingzhengcun();
    OnLineOff_xingzhengcun();

}

//驾车路线
function DrivingRoute_xingzhengcun(p1, p2) {

    driving = new BMap.DrivingRoute(map, { renderOptions: { map: map,
        autoViewport: true
    },
        enableDragging: true,
        enableMassClear: true,
        clearResult: true,
        onPolylinesSet: function () {
            var RoadEnd = driving.getResults().getEnd().point;
            var output = "总路程：" + driving.getResults().getPlan(0).getDistance(true);
            var opts = {
                title: "RoadLabel",
                position: RoadEnd,    // 指定文本标注所在的地理位置
                offset: new BMap.Size(30, -30)   //设置文本偏移量
            }
            var RoadLabel = new BMap.Label(output, opts);  // 创建文本标注对象
            RoadLabel.setStyle({
                color: "red",
                fontSize: "12px",
                height: "20px",
                lineHeight: "20px",
                fontFamily: "微软雅黑"
            });

            RoadLabel.enableMassClear();
            map.removeOverlay(RoadLabel);
            map.addOverlay(RoadLabel);

            //                    setTimeout(function () {
            //                        map.removeOverlay(RoadLabel);
            //                    }, "20000")
        }
    });
    return driving;
}

//向地图添加控件
function addMapControl_xingzhengcun() {
    //    map.addControl(new BMap.ScaleControl());
    //    var cr = new BMap.CopyrightControl({ anchor: BMAP_ANCHOR_BOTTOM_LEFT });   //设置版权控件位置
    //    map.addControl(cr); //添加版权控件
    //            cr.addCopyright({ id: 1, content: "<span style='color: #000;font: 11px arial,simsun;'>© 2015 CFHLWL - GS(2015)6002号 - Data © </span>" });
}
//添加自定义Marker标注
function addMapOverlay_xingzhengcun() {
    var markers = objmap;
    for (var index = 0; index < markers.length; index++) {
        var point = new BMap.Point(markers[index].position.lng, markers[index].position.lat);
        var markerImgurl = "";
        var markerNameId = markers[index].name;
        markerImgurl = "/Admin/Public/map/marker_red_sprite.png";
        var marker = new BMap.Marker(point, { icon: new BMap.Icon(markerImgurl, new BMap.Size(20, 30), { imageOffset: markerNameId }, {
            imageOffset: new BMap.Size(markers[index].imageOffset.width, markers[index].imageOffset.height)
        })
        });
        backatlevel = "<small><a href='center.aspx'>赤峰市</a></small><small><i class='icon-double-angle-right'></i>&nbsp;<a onclick='xiangzhenName(" + markers[index].qxqId + ")'>" + markers[index].qxqName + "(旗县区)</a></small>";
        backatlevel += "<small>&nbsp;<i class='icon-double-angle-right'></i>&nbsp;" + markers[index].xzName + "(乡镇)</small>";

        $('#back').html(backatlevel);
        // var label = new BMap.Label("<a id='" + markers[index].id + "'   href='center_second_new.aspx?name1=" + markers[index].name + "'>" + markers[index].title + "</a>", { offset: new BMap.Size(25, 5) });
        var label = new BMap.Label("<a id='" + markers[index].id + "'  onclick='toloadziran(" + markers[index].name + ")'>" + markers[index].title + "</a>", { offset: new BMap.Size(25, 5) });


        var opts = {
            width: 200,
            title: markers[index].title,
            enableMessage: false
        };
        marker.setLabel(label);

        map.addOverlay(label);
        map.addOverlay(marker);
        //点击弹出是个全覆盖信息框

        marker.addEventListener("click", function (e) {
            var p = e.target;
            //              alert(p.getIcon().imageOffset);
            topMp_xzc(p.getIcon().imageOffset)

        });
    };
}

//地图状态保持
map.addEventListener("maptypechange", function (e) {
    setCookie_xingzhengcun("name", catchMaptype_xingzhengcun());
});

//设置cookies
function setCookie_xingzhengcun(name, value) {
    var Days = 30;
    var exp = new Date();
    exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
    document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}
//读取cookies
function getCookie_xingzhengcun(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");

    if (arr = document.cookie.match(reg))

        return unescape(arr[2]);
    else
        return null;
}
//删除cookies
function delCookie_xingzhengcun(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie_xingzhengcun(name);
    if (cval != null)
        document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}
//获取地图类型函数
function catchMaptype_xingzhengcun() {
    var Maptype = "";
    for (i in map.getMapType()) {
        if (i == "af") {
            Maptype = map.getMapType()["af"]
        }
        else if (i == "el") {
            Maptype = map.getMapType()["el"]
        }
    }
    return Maptype;
}