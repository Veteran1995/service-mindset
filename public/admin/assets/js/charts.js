    //Sucess Messages SweetJS
    document.addEventListener('updateChart', event => {

        console.log(event.detail.chartData);

        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(event.detail.chartData);

            var options = {
                title: 'Prepaid vs Postpaid Meters',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }

    });

       //Sucess Messages SweetJS
       document.addEventListener('chatUpdate', event => {

        console.log(event.detail.chartData);

        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(event.detail.chartData);

            var options = {
                title: 'Prepaid vs Postpaid Meters',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }

    });