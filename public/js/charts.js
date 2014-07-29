google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);

function drawChart() {
        var dataColum = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(dataColum, options);
//////
$.getJSON("/restappadmin/public/index.php/admin/cargagraficos", function (data) {
    var donutdata = google.visualization.arrayToDataTable([
          ['Clientes', 'Monto'],
          [data.id.toString(), 10],
          [data.name, 5],
          [data.description, 4]
        ]);

    var donutoptions = {
          title: 'Distribución de ingresos por clientes',
          is3D: true
        };

    var chart3 = new google.visualization.PieChart(document.getElementById('piechart'));
        chart3.draw(donutdata, donutoptions);
});

}