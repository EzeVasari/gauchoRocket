
<?php

/* Include the `fusioncharts.php` file that contains functions  to embed the charts. */

   include("../help/fusioncharts-suite-xt/integrations/php/fusioncharts-wrapper/fusioncharts.php");
    include("head.php");

/* The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

   $hostdb = "localhost";  // MySQl host
   $userdb = "root";  // MySQL username
   $passdb = "";  // MySQL password
   $namedb = "gauchoRocket";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if ($dbhandle->connect_error) {
    exit("There was an error with your connection: ".$dbhandle->connect_error);
   }
?>

<html>
  <head>
    <title>FusionCharts XT - Column 2D Chart - Data from a database</title>
    <link  rel="stylesheet" type="text/css" href="../help/fusioncharts-suite-xt/assets/css/style.css"/>
    <!-- You need to include the following JS file to render the chart.
    When you make your own charts, make sure that the path to this JS file is correct.
    Else, you will get JavaScript errors. -->
    <script src=" https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script src=" https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
  </head>
   <body>
    <?php
      // Form the SQL query that returns the top 10 most populous countries
       
      $strQuery = "select rel.fkEmailCliente as clientes, sum(v.precio + ts.precio + tc.precio) as total
from viaje as v
  inner join ubicacion as u on v.codigo = u.fkCodigoViaje
    inner join reserva as r on u.fkCodigoReserva = r.codigo
    inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
    inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
    inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
    inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio 
    inner join relacionClienteItemReserva as rel on rel.fkIdItemReserva = ir.idItemReserva
where ir.pago = true
group by clientes;";

      // Execute the query, or else return the error message.
      $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

      // If the query returns a valid response, prepare the JSON string
      if ($result) {
          // The `$arrData` array holds the chart attributes and data
          $arrData = array(
              "chart" => array(
                  "caption" => "Facturacion Por Cliente",
                  "showValues" => "0",
                  "theme" => "fusion"
                )
            );

          $arrData["data"] = array();

  // Push the data into the array
          while($row = mysqli_fetch_array($result)) {
            array_push($arrData["data"], array(
                "label" => $row["clientes"],
                "value" => $row["total"]
                )
            );
          }

          /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

          $jsonEncodedData = json_encode($arrData);

  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

          $columnChart = new FusionCharts("column2D", "myFirstChart" , 700, 400, "chart-1", "json", $jsonEncodedData);

          // Render the chart
          $columnChart->render();

          // Close the database connection
          $dbhandle->close();
      }
    ?>
    <div id="chart-1"><!-- Fusion Charts will render here--></div>\
    <a class="btn btn-primary" href="adminReporteUno.php">Volver</a>
   </body>
</html>