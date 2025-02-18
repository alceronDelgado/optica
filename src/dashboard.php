<?php 

session_start();
include_once 'querys/functionsInsert.php';
include_once '../config/conn.php';
if(empty($_SESSION['userName']) || empty($_SESSION['rol'])){

    header("location:../index.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <?php require_once '../assets/templates/head.php' ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<div class="row" id="spanId">
    <div class="col s3 offset-s9 ">
        <span class="flow-text highlight">This div is 7-columns wide on pushed to the right by 5-columns.</span>
    </div>
</div>


<div class="table">
    <table id="myTable" class="responsive-table striped highlight table">
    <div class="col s12 m7 center-align">
        <caption class=" flow-text">Pacientes</caption>
    <div>
    <thead>
        <tr>
            <th class="left-align">Motivo de consulta</th>
            <th>Informacion</th>
            <th>Otro</th>
            <th>Acciones</th>
            <th>Acciones</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tr>
        <td>Tiger Nixon</td>
        <td>System Architect</td>
        <td>Edinburgh</td>
        <td>61</td>
        <td>2011-04-25</td>
        <td>$320,800</td>
    </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011-07-25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009-01-12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012-03-29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008-11-28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012-12-02</td>
                <td>$372,000</td>
            </tr>
            <tr>
                <td>Herrod Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012-08-06</td>
                <td>$137,500</td>
            </tr>
            <tr>
                <td>Rhona Davidson</td>
                <td>Integration Specialist</td>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010-10-14</td>
                <td>$327,900</td>
            </tr>
            <tr>
                <td>Colleen Hurst</td>
                <td>Javascript Developer</td>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009-09-15</td>
                <td>$205,500</td>
            </tr>
            <tr>
                <td>Sonya Frost</td>
                <td>Software Engineer</td>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008-12-13</td>
                <td>$103,600</td>
            </tr>
            <tr>
                <td>Jena Gaines</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>30</td>
                <td>2008-12-19</td>
                <td>$90,560</td>
            </tr>
    </table>
</div>



<menu id="menuDrop">
    <span>item#1</span>
    <span>item#1</span>
    <span>item#1</span>
</menu>

<?php require_once '../assets/templates/imports.php'; ?>
<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/index.js"></script>
</body>
</html>
