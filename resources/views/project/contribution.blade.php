@if (!empty($alltaskF))
@section('piechart')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var tasks = <?php echo json_encode($alltaskF); ?>;
        var members = <?php echo json_encode($allmemberF); ?>;
        var name = <?php echo json_encode($pname); ?>;

        var data = google.visualization.arrayToDataTable([
            ['Member', 'Contribution'],
            [members[0], tasks[0]],
            [members[1], tasks[1]],
            [members[2], tasks[2]],
            [members[3], tasks[3]],
        ]);

        var options = {
            title: name
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
@endsection
@endif

<div class="row content-list-head">
    <div class="col-auto">
        <h3>Project Contribution</h3>

    </div>
</div>

<div id="piechart" style="width: 900px; height: 500px;"></div>