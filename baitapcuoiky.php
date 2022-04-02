<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> Bài Cuối kì</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- add thu vien API  -->
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css" />
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>

    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js" type="text/javascript"></script>

    <!-- Thư viện làm giao diện -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Chinh style css cho map -->
    <style>
        /*
            .map, .righ-panel {
                height: 500px;
                width: 80%;
                float: left;
            }
            */


        .map,
        .right-panel {
            height: 100vh;
            width: 50vw;
            float: left;
        }

        /* .bottom-right {
            position: absolute;
            bottom: auto;
            right: auto;
        } */

        .img2 {
            width: auto;
            height: 270px;
        }

        .map {
            border: 1px solid #000;
            position: relative;
            text-align: center;
            color: black;
            margin-bottom: 1px;
            margin-left: 20px;
            margin-right: 20px;
        }

        .table {
            border-collapse: collapse;
            border: 1px solid black;
            height: fit-content;
            width: 400px;
            text-align: left;
            border-spacing: 0px;
        }

        .coordcss {
            margin-left: 600px;
            margin-top: 20px;
        }



        .ol-popup {
            position: absolute;
            background-color: white;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #cccccc;
            bottom: 12px;
            left: -50px;
            min-width: 280px;
        }

        .ol-popup:after,
        .ol-popup:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .ol-popup:after {
            border-top-color: white;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
        }

        .search-container {
            position: relative;
            padding: 0px 10px;
            margin-top: 20px;
            margin-left: 600px;
            /* margin-right: 100px; */
            /* right: 350px; */
            background: transparent;
            font-size: 17px;
            border: none;
            cursor: pointer;
            /* border:1px solid red; */
        }

        .ol-popup:before {
            border-top-color: #cccccc;
            border-width: 11px;
            left: 48px;
            margin-left: -11px;
        }

        .ol-popup-closer {
            text-decoration: none;
            position: absolute;
            top: 2px;
            right: 8px;
        }

        .ol-popup-closer:after {
            content: "✖";
        }

        .page-footer {
            margin-left: 800px;
            background-color: #4c4c4c;
            width: 700px;
            /* height: 200px; */
            color: papayawhip;
            position: relative;
            bottom: 0px;
            margin-bottom: 1px;
            margin-top: 97px;

        }

        .footer-copyright {
            background-color: #333333;
            color: aliceblue;
        }
    </style>
</head>

<body onload="initialize_map();">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Tên  -->
        <a class="navbar-brand" href="baitapcuoiky.php">Trường Đại học Thủy Lợi</a>
    </nav>
    <h2 style="margin-left:250px"><span style="color:pink">Các khu bảo tồn Việt Nam Web Map Service in GeoServer</span></h2>
    <!-- day la table du lieu -->
    <div id="map" class="map"></div>
    <div id="result"></div>
    <div id="popup" class="ol-popup">
        <a href="#" id="popup-closer" class="ol-popup-closer"></a>
        <div id="popup-content"> </div>
    </div>

    <!-- anh chu thich -->
    <h3>
        Khu vực bảo tồn tương ứng với màu
    </h3>
    <div class="img"><img src="anh/chuthichmau2.png" class="img2"></div>
    <div class="search-container">
        <form>
            <input id="nhap" type="text" name="nhap" placeholder="Nhập tên khu bảo tồn..">
            <input id="bttk" type="button" value="Search"></input>

        </form>
    </div>
    <div id="coordsOn" class="coordcss"></div>
    <!-- Footer -->
    <footer class="page-footer font-small blue pt-4">

        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase">Hệ thống thông tin địa lý</h5>
                    <p>Bài tập lớn cuối kỳ Nhóm 8 .Các khu bảo tồn Việt Nam Web Map Service in GeoServer</p>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none pb-3">

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h6 class="text-uppercase">Nhóm 8</h6>

                    <ul class="list-unstyled">
                        <li>
                            <h7>Trịnh Văn Phúc</h7>
                        </li>
                        <li>
                            <h7>Vũ Quốc Huy</h7>
                        </li>
                        <li>
                            <h7>Đàm Khôi Nguyên</h7>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h6 class="text-uppercase">___MSV___</h6>
                    <ul class="list-unstyled">
                        <li>
                            <h7>1851171738</h7>
                        </li>
                        <li>
                            <h7>1851171442</h7>
                        </li>
                        <li>
                            <h7>1851171686</h7>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2022 Copyright: Nhóm 8 - 60PM1-2
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->




    <!-- ket noi voi xu ly  -->
    <?php include 'CMR_pgsqlAPI.php' ?>
    <script>
        // $("#document").ready(function () {
        var format = 'image/png';
        var map;
        var minX = 102.15218353271484;
        var minY = 8.568991661071777;
        var maxX = 109.45783233642578;
        var maxY = 23.16864585876465;
        var cenX = (minX + maxX) / 2;
        var cenY = (minY + maxY) / 2;
        var mapLat = cenY;
        var mapLng = cenX;
        var mapDefaultZoom = 6;


        function initialize_map() {
            //*
            layerBG = new ol.layer.Tile({
                source: new ol.source.OSM({

                })
            });
            //*/
            var layerCMR_adm1 = new ol.layer.Image({
                source: new ol.source.ImageWMS({
                    ratio: 1,
                    //sửa theo localhost
                    url: 'http://localhost:8080/geoserver/GIS/wms?',
                    params: {
                        'FORMAT': format,
                        'VERSION': '1.1.1',
                        STYLES: '',
                        LAYERS: 'khu_bao_ton',
                    }
                })
            });

            //tao cac tinh nang overlayer
            var container = document.getElementById('popup');
            var content = document.getElementById('popup-content');
            var closer = document.getElementById('popup-closer');

            //popup dữ liệu
            var overlay = new ol.Overlay({
                element: container,
                autoPan: true,
                autoPanAnimation: {
                    duration: 250
                }
            });
            // hàm viewmap 
            var viewMap = new ol.View({
                center: ol.proj.fromLonLat([mapLng, mapLat]),
                zoom: mapDefaultZoom
                //projection: projection
            });
            map = new ol.Map({
                target: "map",
                overlays: [overlay],
                // layer nền và layer bài làm
                layers: [layerBG, layerCMR_adm1],

                //layers: [layerCMR_adm1],
                view: viewMap
            });
            //map.getView().fit(bounds, map.getSize());

            //popup 
            closer.onclick = function() {
                overlay.setPosition(undefined);
                closer.blur();
                return false;
            };
            map.on('singleclick', function(evt) {
                var coordinate = evt.coordinate;
                var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
                var lon = lonlat[0];
                var lat = lonlat[1];
                var myPoint = 'POINT(' + lon + ',' + lat + ')';
                var toado = 'Toạ độ :' + lon + '-' + lat;
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",

                    data: {
                        functionname: 'getInfoCMRToAjax',
                        paPoint: myPoint
                    },
                    success: function(result, status, erro) {
                        displayObjInfo(result, evt.coordinate);
                    },
                    error: function(req, status, error) {
                        alert(req + " " + status + " " + error);
                    }
                });
                // document.getElementById('coords').innerHTML = myPoint;
                content.innerHTML = '<div class= "table" id ="info" ></div>' + toado;
                overlay.setPosition(coordinate);
            });


            document.getElementById("bttk").addEventListener('click', function(evt) {
                var myinput = document.getElementById("nhap").value;

                // console.log(myinput)
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",
                    data: {
                        functionname: 'timkiembaoton',
                        input: myinput,
                    },
                    success: function(result, status, erro) {
                        highLightObj7(result);
                    },
                    error: function(req, status, error) {
                        alert(req + " " + status + " " + error);
                    }
                });
            });












            //set mau cho tung vung
            var kieu1 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        color: '#99FF33'
                    }),
                    stroke: new ol.style.Stroke({
                        color: 'black',
                        width: 1
                    })
                })
            };
            var styleFunction1 = function(feature) {
                return kieu1[feature.getGeometry().getType()];
            };
            var vectorLayer = new ol.layer.Vector({
                //source: vectorSource,
                style: styleFunction1
            });
            map.addLayer(vectorLayer);



            var kieu2 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        color: '#009900'
                    }),
                    stroke: new ol.style.Stroke({
                        color: 'black',
                        width: 1
                    })
                })
            };
            var styleFunction2 = function(feature) {
                return kieu2[feature.getGeometry().getType()];
            };

            var vectorLayer2 = new ol.layer.Vector({
                //source: vectorSource,
                style: styleFunction2
            });
            map.addLayer(vectorLayer2);

            var kieu3 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        color: '#663333'
                    }),
                    stroke: new ol.style.Stroke({
                        color: 'black',
                        width: 1
                    })
                })
            };
            var styleFunction3 = function(feature) {
                return kieu3[feature.getGeometry().getType()];
            };

            var vectorLayer3 = new ol.layer.Vector({
                //source: vectorSource,
                style: styleFunction3
            });
            map.addLayer(vectorLayer3);


            var kieu4 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        color: '#BC781F'
                    }),
                    stroke: new ol.style.Stroke({
                        color: 'black',
                        width: 1
                    })
                })
            };
            var styleFunction4 = function(feature) {
                return kieu4[feature.getGeometry().getType()];
            };

            var vectorLayer4 = new ol.layer.Vector({
                //source: vectorSource,
                style: styleFunction4
            });
            map.addLayer(vectorLayer4);


            var kieu5 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        color: '#33CCFF'
                    }),
                    stroke: new ol.style.Stroke({
                        color: 'black',
                        width: 1
                    })
                })
            };
            var styleFunction5 = function(feature) {
                return kieu5[feature.getGeometry().getType()];
            };

            var vectorLayer5 = new ol.layer.Vector({
                //source: vectorSource,
                style: styleFunction5
            });
            map.addLayer(vectorLayer5);


            var kieu6 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        color: '#FFFF33'
                    }),
                    stroke: new ol.style.Stroke({
                        color: 'black',
                        width: 1
                    })
                })
            };
            var styleFunction6 = function(feature) {
                return kieu6[feature.getGeometry().getType()];
            };
            var vectorLayer6 = new ol.layer.Vector({
                //source: vectorSource,
                style: styleFunction6
            });
            map.addLayer(vectorLayer6);








            //chuc nang tao doi tuong de luu tru du lieu
            function createJsonObj(myJSON) {
                var geojsonObject = '{' +
                    '"type": "FeatureCollection",' +
                    '"crs": {' +
                    '"type": "name",' +
                    '"properties": {' +
                    '"name": "EPSG:4326"' +
                    '}' +
                    '},' +
                    '"features": [';
                for (let i = 0; i < myJSON.length; i++) {
                    geojsonObject += '{' +
                        '"type": "Feature",' +
                        '"geometry": ' + JSON.stringify(myJSON[i]) +
                        '},'
                };
                geojsonObject = geojsonObject.slice(0, -1)
                // console.log(geojsonObject)
                geojsonObject += ']' +
                    '}';
                // console.log(geojsonObject)
                return geojsonObject;
            }
            //chuc nang ve ra doi tuong 
            function drawGeoJsonObj(paObjJson) {
                var vectorSource = new ol.source.Vector({
                    features: (new ol.format.GeoJSON()).readFeatures(paObjJson, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    })
                });
                var vectorLayer = new ol.layer.Vector({
                    source: vectorSource,
                    visible: true
                });
                map.addLayer(vectorLayer);
            }
            //display thong tin cua hinh
            function displayObjInfo(result, coordinate) {
                // alert("result: " + result);
                // alert("coordinate des: " + coordinate);
                $("#info").html(result);
            }







            // styles cho viền
            var kieu7 = {
                'MultiPolygon': new ol.style.Style({

                    stroke: new ol.style.Stroke({
                        color: 'red',
                        width: 3
                    })
                })
            };
            var styleFunction7 = function(feature) {
                return kieu7[feature.getGeometry().getType()];
            };
            var vectorLayer7 = new ol.layer.Vector({
                //source: vectorSource,
                style: styleFunction7
            });
            map.addLayer(vectorLayer7);
            //to mau map
            function highLightGeoJsonObj7(paObjJson) {
                var vectorSource = new ol.source.Vector({
                    features: (new ol.format.GeoJSON()).readFeatures(paObjJson, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    })
                });
                vectorLayer7.setSource(vectorSource);
            }
            //hightlightsdfsdfsdfsdfsdfsd
            function highLightObj7(result) {
                var objJson = JSON.parse(result);
                var strObjJson = createJsonObj(objJson);
                highLightGeoJsonObj7(strObjJson);
            }

            map.on('singleclick', function(evt) {
                //alert("coordinate: " + evt.coordinate);
                //var myPoint = 'POINT(12,5)';
                var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
                var lon = lonlat[0];
                var lat = lonlat[1];
                var myPoint = 'POINT(' + lon + ' ' + lat + ')';
                //alert("myPoint: " + myPoint);
                //*
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",
                    //dataType: 'json',
                    data: {
                        functionname: 'getGeoCMRToAjax',
                        paPoint: myPoint
                    },
                    success: function(result, status, erro) {
                        highLightGeoJsonObj7(result);
                    },
                    error: function(req, status, error) {
                        alert(req + " " + status + " " + error);
                    }
                });
            });









            //to mau map
            function highLightGeoJsonObj1(paObjJson) {
                var vectorSource = new ol.source.Vector({
                    features: (new ol.format.GeoJSON()).readFeatures(paObjJson, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    })
                });
                vectorLayer.setSource(vectorSource);
            }

            function highLightObj1(result) {
                var objJson = JSON.parse(result);
                var strObjJson = createJsonObj(objJson);
                highLightGeoJsonObj1(strObjJson);
            }



            function highLightGeoJsonObj2(paObjJson) {
                var vectorSource = new ol.source.Vector({
                    features: (new ol.format.GeoJSON()).readFeatures(paObjJson, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    })
                });
                vectorLayer2.setSource(vectorSource);
            }

            function highLightObj2(result) {
                var objJson = JSON.parse(result);
                var strObjJson = createJsonObj(objJson);
                highLightGeoJsonObj2(strObjJson);
            }




            function highLightGeoJsonObj3(paObjJson) {
                var vectorSource = new ol.source.Vector({
                    features: (new ol.format.GeoJSON()).readFeatures(paObjJson, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    })
                });
                vectorLayer3.setSource(vectorSource);
            }

            function highLightObj3(result) {
                var objJson = JSON.parse(result);
                var strObjJson = createJsonObj(objJson);
                highLightGeoJsonObj3(strObjJson);
            }




            function highLightGeoJsonObj4(paObjJson) {
                var vectorSource = new ol.source.Vector({
                    features: (new ol.format.GeoJSON()).readFeatures(paObjJson, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    })
                });
                vectorLayer4.setSource(vectorSource);
            }

            function highLightObj4(result) {
                var objJson = JSON.parse(result);
                var strObjJson = createJsonObj(objJson);
                highLightGeoJsonObj4(strObjJson);
            }




            function highLightGeoJsonObj5(paObjJson) {
                var vectorSource = new ol.source.Vector({
                    features: (new ol.format.GeoJSON()).readFeatures(paObjJson, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    })
                });
                vectorLayer5.setSource(vectorSource);
            }

            function highLightObj5(result) {
                var objJson = JSON.parse(result);
                var strObjJson = createJsonObj(objJson);
                highLightGeoJsonObj5(strObjJson);
            }



            function highLightGeoJsonObj6(paObjJson) {
                var vectorSource = new ol.source.Vector({
                    features: (new ol.format.GeoJSON()).readFeatures(paObjJson, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    })
                });
                vectorLayer6.setSource(vectorSource);
            }

            function highLightObj6(result) {
                var objJson = JSON.parse(result);
                var strObjJson = createJsonObj(objJson);
                highLightGeoJsonObj6(strObjJson);
            }













            map.once('postrender', function(evt) {

                //alert("coordinate: " + evt.coordinate);
                //var myPoint = 'POINT(12,5)';
                // var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
                // var lon = lonlat[0];
                // var lat = lonlat[1];
                // var myPoint = 'POINT(' + lon + ',' + lat + ')';
                //alert("myPoint: " + myPoint);
                //*
                // console.log("test")
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",
                    //dataType: 'json',
                    data: {
                        functionname: 'getkieubaoton',
                    },
                    success: function(result, status, erro) {
                        highLightObj1(result);
                        // console.log(result);
                    },
                    error: function(req, status, error) {
                        alert(req + " " + status + " " + error);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",
                    //dataType: 'json',
                    data: {
                        functionname: 'getkieubaoton2',

                    },
                    success: function(result, status, erro) {
                        highLightObj2(result);

                    },
                    error: function(req, status, error) {
                        alert(req + " " + status + " " + error);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",
                    //dataType: 'json',
                    data: {
                        functionname: 'getkieubaoton3',

                    },
                    success: function(result, status, erro) {
                        highLightObj3(result);

                    },
                    error: function(req, status, error) {
                        alert(req + " " + status + " " + error);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",
                    //dataType: 'json',
                    data: {
                        functionname: 'getkieubaoton4',

                    },
                    success: function(result, status, erro) {
                        highLightObj4(result);

                    },
                    error: function(req, status, error) {
                        alert(req + " " + status + " " + error);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",
                    //dataType: 'json',
                    data: {
                        functionname: 'getkieubaoton5',

                    },
                    success: function(result, status, erro) {
                        highLightObj5(result);

                    },
                    error: function(req, status, error) {
                        alert(req + " " + status + " " + error);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",
                    //dataType: 'json',
                    data: {
                        functionname: 'getkieubaoton6',
                    },
                    success: function(result, status, erro) {
                        highLightObj6(result);

                    },
                    error: function(req, status, error) {
                        alert(req + " " + status + " " + error);
                    }
                });
            });



            map.on('pointermove', function(evt) {
                console.info(evt.pixel);
                console.info(map.getPixelFromCoordinate(evt.coordinate));
                console.info(ol.proj.toLonLat(evt.coordinate));
                var coords = ol.proj.toLonLat(evt.coordinate);
                var lat = coords[1];
                var lon = coords[0];
                var myPoint = ' Kinh độ: ' + lon + '-' + 'Vĩ độ: ' + lat + '';
                document.getElementById('coordsOn').innerHTML = myPoint;
            });


            // map.on('click', function(evt) {
            //     console.info(evt.pixel);
            //     console.info(map.getPixelFromCoordinate(evt.coordinate));
            //     console.info(ol.proj.toLonLat(evt.coordinate));
            //     var coords = ol.proj.toLonLat(evt.coordinate);
            //     var lat = coords[1];
            //     var lon = coords[0];
            //     var myPoint = '' + lat + '  ' + lon + '';
            //     document.getElementById('coords').innerHTML = myPoint;
            // });


            // map.on('click', function(evt) {
            //     // alert("coordinate org: " + evt.coordinate);
            //     // var myPoint = 'POINT(12,5)';
            //     var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
            //     var lon = lonlat[0];
            //     var lat = lonlat[1];
            //     var myPoint = 'POINT(' + lon + ' ' + lat + ')';
            //     // alert("myPoint: " + myPoint);
            //     //*
            //     $.ajax({
            //         type: "POST",
            //         url: "CMR_pgsqlAPI.php",
            //         //dataType: 'json',
            //         //data: {functionname: 'reponseGeoToAjax', paPoint: myPoint},
            //         data: {
            //             functionname: 'getInfoCMRToAjax',
            //             paPoint: myPoint
            //         },
            //         success: function(result, status, erro) {
            //             displayObjInfo(result, evt.coordinate);
            //         },
            //         error: function(req, status, error) {
            //             alert(req + " " + status + " " + error);
            //         }
            //     });
            //     //*/
            // });
        };


        // });
    </script>

</body>

</html>