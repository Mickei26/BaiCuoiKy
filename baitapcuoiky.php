<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bài Cuối Kỳ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Thư viện API  -->
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css" />
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>

    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js" type="text/javascript"></script>

    <!-- Thư viện làm giao diện -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <style>
        .map,
        .right-panel {
            height: 100vh;
            width: 50vw;
            float: left;
        }

        .img2 {
            width: auto;
            height: 320px;
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
            background: transparent;
            font-size: 24px;
            border: none;
            cursor: pointer;
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
            margin-left: 750px;
            background-color: #4d4d4d;
            width: 700px;
            color: papayawhip;
            position: relative;
            bottom: 0px;
            margin-bottom: 1px;
            margin-top: 30px;

        }

        .footer-copyright {
            background-color: #333333;
            color: aliceblue;
        }

        .show-hide {
            height: 50px;
            padding: 10px;
            font-weight: bold;
            background-color: #eee;
            color: #000;
        }
    </style>
</head>

<body onload="initialize_map();">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="baitapcuoiky.php">Trường Đại học Thủy Lợi</a>
    </nav>
    <h2 style="text-align:center"><span style="color:red">Quản lý các khu bảo tồn ở Việt Nam</span></h2>
    <!-- show dữ liệu trên web -->
    <div id="map" class="map"></div>
    <div id="result"></div>
    <div id="popup" class="ol-popup">
        <a href="#" id="popup-closer" class="ol-popup-closer"></a>
        <div id="popup-content"> </div>
    </div>
    <h3>
        Chú thích màu cho các khu bảo tồn
    </h3>
    <div class="img"><img src="anh/chuthichmau.png" class="img2"></div>
    <div class="search-container">
        <form>
            <input id="nhap" type="text" name="nhap" placeholder="Nhập tên khu bảo tồn..">
            <input id="bttk" type="button" value="Search"></input>
        </form>
    </div>
    <div id="coordsOn" class="coordcss"></div>

    <div class="show-hide">
        <input id="showhide" type="button" value="Show/Hide"></input>

    </div>

    <footer class="page-footer font-small blue pt-4">
        <div class="container-fluid text-center text-md-left">
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <h5 class="text-uppercase">Hệ thống thông tin địa lý</h5>
                    <p>Bài tập lớn cuối kỳ Nhóm 8 .Các khu bảo tồn Việt Nam Web Map Service in GeoServer</p>
                </div>
                <hr class="clearfix w-100 d-md-none pb-3">
                <div class="col-md-3 mb-md-0 mb-3">
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
                <div class="col-md-3 mb-md-0 mb-3">
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
            </div>
        </div>
        <div class="footer-copyright text-center py-3">© 2022 Copyright: Nhóm 8 - 60PM1-2
        </div>
    </footer>

    <!-- kết nối dữ liệu -->
    <?php include 'CMR_pgsqlAPI.php' ?>
    <script>
        // Tạo vị trí hiển thị map 
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

        // khởi tạo map
        function initialize_map() {
            // openstreetmap
            layerBG = new ol.layer.Tile({
                source: new ol.source.OSM({})
            });
            // khu bảo tồn
            var layerkbt = new ol.layer.Image({
                source: new ol.source.ImageWMS({
                    ratio: 1,
                    //sửa theo localhost
                    url: 'http://localhost:8080/geoserver/example/wms??',
                    params: {
                        'FORMAT': format,
                        'VERSION': '1.1.1',
                        STYLES: '',
                        LAYERS: 'khu_bao_ton',
                    }
                })
            });

            //khởi tạo tính năng overlayer
            var container = document.getElementById('popup');
            var content = document.getElementById('popup-content');
            var closer = document.getElementById('popup-closer');

            //hiển thị dữ liệu
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
            });

            map = new ol.Map({
                target: "map",
                overlays: [overlay],
                // layer nền và layer bài làm
                layers: [layerBG, layerkbt],
                view: viewMap
            });
            //map.getView().fit(bounds, map.getSize());

            //lấy dữ liệu để hiển thị thông tin trên popup
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
                content.innerHTML = '<div class= "table" id ="info" ></div>' + toado;
                overlay.setPosition(coordinate);
            });

            //gọi hàm tìm kiếm
            document.getElementById("bttk").addEventListener('click', function(evt) {
                var myinput = document.getElementById("nhap").value;
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

            //Gán màu cho từng kiểu bảo tồn
            // Vườn quốc gia
            var kieu1 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        // đổ màu xanh ngọc
                        color: '#4ddde0'
                    }),
                    stroke: new ol.style.Stroke({
                        // đổ màu viền đen cho vùng
                        color: 'black',
                        width: 1
                    })
                })
            };
            var styleFunction1 = function(feature) {
                return kieu1[feature.getGeometry().getType()];
            };
            var vectorLayer = new ol.layer.Vector({
                style: styleFunction1
            });
            // thêm layer vào map 
            map.addLayer(vectorLayer);

            // Khu bảo tồn thiên nhiên
            var kieu2 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        // đổ màu xanh lá nhạt 
                        color: '#48b269'
                    }),
                    stroke: new ol.style.Stroke({
                        // đổ màu viền đen cho vùng
                        color: 'black',
                        width: 1
                    })
                })
            };
            var styleFunction2 = function(feature) {
                return kieu2[feature.getGeometry().getType()];
            };
            var vectorLayer2 = new ol.layer.Vector({
                style: styleFunction2
            });
            // thêm layer vào map 
            map.addLayer(vectorLayer2);

            // Loài và sinh cảnh
            var kieu3 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        // đổ màu đỏ
                        color: '#d4173f'
                    }),
                    stroke: new ol.style.Stroke({
                        // đổ màu viền đen cho vùng
                        color: 'black',
                        width: 1
                    })
                })
            };
            var styleFunction3 = function(feature) {
                return kieu3[feature.getGeometry().getType()];
            };
            var vectorLayer3 = new ol.layer.Vector({
                style: styleFunction3
            });
            //thêm layer vào map 
            map.addLayer(vectorLayer3);

            // Rừng đặc dụng
            var kieu4 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        // đổ màu xanh lá đậm
                        color: '#0c6b1e'
                    }),
                    stroke: new ol.style.Stroke({
                        // đổ màu viền đen cho vùng
                        color: 'black',
                        width: 1
                    })
                })
            };
            var styleFunction4 = function(feature) {
                return kieu4[feature.getGeometry().getType()];
            };
            var vectorLayer4 = new ol.layer.Vector({
                style: styleFunction4
            });
            // thêm layer vào map 
            map.addLayer(vectorLayer4);

            // Vùng đất ngập nước
            var kieu5 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        // đổ màu hồng 
                        color: '#ffcccc'
                    }),
                    stroke: new ol.style.Stroke({
                        // đổ màu viền đen cho vùng
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
            //thêm layer vào map 
            map.addLayer(vectorLayer5);

            // khu bảo vệ cảnh quan 
            var kieu6 = {
                'MultiPolygon': new ol.style.Style({
                    fill: new ol.style.Fill({
                        // đổ màu xanh xanh nước biển đậm
                        color: '#004390'
                    }),
                    stroke: new ol.style.Stroke({
                        // đổ màu viền đen cho vùng
                        color: 'black',
                        width: 1
                    })
                })
            };
            var styleFunction6 = function(feature) {
                return kieu6[feature.getGeometry().getType()];
            };
            var vectorLayer6 = new ol.layer.Vector({
                style: styleFunction6
            });
            //thêm layer vào map 
            map.addLayer(vectorLayer6);

            //hàm để tạo đối tượng lưu dữ liệu 
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
                geojsonObject += ']' +
                    '}';
                return geojsonObject;
            }

            //hàm vẽ đối tượng 
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

            //hiển thị thông tin của hình
            function displayObjInfo(result, coordinate) {
                $("#info").html(result);
            }

            // đổ màu đỏ cho viền khu được chọn 
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
                style: styleFunction7
            });
            // thêm viền vào trong map
            map.addLayer(vectorLayer7);

            //tô màu map
            function highLightGeoJsonObj7(paObjJson) {
                var vectorSource = new ol.source.Vector({
                    features: (new ol.format.GeoJSON()).readFeatures(paObjJson, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    })
                });
                vectorLayer7.setSource(vectorSource);
            }
            //hightlight
            function highLightObj7(result) {
                var objJson = JSON.parse(result);
                var strObjJson = createJsonObj(objJson);
                highLightGeoJsonObj7(strObjJson);
            }
            map.on('singleclick', function(evt) {
                var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
                var lon = lonlat[0];
                var lat = lonlat[1];
                var myPoint = 'POINT(' + lon + ' ' + lat + ')';
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",
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

            //hightlight của từng khu 
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

            //truy vấn để lấy màu map bên API
            map.once('postrender', function(evt) {
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",
                    data: {
                        functionname: 'getkieubaoton',
                    },
                    success: function(result, status, erro) {
                        highLightObj1(result);
                    },
                    error: function(req, status, error) {
                        alert(req + " " + status + " " + error);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "CMR_pgsqlAPI.php",
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

            // di chuyển chuột để hiển thị kinh độ vĩ độ
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
        };
    </script>
</body>

</html>