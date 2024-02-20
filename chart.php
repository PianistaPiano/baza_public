<?php
session_start();
require_once 'leap_year.php';

if(isset($_POST['years']))
{
  //$year = 2021;
  $_SESSION['onshow'] = 1;
  $year = $_POST['years'];
  require_once "connect.php";
  $polaczenie =  @new mysqli($host,$db_user,$db_password,$db_name);
  
  $all = array();   //    31      29/28     31          30      31          30      31        31          30          31              30          31
  $months_all = array("Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec","Lipiec", "Sierpień","Wrzesień", "Październik", "Listopad", "Grudzień");
  $months = array();
  for ($i=1; $i<=12;$i++)
  { 
    //2021-05-30
      $data = $year."-".$i."-01";
      //$sql = "SELECT COUNT(ID_Koncentratora) as ilosc FROM `wypozyczenie_zak` WHERE Data_od <= date('$data') AND Data_do > date('$data')";
      $sql = "SELECT COUNT(ID_Koncentratora) as ilosc FROM `wypozyczenie_zak` WHERE DATE_FORMAT(Data_od, '%Y-%m') < DATE_FORMAT(date('$data'),'%Y-%m') AND DATE_FORMAT(Data_do, '%Y-%m') > DATE_FORMAT(date('$data'),'%Y-%m')";
      $result = $polaczenie->query($sql);
      $wiersz = $result->fetch_assoc();

      $sql_data = "SELECT Pesel,Data_od, Data_do FROM wypozyczenie_zak WHERE DATE_FORMAT(Data_do, '%Y-%m') = DATE_FORMAT(date('$data'),'%Y-%m')";
      $result_data = $polaczenie->query($sql_data);
      while ($wierszData = $result_data->fetch_assoc())
      {
          $timestamp = strtotime($wierszData['Data_od']);
          $day = date('d', $timestamp);
          $month = date('m',$timestamp);
          if ($i<10)
          {
            if($day ==1)
            {
                if($i==2)
                {
                  if(year_check($year))
                  {
                    $day = 29;
                  }
                  else
                  {
                    $day = 28;
                  }
                }
                else if( ($i != 7) && ($i != 8))
                {
                   if($i % 2 != 0)
                   {
                     $day = 31;
                   }
                   else
                   {
                     $day = 30;
                   }
                }
                else if( ($i == 7) || ($i == 8) )
                {
                   $day = 31;
                }
                $endDate = $year."-0".$i."-".$day;
            }
            else if($day == 31 || $day ==30)
            {
              if($i==2)
              {
                if(year_check($year))
                {
                  $day = 29;
                }
                else
                {
                  $day = 28;
                }
              }
              else
              {
                 $day = $day - 1;
              }
              $endDate = $year."-0".$i."-".$day;
            }
            else
            {
              $day = $day -1;
              $endDate = $year."-0".$i."-".$day;
            }
           // $endDate = $year."-0".$i."-".$day;
          }
          else
          {
              if($day ==1)
              {
                  if($i==2)
                  {
                    if(year_check($year))
                    {
                      $day = 29;
                    }
                    else
                    {
                      $day = 28;
                    }
                  }
                  else if( ($i != 7) && ($i != 8))
                  {
                    if($i % 2 != 0)
                    {
                      $day = 31;
                    }
                    else
                    {
                      $day = 30;
                    }
                  }
                  else if( ($i == 7) || ($i == 8) )
                  {
                    $day = 31;
                  }
                  $endDate = $year."-".$i."-".$day;
              }
              else if($day == 31 || $day ==30)
              {
                if($i==2)
                {
                  if(year_check($year))
                  {
                    $day = 29;
                  }
                  else
                  {
                    $day = 28;
                  }
                }
                else
                {
                  $day = $day - 1;
                }
                $endDate = $year."-".$i."-".$day;
              }
              else
              {
                $day = $day -1;
                $endDate = $year."-".$i."-".$day;
              }
            //$endDate = $year."-".$i."-".$day;
          }
          
           //echo "</br>";
           //echo $endDate;
          if( ($wierszData['Data_do'] > $endDate) && (date('m',strtotime($wierszData['Data_od'])) < date('m',strtotime($endDate))) )
          {
            $wiersz['ilosc'] =  $wiersz['ilosc'] + 1;
            //echo "jestem";
          }
      }
  
      $sql3 = "SELECT COUNT(ID_Koncentratora) as ilosc FROM `wypozyczenie_zak` WHERE DATE_FORMAT(Data_od, '%Y-%m') = DATE_FORMAT(date('$data'),'%Y-%m')";
      $result3 = $polaczenie->query($sql3);
      $wiersz3 = $result3->fetch_assoc();
  
      $sql2 = "SELECT COUNT(ID_Koncentratora) as ilosc FROM `wypozyczenie_akt` WHERE DATE_FORMAT(Data_od, '%Y-%m') <= DATE_FORMAT(date('$data'),'%Y-%m')";
      $result2 = $polaczenie->query($sql2);
      $wiersz2 = $result2->fetch_assoc();
      array_push($months, $months_all[$i-1]);
      array_push($all,$wiersz['ilosc'] + $wiersz2['ilosc'] + $wiersz3['ilosc']);
  }
  //print_r($all);
  //array_merge();
  $chart_data = array_combine($months,$all);
  $polaczenie->close();
  //print_r($chart_data);
}


?>
<?php if(isset($_SESSION['onshow'])) :?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Miesiąc', 'Ilość wypożyczeń'],
          <?php
                foreach($chart_data as $data => $val)
                {
                    echo "['".$data."', ".$val."],";
                }
           ?>
        ]);

        var options = {
          title: 'Company Performance <?php echo $year ?>',
          hAxis: {title: 'Miesiąc',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0,
                viewWindow: {
                  min: 0,
                  max: <?php echo max($chart_data) ?>
                }
              
              }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 1200px; height: 700px; margin: auto;"></div>
    <div id="back" style="text-align: center;">
		    <a href='index.php'>Powrót do strony głównej</a>
    </div>
    </br>
    <div id="back" style="text-align: center;">
		    <a href='chart.php'>Powrót do wybory roku</a>
    </div>
  </body>
</html>
<?php  unset($_SESSION['onshow']); ?>
<?php else: ?>
<html>
  <head>
  <link rel="stylesheet" href="style/style do bazy.css" type="text/css"/>
  </head>
    <body>
      <div style="text-align: center;">
          <form action="chart.php" id="yearform" method="post" >
          </br>
            </br>
            <label for="years">Wybierz rok:</label>
            </br>
            </br>
            <select name="years" id="years" form="yearform" class="przycisk">
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
            </select>
            </br>
            </br>
            <input class="przycisk" type="submit"> 
          </form>
      </div>
      <div id="back" style="text-align: center;">
		    <a href='index.php'>Powrót do strony głównej</a>
    </div>
    </body>
</html>


<?php endif ;?>
