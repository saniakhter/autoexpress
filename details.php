<?php
require_once 'admin/server/CarDAO.php';
require_once 'admin/server/DiagramDAO.php';

$v = new CarDAO();
$d = new DiagramDAO();

if(isset($_GET['carId']) && $v->isVehicleExist($_GET['carId'])) {
    $carId = $_GET['carId'];
    $currCar = $v->getCarById($carId); // current car [0]
    $numImg = $d->countAllPhotosByCarId($carId);

    $currCarImg = $d->getPhotosBy_CarId($carId);
} else {
    header('Location: index.php');
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AutoExpress.com</title>

    <link rel="apple-touch-icon" sizes="180x180" href="image/favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/favicon_package_v0.16/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/favicon_package_v0.16/favicon-16x16.png">
    <link rel="manifest" href="image/favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="image/favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link href="css/style.css" rel="stylesheet">
    <link href="css/print-preview.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container_custom">
    <?php include 'template/header.php'; ?>
</div>
<div id="details-container">
    <div id="content_section">
        <div id="vehicle_title"><h3><?php echo $currCar[0]->getHeadingTitle(); ?></h3></div>
        <div style="clear: both" ></div>
        <div class="left_section">
            <?php if($numImg > 0) { ?>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php $h = null; ?>
                    <?php for($i = 0; $i < $numImg; $i++) { ?>
                        <?php if($i == 0) { ?>
                            <?php $h .= '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>'; ?>
                        <?php } else { ?>
                            <?php $h .= '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>'; ?>
                        <?php } ?>
                    <?php } ?>
                    <?php echo $h; ?>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php $ht = null; ?>
                    <?php for($j = 0; $j < $numImg; $j++) { ?>
                        <?php if($j == 0) { ?>
                            <?php
                            $ht .= '<div class="item active">
                                        <img src="'.$currCarImg[$j]->getDiagram().'">
                                    </div>';
                            ?>
                        <?php } else { ?>
                            <?php
                            $ht .= '<div class="item">
                                        <img src="'.$currCarImg[$j]->getDiagram().'">
                                    </div>';
                            ?>
                        <?php } ?>
                    <?php } ?>
                    <?php echo $ht; ?>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="fa fa-arrow-left fa-arrow-position" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="fa fa-arrow-right fa-arrow-position" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php } else { ?>
            <div class="car-images" >
                <img src="https://placeholdit.co//i/272x150?text=Photo Unavailable&bg=111111">
            </div>
            <?php } ?>
            <br><h3><span>Notes</span></h3>
            <textarea id="note-text" rows="8" name="notes"></textarea>
        </div>
        <div class="right_section">
            <div id="vehicle_info">
                <div id="vehicle_info_left">
                    <p>Price</p>
                    <p>Make</p>
                    <p>Model</p>
                    <p>Year</p>
                    <p>Kilometers</p>
                    <p>Transmission</p>
                    <p>Stock Number</p>
                    <p>Drivetrain</p>
                    <p>Exterior Colour</p>
                    <p>Interior Colour</p>
                    <p>Category</p>
                    <p>Cylinders</p>
                    <p>Fuel type</p>
                    <p>Doors</p>
                    <p>Engine Capacity</p>
                    <p>Safety Rating</p>
                </div>
                <div id="vehicle_info_right">
                    <p class="price">$<?php echo $currCar[0]->getPrice(); ?></p>
                    <p><?php echo $currCar[0]->getMake(); ?></p>
                    <p><?php echo $currCar[0]->getModel(); ?></p>
                    <p><?php echo $currCar[0]->getYearMade(); ?></p>
                    <p class="mileage"><?php echo $currCar[0]->getMileage(); ?></p>
                    <p><?php echo $currCar[0]->getTransmission(); ?></p>
                    <p>-</p>
                    <p><?php echo $currCar[0]->getDrivetrain(); ?></p>
                    <p>-</p>
                    <p>-</p>
                    <p><?php echo $currCar[0]->getCategory(); ?></p>
                    <p><?php echo $currCar[0]->getCylinder(); ?></p>
                    <p>-</p>
                    <p><?php echo $currCar[0]->getDoors(); ?></p>
                    <p><?php echo $currCar[0]->getEngineCapacity(); ?> L</p>
                    <p>N/A</p>
                </div>
                <div style="clear: both" ></div>
            </div>
        </div>
        <div style="clear: both" ></div>
        <button id="print-btn" onclick="window.print()">Print</button>
    </div>
    <?php include 'template/footer.php'; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
