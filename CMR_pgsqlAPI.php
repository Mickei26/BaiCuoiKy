<?php
if (isset($_POST['functionname'])) {
    $paPDO = initDB();
    $paSRID = '4326';
    $paPoint = 0;
    if (isset($_POST['input'])) $input = $_POST['input'];
    if (isset($_POST['paPoint'])) $paPoint = $_POST['paPoint'];
    $functionname = $_POST['functionname'];
    $kieu = 1;
    $aResult = "null";
    if ($functionname == 'getGeoCMRToAjax')
        $aResult = getGeoCMRToAjax($paPDO, $paSRID, $paPoint);
    else if ($functionname == 'getInfoCMRToAjax')
        $aResult = getInfoCMRToAjax($paPDO, $paSRID, $paPoint);
    else if ($functionname == 'getkieubaoton')
        $aResult = getkieubaoton($paPDO, $paSRID, $paPoint, 1);
    else if ($functionname == 'getkieubaoton2')
        $aResult = getkieubaoton2($paPDO, $paSRID, $paPoint, 2);
    else if ($functionname == 'getkieubaoton3')
        $aResult = getkieubaoton3($paPDO, $paSRID, $paPoint, 3);
    else if ($functionname == 'getkieubaoton4')
        $aResult = getkieubaoton4($paPDO, $paSRID, $paPoint, 4);
    else if ($functionname == 'getkieubaoton5')
        $aResult = getkieubaoton5($paPDO, $paSRID, $paPoint, 5);
    else if ($functionname == 'getkieubaoton6')
        $aResult = getkieubaoton6($paPDO, $paSRID, $paPoint, 6);
    else if ($functionname == 'timkiembaoton')
        $aResult = timkiembaoton($paPDO, $paSRID, $paPoint, $input);

    echo ($aResult);
    // print_r($aResult);
    closeDB($paPDO);
}

function initDB()
{
    // Kết nối CSDL
    $paPDO = new PDO('pgsql:host=localhost;dbname=TestCSDL;port=5432', 'postgres', '88888888');
    return $paPDO;
}
function query($paPDO, $paSQLStr)
{
    try {
        // Khai báo exception
        $paPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sử đụng Prepare 
        $stmt = $paPDO->prepare($paSQLStr);
        // Thực thi câu truy vấn
        $stmt->execute();

        // Khai báo fetch kiểu mảng kết hợp
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Lấy danh sách kết quả
        $paResult = $stmt->fetchAll();
        return $paResult;
    } catch (PDOException $e) {
        echo "Thất bại, Lỗi: " . $e->getMessage();
        return null;
    }
}
function closeDB($paPDO)
{
    // Ngắt kết nối
    $paPDO = null;
}
function example1($paPDO)
{
    $mySQLStr = "SELECT * FROM \"khu_bao_ton\"";
    $result = query($paPDO, $mySQLStr);

    if ($result != null) {
        // Lặp kết quả
        foreach ($result as $item) {
            echo $item['ten'] . ' - ' . $item['kieu_bt'];
            echo "<br>";
        }
    } else {
        echo "example1 - null";
        echo "<br>";
    }
}
function example2($paPDO)
{
    $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\"";
    $result = query($paPDO, $mySQLStr);

    if ($result != null) {
        // Lặp kết quả
        foreach ($result as $item) {
            echo $item['geo'];
            echo "<br><br>";
        }
    } else {
        echo "example2 - null";
        echo "<br>";
    }
}
function example3($paPDO, $paSRID, $paPoint)
{
    echo $paPoint;
    echo "<br>";
    $paPoint = str_replace(',', ' ', $paPoint);
    echo $paPoint;
    echo "<br>";
    //$mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"CMR_adm1\" where ST_Within('SRID=4326;POINT(12 5)'::geometry,geom)";
    $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where ST_Within('SRID=" . $paSRID . ";" . $paPoint . "'::geometry,geom)";
    echo $mySQLStr;
    echo "<br><br>";
    $result = query($paPDO, $mySQLStr);

    if ($result != null) {
        // Lặp kết quả
        foreach ($result as $item) {
            echo $item['geo'];
            echo "<br><br>";
        }
    } else {
        echo "example2 - null";
        echo "<br>";
    }
}

function getResult($paPDO, $paSRID, $paPoint)
{
    //echo $paPoint;
    //echo "<br>";
    $paPoint = str_replace(',', ' ', $paPoint);
    //echo $paPoint;
    //echo "<br>";
    //$mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"CMR_adm1\" where ST_Within('SRID=4326;POINT(12 5)'::geometry,geom)";
    $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where ST_Within('SRID=" . $paSRID . ";" . $paPoint . "'::geometry,geom)";
    //echo $mySQLStr;
    //echo "<br><br>";
    $result = query($paPDO, $mySQLStr);

    if ($result != null) {
        // Lặp kết quả
        foreach ($result as $item) {
            return $item['geo'];
        }
    } else
        return "null";
}
function getGeoCMRToAjax($paPDO, $paSRID, $paPoint)
{
    //echo $paPoint;
    //echo "<br>";
    $paPoint = str_replace(',', ' ', $paPoint);
    //echo $paPoint;
    //echo "<br>";
    //$mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"CMR_adm1\" where ST_Within('SRID=4326;POINT(12 5)'::geometry,geom)";
    $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where ST_Within('SRID=" . $paSRID . ";" . $paPoint . "'::geometry,geom)";
    //echo $mySQLStr;
    //echo "<br><br>";
    $result = query($paPDO, $mySQLStr);

    if ($result != null) {
        // Lặp kết quả
        foreach ($result as $item) {
            return $item['geo'];
        }
    } else
        return "null";
}

function getkieubaoton($paPDO, $paSRID, $paPoint, $kieu)
{
    //echo $paPoint;
    //echo "<br>";
    $paPoint = str_replace(',', ' ', $paPoint);
    //echo $paPoint;
    //echo "<br>";
    //$mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"CMR_adm1\" where ST_Within('SRID=4326;POINT(12 5)'::geometry,geom)";
    // $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where ST_Within('SRID=" . $paSRID . ";" . $paPoint . "'::geometry,geom)";
    // //echo $mySQLStr;
    // //echo "<br><br>";
    // $result = query($paPDO, $mySQLStr);
    if ($kieu == 1) {
        $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where kieu_bt = 'Vườn quốc gia'";
    }
    $result = query($paPDO, $mySQLStr);
    $mang = [];
    for ($x = 0; $x < sizeof($result); $x++) {
        array_push($mang, $result[$x]['geo']);
    }
    return str_replace('}"', '}', str_replace('"{', '{', str_replace('\\', '', json_encode($mang))));

    // if ($result != null) {
    //     // Lặp kết quả
    //     foreach ($result as $item) {
    //         return $item['geo'];
    //     }
    // } else
    //     return "null";
}

function getkieubaoton2($paPDO, $paSRID, $paPoint, $kieu)
{
    // $paPoint = str_replace(',', ' ', $paPoint);
    // $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where ST_Within('SRID=" . $paSRID . ";" . $paPoint . "'::geometry,geom)";
    // $result = query($paPDO, $mySQLStr);
    if ($kieu == 2) {
        $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where kieu_bt = 'Khu bảo tồn thiên nhiên'";
    }
    $result = query($paPDO, $mySQLStr);
    $mang = [];
    for ($x = 0; $x < sizeof($result); $x++) {
        array_push($mang, $result[$x]['geo']);
    }
    return str_replace('}"', '}', str_replace('"{', '{', str_replace('\\', '', json_encode($mang))));
}

function getkieubaoton3($paPDO, $paSRID, $paPoint, $kieu)
{
    // $paPoint = str_replace(',', ' ', $paPoint);
    // $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where ST_Within('SRID=" . $paSRID . ";" . $paPoint . "'::geometry,geom)";
    // $result = query($paPDO, $mySQLStr);
    if ($kieu == 3) {
        $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where kieu_bt = 'Khu bảo tồn loài và sinh cảnh'";
    }
    $result = query($paPDO, $mySQLStr);
    $mang = [];
    for ($x = 0; $x < sizeof($result); $x++) {
        array_push($mang, $result[$x]['geo']);
    }
    return str_replace('}"', '}', str_replace('"{', '{', str_replace('\\', '', json_encode($mang))));
}

function getkieubaoton4($paPDO, $paSRID, $paPoint, $kieu)
{

    if ($kieu == 4) {
        $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where kieu_bt = 'Rừng đặc dụng'";
    }
    $result = query($paPDO, $mySQLStr);
    $mang = [];
    for ($x = 0; $x < sizeof($result); $x++) {
        array_push($mang, $result[$x]['geo']);
    }
    return str_replace('}"', '}', str_replace('"{', '{', str_replace('\\', '', json_encode($mang))));
}

function getkieubaoton5($paPDO, $paSRID, $paPoint, $kieu)
{

    if ($kieu == 5) {
        $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where kieu_bt = 'Vùng đất ngập nước'";
    }
    $result = query($paPDO, $mySQLStr);
    $mang = [];
    for ($x = 0; $x < sizeof($result); $x++) {
        array_push($mang, $result[$x]['geo']);
    }
    return str_replace('}"', '}', str_replace('"{', '{', str_replace('\\', '', json_encode($mang))));
}

function getkieubaoton6($paPDO, $paSRID, $paPoint, $kieu)
{

    if ($kieu == 6) {
        $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where kieu_bt = 'Khu bảo vệ cảnh quan'";
    }
    $result = query($paPDO, $mySQLStr);
    $mang = [];
    for ($x = 0; $x < sizeof($result); $x++) {
        array_push($mang, $result[$x]['geo']);
    }
    return str_replace('}"', '}', str_replace('"{', '{', str_replace('\\', '', json_encode($mang))));
}



function timkiembaoton($paPDO, $paSRID, $paPoint, $input)
{
// return $input;
    // $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where ten  ILIKE '%Cúc%'";
    $mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"khu_bao_ton\" where ten  ILIKE '%" . $input . "%'";
    $result = query($paPDO, $mySQLStr);
    $mang = [];
    if ($result != null) {
        for ($x = 0; $x < sizeof($result); $x++) {
            array_push($mang, $result[$x]['geo']);
        }
        return str_replace('}"', '}', str_replace('"{', '{', str_replace('\\', '', json_encode($mang))));
    } else
        return "null";
}





function getInfoCMRToAjax($paPDO, $paSRID, $paPoint)
{
    $paPoint = str_replace(',', ' ', $paPoint);
    //$mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"CMR_adm1\" where ST_Within('SRID=4326;POINT(12 5)'::geometry,geom)";
    //$mySQLStr = "SELECT ST_AsGeoJson(geom) as geo from \"CMR_adm1\" where ST_Within('SRID=".$paSRID.";".$paPoint."'::geometry,geom)";
    $mySQLStr = "SELECT ten, kieu_bt, cap_bt, nam_dexuat, ST_Area(ST_Transform(geom, 26986))/1000000 as dientich from \"khu_bao_ton\" where ST_Within('SRID=" . $paSRID . ";" . $paPoint . "'::geometry,geom)";
    $result = query($paPDO, $mySQLStr);

    if ($result != null) {
        $resFin = '<table>';
        // Lặp kết quả
        foreach ($result as $item) {
            $resFin = $resFin . '<tr ><td >Tên: </td><td>' . $item['ten'] . '</td></tr>';
            $resFin = $resFin . '<tr ><td >Kiểu: </td><td>' . $item['kieu_bt'] . '</td></tr>';
            $resFin = $resFin . '<tr ><td >Cấp độ: </td><td>' . $item['cap_bt'] . '</td></tr>';
            $resFin = $resFin . '<tr ><td >Năm được đề xuất: </td><td>' . $item['nam_dexuat'] . '</td></tr>';
            $resFin = $resFin . '<tr ><td >Diện tích: </td><td>' . $item['dientich'] . ' km2</td></tr>';
            // $resFin = $resFin . '<tr ><td >Toạ độ: </td><td id = "coords"></td></tr>';
            // $resFin = $resFin.'<tr><td>Chu vi: '.$item['ST_Perimeter(geom)'].'</td></tr>';
            break;
        }
        $resFin = $resFin . '</table>';
        return $resFin;
    } else
        return "null";
}
