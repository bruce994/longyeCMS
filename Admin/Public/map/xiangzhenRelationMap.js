//地图动态获取乡镇名称
function xiangzhenName(qxqId) {
   
    map.clearOverlays();
    document.getElementById("map").style.display = "none";
    document.getElementById("mapRelation").style.display = "none";
    document.getElementById("map").style.display = "block";
    document.getElementById("map_xingzhengcun").style.display = "none";
    document.getElementById("map_zirancun").style.display = "none";
    document.getElementById("map_zirancuninfo").style.display = "none";
    $(function () {
        $.ajax({
            url: '/Admin/index.php?m=Map&a=json&rank=2',
            type: 'get',
            dataType: 'json',
            data: {
                'qxqID': qxqId
            },
            success: function (json) {
                if (json != null && json != '') {
                    xzajax(json);

                }
            },
            error: function (json) {

            }

        })

    });
}
var objmap;
var lat_Zoom_xiangzhen;
var lng_Zoom_xiangzhen;
var qxqId, qxqName;
function xzajax(strs) {
    var str = '';
   
    if (strs != null) {
        var i = 1;
        for (i = 0; i < strs.length; i++) {
            str += "{qxqname :\"" + strs[i].qxqName + "\", name :" + strs[i].nameId + ",content:\"" + strs[i].name + "\", title: \"" + strs[i].name + "\", imageOffset: { width: 0, height: 3 }, position: { lat:" + strs[i].Y_flag + ", lng:" + strs[i].X_flag + "} },"
            qxqId = strs[i].nameId;
            qxqName = strs[i].qxqName;
        }
        objmap = eval('[' + str + ']');

        initmap_xz(qxqId,qxqName);
        str = '';

    } else {
        alert("没有返回数据信息！");
    }

}
var map;
//创建和初始化地图函数：      
function initmap_xz(qxqId, qxqName) {
    
//    createmap(); //创建地图
//    setMapEvent_xiangzhen(); //设置地图事件
   addMapControl_xiangzhen(); //向地图添加控件
    addMapOverlay_xiangzhen(); //向地图添加覆盖物
   addMapTool_xiangzhen(); //向地图添加工具
    mapAddSvgOverlay_xiangzhen(qxqId,qxqName); //向地图中添加行政区划
}

//向地图中添加行政区划
function mapAddSvgOverlay_xiangzhen(qxqId, qxqName) {
    //alert(qxqName);
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
function setMapEvent_xiangzhen() {
    defaultCursor = map.getDefaultCursor(); 				   //初始化鼠标
    map.centerAndZoom(new BMap.Point(centX, centY), minLevel); // 定位到地图中心点 
    map.addControl(new BMap.NavigationControl({ type: BMAP_NAVIGATION_CONTROL_LARGE })); 		// 添加导航控件
    //            map.addControl(new BMap.ScaleControl({ anchor: BMAP_ANCHOR_TOP_LEFT })); // 添加比例尺控件
    map.enableScrollWheelZoom(); // 启用滚轮放大缩小
    map.enableKeyboard(); //启用键盘操作
    map.enableDragging();
}
//测距工具
function myDistance_xiangzhen() {
    var myDis = new BMapLib.DistanceTool(map);
    //            for (i in myDis) {
    //                alert(i);
    //                alert(myDis[i]);
    //            }
    function openDis() {
        myDis.open(); // 开启测距
    }
    function closeDis() {
        myDis.close(); // 关闭测距
    }
    //自定义控件工具
    function ZoomControl() {
        // 设置默认停靠位置和偏移量  
        this.defaultAnchor = BMAP_ANCHOR_TOP_LEFT;
        this.defaultOffset = new BMap.Size(70, 10);
    }
    // 通过JavaScript的prototype属性继承于BMap.Control   
    ZoomControl.prototype = new BMap.Control();
    //自定义控件必须实现initialize方法，并且将控件的DOM元素返回   
    // 在本方法中创建个div元素作为控件的容器，并将其添加到地图容器中
    ZoomControl.prototype.initialize = function (map) {
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
                  //  alert(qxqName);
                    mapAddSvgOverlay_xiangzhen(qxqId, qxqName); //向地图中添加行政区划
                    //map.clearOverlays();
                    addMapOverlay_xiangzhen();
                    addMapControl_xiangzhen();



                    var p1 = e.points[0];
                    var p2 = e.points[e.points.length - 1];
                    DrivingRoute_xiangzhen(p1, p2);
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
    var myZoomCtrl = new ZoomControl();
    map.addControl(myZoomCtrl);

}
//在线离线切换
function OnLineOff_xiangzhen() {
    //自定义控件工具
    function ZoomControl_xiangzhen() {
        // 设置默认停靠位置和偏移量  
        this.defaultAnchor = BMAP_ANCHOR_TOP_LEFT;
        this.defaultOffset = new BMap.Size(120, 10);
    }
    // 通过JavaScript的prototype属性继承于BMap.Control   
    ZoomControl_xiangzhen.prototype = new BMap.Control();
    //自定义控件必须实现initialize方法，并且将控件的DOM元素返回   
    // 在本方法中创建个div元素作为控件的容器，并将其添加到地图容器中
    ZoomControl_xiangzhen.prototype.initialize = function (map) {
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
        if (getCookie_xiangzhen("name") == "tileMapType") {
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
                addMapOverlay_xiangzhen();
            }
            else {
                div.innerHTML = "<img src='/Admin/Public/map/offline.png' style='width:50px;height:50px;'/>";
                div.setAttribute("name", "offline");
                map.removeControl(mapType2);
                var tileLayer = new BMap.TileLayer();
                tileLayer.getTilesUrl = function (tileCoord, zoom) {
                    var x = tileCoord.x;
                    var y = tileCoord.y;
                    var url = outputPath + zoom + '/' + x + '/' + y + format;
                    return url;
                }
                var tileMapType = new BMap.MapType('tileMapType', tileLayer, { minZoom: minLevel, maxZoom: 18 });
                map.setMapType(tileMapType);
            }
        }
        // 添加DOM元素到地图中   
        map.getContainer().appendChild(div);
        // 将DOM元素返回  
        return div;
    }
    var myZoomCtrl = new ZoomControl_xiangzhen();
    map.addControl(myZoomCtrl);

}
//自定义控件调用
function addMapTool_xiangzhen() {
    myDistance_xiangzhen();
    OnLineOff_xiangzhen();

}
//驾车路线
function DrivingRoute_xiangzhen(p1, p2) {
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
//获取上一级传递的url参数
function UrlSearch() {
    var name, value;
    var str = location.href; //取得整个地址栏
    var num = str.indexOf("?")
    str = str.substr(num + 1); //取得所有参数   stringvar.substr(start [, length ]

    var arr = str.split("&"); //各个参数放到数组里
    for (var i = 0; i < arr.length; i++) {
        num = arr[i].indexOf("=");
        if (num > 0) {
            name = arr[i].substring(0, num);
            value = arr[i].substr(num + 1);
            this[name] = value;
        }
    }
}

//向地图添加控件
function addMapControl_xiangzhen() {
    map.addControl(new BMap.ScaleControl());
    var cr = new BMap.CopyrightControl({ anchor: BMAP_ANCHOR_BOTTOM_LEFT });   //设置版权控件位置
    map.addControl(cr); //添加版权控件
    //            cr.addCopyright({ id: 1, content: "<span style='color: #000;font: 11px arial,simsun;'>© 2015 CFHLWL - GS(2015)6002号 - Data © </span>" });
}
//添加自定义Marker标注

function addMapOverlay_xiangzhen() {
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
        // var label = new BMap.Label("<a id='" + markers[index].id + "'  onclick='detail(" + markers[index].id + ");' href='center_xingzhengcun.aspx?name1=" + markers[index].name + "'>" + markers[index].title + "</a>", { offset: new BMap.Size(25, 5) });
    var label = new BMap.Label("<a id='" + markers[index].id + "'  onclick='xzcName(" + markers[index].name + ");'>" + markers[index].title + "</a>", { offset: new BMap.Size(25, 5) });
        backatlevel = "<small><a onclick='displayMap()'>赤峰市</a></small>";
        $('#back').html(backatlevel);


        // alert(markers[index].xiangzhenId);
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
            topMp_xz(p.getIcon().imageOffset)

        });
    };
}
//地图状态保持
map.addEventListener("maptypechange", function (e) {
    setCookie_xiangzhen("name", catchMaptype_xiangzhen());
});
//设置cookies
function setCookie_xiangzhen(name, value) {
    var Days = 30;
    var exp = new Date();
    exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
    document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}
//读取cookies
function getCookie_xiangzhen(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");

    if (arr = document.cookie.match(reg))

        return unescape(arr[2]);
    else
        return null;
}
//删除cookies
function delCookie_xiangzhen(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie_xiangzhen(name);
    if (cval != null)
        document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}
//获取地图类型函数
function catchMaptype_xiangzhen() {
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