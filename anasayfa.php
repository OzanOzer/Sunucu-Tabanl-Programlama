<?php
$baglan=mysqli_connect("localhost","root","","kds");
mysqli_query($baglan,"SET NAMES UTF8");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Genel İzleyici Oranı</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
            google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Gruplar', 'İzlenme Oranı'],
            <?php 
                $query = "SELECT gruplar.grup_adi,round((sum(sovlar.izleyici_sayisi) / sum(sovlar.musteri_sayisi)),2) as izlenme_orani
                FROM sovlar,gruplar
                WHERE sovlar.grup_id=gruplar.grup_id
                GROUP BY gruplar.grup_id
                ORDER BY izlenme_orani";
                $exec = mysqli_query($baglan,$query);
                while($row = mysqli_fetch_array($exec)){
                echo "['".$row['grup_adi']."','".$row['izlenme_orani']."'],";
                }
            ?>
        ]);
        var options = {
          chart: {
            title: 'Genel izlenme Oranı',
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          height: 350,
          colors: ['#1b9e77', '#d95f02', '#7570b3']
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

        var btns = document.getElementById('btn-group');

        
      }
        </script>
       
    </head>

    <body>
        <div class="baslik">
            <header id="header"><h1 id="isim">DANS GRUPLARI KARAR DESTEK SİSTEMİ</h1></header>
        </div>
        <div class="menu">
            <ul>
                <li><a href="anasayfa.php" id="genel">GENEL İZLENME ORANI</a></li>
                <li><a href="gruplar.php" id="swiss">SWİSS</a></li>
                <li><a href="haftalar.php" id="anemon">ANEMON</a></li>
                <li><a href="izlenmeOrani.php" id="hilton">HİLTON</a></li>
                <li><a href="ilkHafta.php" id="izmir">İZMİR</a></li>
                <li><a href="ikinciHafta.php" id="kardesler">KARDEŞLER</a></li>
            </ul> 
            <div id="chart_div" style="width:600px;  margin-left: 300px;margin-top: -350px;"></div>
        </div>
    </body>
</html>