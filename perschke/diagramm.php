<link rel="stylesheet" type="text/css" href="styleNoFooter.css">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script>function test(){jQuery('main').load('diagramm.php');}</script>
<input type="button" id="diagrammbtn" onclick="test()" value="Klicken Sie hier um Ihre Auswertung zu laden!">
<div id="container1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 20px;"></div>
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 20px ;"></div>

<?php 
$db = new mysqli('localhost','root','','perschkeprojekt');
  SESSION_START();
  
  $creator = $_SESSION['name'];
$datum = date("Y-m-d ");

 $search_erledigt = $db->prepare("SELECT status FROM task WHERE status = 'erledigt' AND creator = ?" );
  $search_erledigt->bind_param('s',$creator);
  $search_erledigt->execute();
  $search_resulterledigt = $search_erledigt->get_result();

$search_verspäteterledigt = $db->prepare("SELECT status FROM task WHERE status = 'verspaeteterledigt' AND creator = ?" );
  $search_verspäteterledigt->bind_param('s',$creator);
  $search_verspäteterledigt->execute();
  $search_resultverspäteterledigt = $search_verspäteterledigt->get_result();

$search_überfällig = $db->prepare("SELECT status FROM task WHERE (status = 'offen' OR status='inBearbeitung') AND creator = ? AND enddate < ? AND enddate != ''");
  $search_überfällig->bind_param('ss',$creator,$datum);
  $search_überfällig->execute();
  $search_resultüberfällig = $search_überfällig->get_result();
  
  $gesamtüberfällig = $search_resultüberfällig->num_rows + $search_resultverspäteterledigt->num_rows;


  ?>


<script>
var überfällig = <?php echo json_encode($gesamtüberfällig); ?>;
var erledigt = <?php echo json_encode($search_resulterledigt->num_rows); ?>;

Highcharts.chart('container1', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: 0,
    plotShadow: false
  },
  title: {
    text: 'Erledigt<br> vs.<br> Überfällig',
    align: 'center',
    verticalAlign: 'middle',
    y: 40
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      dataLabels: {
        enabled: false,
        distance: -50,
        style: {
          fontWeight: 'bold',
          color: 'white'
        }
      },
      startAngle: -90,
      endAngle: 90,
      center: ['50%', '75%'],
      size: '110%'
    }
  },
  series: [{
    type: 'pie',
    name: 'Browser share',
    innerSize: '50%',
    data: [
      ['erledigt ' + erledigt, erledigt],
      ['überfällig ' + überfällig, überfällig],
      
      {
       
        dataLabels: {
          enabled: false
        }
      }
    ]
  }]
});
</script>
 <?php 

 
  $search_offen = $db->prepare("SELECT status FROM task WHERE status = 'offen' AND creator = ?" );
  $search_offen->bind_param('s',$creator);
  $search_offen->execute();
  $search_resultoffen = $search_offen->get_result();
  
  $search_inBearbeitung= $db->prepare("SELECT status FROM task WHERE status = 'inBearbeitung' AND creator = ?" );
  $search_inBearbeitung->bind_param('s',$creator);
  $search_inBearbeitung->execute();
  $search_resultinBearbeitung = $search_inBearbeitung->get_result();
  
  $search_erledigt = $db->prepare("SELECT status FROM task WHERE status = 'erledigt' AND creator = ?" );
  $search_erledigt->bind_param('s',$creator);
  $search_erledigt->execute();
  $search_resulterledigt = $search_erledigt->get_result();
  
  $search_verspäteterledigt = $db->prepare("SELECT status FROM task WHERE status = 'verspaeteterledigt' AND creator = ?" );
  $search_verspäteterledigt->bind_param('s',$creator);
  $search_verspäteterledigt->execute();
  $search_resultverspäteterledigt = $search_verspäteterledigt->get_result();
  
  $search_abgebrochen = $db->prepare("SELECT status FROM task WHERE status = 'abgebrochen' AND creator = ? " );
  $search_abgebrochen->bind_param('s',$creator);
  $search_abgebrochen->execute();
  $search_resultabgebrochen = $search_abgebrochen->get_result();
  
 ?>
<script type="text/javascript">
var offen = <?php echo json_encode($search_resultoffen->num_rows); ?>;
var inBearbeitung = <?php echo json_encode($search_resultinBearbeitung->num_rows); ?>;
var erledigt = <?php echo json_encode($search_resulterledigt->num_rows); ?>;
var verspaeteterledigt = <?php echo json_encode($search_resultverspäteterledigt->num_rows); ?>;
var abgebrochen = <?php echo json_encode($search_resultabgebrochen->num_rows); ?>;
Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Status aller Aufgaben'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: false
      },
      showInLegend: true
    }
  },
  series: [{
    name: 'Status',
    colorByPoint: true,
    data: [{
      name: 'offen: '+ offen ,
      y: offen,
    
    },  {
      name: 'in Bearbeitung: '+ inBearbeitung,
      y: inBearbeitung
    }, {
      name: 'erledigt: '+ erledigt,
      y: erledigt
    }, {
      name: 'verspätet erledigt: '+ verspaeteterledigt,
      y: verspaeteterledigt
    }, {
      name: 'abgebrochen: '+ abgebrochen,
      y: abgebrochen
    }]
  }]
});
</script>