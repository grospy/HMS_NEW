<?php

//include '/Applications/MAMP/htdocs/HMS/interface/patient_file/summary/upload.php';
//echo $target_dir;
//echo $path;
//echo "&nbsp;";
//echo $target_dir;
//echo $target_file;

require_once("../../globals.php");

?>
<div id='vitals' style='margin-top: 3px; margin-left: 10px; margin-right: 10px'><!--outer div-->  
<br>

<html>
  <head>
    <link rel="stylesheet" href="http://localhost:8888/HMS/dygraphs/dist/dygraph.css">
    <title>Temperatures with Range Selector</title>
    <script type="text/javascript" src="http://localhost:8888/HMS/dygraphs/dist/dygraph.js"></script>

    <script type="text/javascript" src="http://localhost:8888/HMS/dygraphs/tests/data.js"></script>
    <style type="text/css">
    #bordered {
      border: 1px solid red;
    }
    #dark-background {
      background-color: #101015;
      color: white;
    }
    #darkbg1 .dygraph-axis-label, #darkbg2 .dygraph-axis-label {
      color: white;
    }
    #noroll .dygraph-legend,
    #roll14 .dygraph-legend,
    #darkbg1 .dygraph-legend,
    #darkbg2 .dygraph-legend {
      text-align: right;
    }
    #darkbg1 .dygraph-legend {
      background-color: #101015;
    }
    #darkbg2 .dygraph-legend {
      background-color: #101015;
    }
    </style>
  </head>
  <body>
</form>
&nbsp; &nbsp; &nbsp;
    <h4>Burada göstərilən pasientin kardiqramıdır. (Real Time)</h4>
    <div id="baseballdiv" style="width:950px; height:440px;"></div>
   

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "openemr";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['set_pid'])) {
  include_once("$srcdir/pid.inc");
  setpid($_GET['set_pid']);
}
//echo $pid;

$sql = "SELECT linkToTheMedicalData FROM `patient_data` WHERE id=$pid";
$result = mysqli_query($conn, $sql);
$str = "Crap";

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       // echo "linkToTheMedicalData: " . $row["linkToTheMedicalData"]. "<br>";
        $link = $row['linkToTheMedicalData'];
    }
} else {
    echo "0 results";
}
//$readingResults = mysql_query($sql);

mysqli_close($conn);
?>

<?php
$servername1 = "localhost";
$username1 = "root";
$password1 = "root";
$dbname1 = "openemr";

// Create connection
$conn1 = mysqli_connect($servername1, $username1, $password1, $dbname1);
// Check connection
if (!$conn1) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['set_pid'])) {
  include_once("$srcdir/pid.inc");
  setpid($_GET['set_pid']);
}
//echo $pid;

$sql1 = "SELECT linkToVideoMessage FROM `patient_data` WHERE id=$pid";
$result1 = mysqli_query($conn1, $sql1);

//Now basically this PHP variable needs to be modified from the database, on both doctor side and the user side and the loaded into both monitors.
//$linkToVideo = "http://localhost:8888/HMS/UserFacingSide/users/uploads/RecordRTC-2019011-3in8jfofog3.webm";
if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    while($row1 = mysqli_fetch_assoc($result1)) {
       // echo "linkToTheMedicalData: " . $row["linkToTheMedicalData"]. "<br>";
        $linkToVideo = $row1['linkToVideoMessage'];
    }
} else {
    echo "0 results";
}
//$readingResults = mysql_query($sql);
mysqli_close($conn1);
?>

    <script type="text/javascript" language= ”JavaScript”>
    js_variable_name = "<?php echo $link; ?>";
    alert(js_variable_name);
      g1 = new Dygraph(
          document.getElementById("baseballdiv"),js_variable_name,
          {
            rollPeriod: 14,
            showRoller: true,
           // customBars: true,
          // fractions: true,
          // errorBars: true,
          // showRoller: true,
          // rollPeriod: 15
/*
          legend: 'always',
          title: 'NYC vs. SF',
          showRoller: true,
          rollPeriod: 14,
          customBars: true,*/
          //ylabel: 'Ürək döyüntüsü (F)',
         
            showRangeSelector: true,
            rangeSelectorPlotLineWidth: 1,
            displayAnnotations: true
           // rollPeriod: 14,
           // showRoller: true,
           // customBars: true,
             // {
               // labels: [ 'Date', 'Value' ]
             // }
          }
      );

      g1.ready(function() {
  // This is called when data.csv comes back and the chart draws.
        g1.setAnnotations([{
           series: "Suzuki",
           x: "2009/07/12 17:34",
           shortText: "M",
           text: "Marker"
         },
         {
           series: "Suzuki",
           x: "2009/07/14 00:45",
           shortText: "L",
           text: "Large"
         }
         ],
         );
    });
      /*
       <h2>Stock Chart demo</h2>
  <div id="stock_div" style="width: 600px; height: 320px;"></div>

      g = new Dygraph(document.getElementById("stock_div"),
        stockData,
        {
          customBars: true,
          logscale: true
        }); 

    function setLog(val) {
      g.updateOptions({ logscale: val });
      document.getElementById("linear").disabled = !val;
      document.getElementById("log").disabled = val;
    }*/

    </script>




<video width="880" height="640" controls>
 <!-- <source src="/Users/shamilkarimli/Desktop/RecordRTC-2019011-eekqrmio1qn.mkv" type="video/x-matroska"> -->
 <source src=<?php echo $linkToVideo; ?> type="video/webm">
  Your browser does not support the video tag.
</video>
       <h2> Istifadəçi fayyları ilə əməliyatlar şöbəsi : </h2> 
    <form action="upload.php?pid=<?php echo $pid ?>" method="post" enctype="multipart/form-data">
  <p> <h4> Serverə yüklənilməsi üçün xəstə datasını seçin (ancaq .txt qəbul edilir): </h4>   <input type="file" name="fileToUpload" id="fileToUpload">   <br> <input type="submit" value="Datanı yüklə" name="submit"> <br>   </p>
    
    <h3> Recording a video for the doctor </h3>

</form>
<a href=" http://localhost:8888/HMS/HMSVideoAudio/index.php"> <button> Record audio & video for the doctor </button> </a>
  </body>
</html>



<?php
//retrieve most recent set of vitals.
$result=sqlQuery("SELECT FORM_VITALS.date, FORM_VITALS.id FROM form_vitals AS FORM_VITALS LEFT JOIN forms AS FORMS ON FORM_VITALS.id = FORMS.form_id WHERE FORM_VITALS.pid=? AND FORMS.deleted != '1' ORDER BY FORM_VITALS.date DESC", array($pid));
    
if (!$result) { //If there are no disclosures recorded
    ?>
  <span class='text'> <?php echo htmlspecialchars(xl("No vitals have been documented."), ENT_NOQUOTES);
?>

<?php
/*
// This part of my code reads a text file into the screen. No one knows why and how, damnit.
echo "<pre>"; // Enables display of line feeds
echo file_get_contents("http://localhost:8888/HMS/UserFacingSide/users/uploads/Katalis_Taukapulos.txt");
echo "</pre>"; // Terminates pre tag */
?>
  </span> 

  
<?php
} else {
?> 
  <span class='text'><b>
    <?php echo htmlspecialchars(xl('Most recent vitals from:')." ".$result['date'], ENT_NOQUOTES); ?>
  </b></span>
  <br />
  <br />
    <?php include_once($GLOBALS['incdir'] . "/forms/vitals/report.php");
    call_user_func("vitals_report", '', '', 2, $result['id']);
    ?>  <span class='text'>
  <br />
  <a href='../encounter/trend_form.php?formname=vitals' onclick='top.restoreSession()'><?php echo htmlspecialchars(xl('Click here to view and graph all vitals.'), ENT_NOQUOTES);?></a>
  </span><?php
} ?>
<br />
<br />
</div>
