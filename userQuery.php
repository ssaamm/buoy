<html>
    <head>
        <title>Query</title>
        <script>
            function makeQuery(e) {
                var lat = $("#latlon option:selected").val().split(",")[0];
                var lon = $("#latlon option:selected").val().split(",")[1];
                var params = {
                    "startTime": $("#startTime").val(),
                    "endTime": $("#endTime").val(),
                    "deviceId": $("#device").val(),
                    "latitude": lat,
                    "longitude": lon,
                };

                $.get("query.php", params, function(r) {
                    $results = $("#results");
                    $results.empty();
                    r = $.parseJSON(r);
                    $.each(r["readings"], function(ndx, result) {
                        var p = $("<p>", { class: "result" }).text(JSON.stringify(result));
                        $results.append(p);
                    });
                    if (r["readings"].length == 0) {
                        $results.append($("<p>", { class: "result" }).text("No results"));
                    }
                });
            }
        </script>
    </head>
    <body>
        <h1>Find readings</h1>
        <form id="criteria">

            <h3>Search by time range</h3>
            <p><label for="startTime">Start time</label><br>
            <input type="text" id="startTime" name="startTime"></p>

            <p><label for="endTime">End time</label><br>
            <input type="text" id="endTime" name="endTime"></p>

            <h3>Search by device</h3>
            <p><label for="device">Device ID</label><br>
            <input type="text" id="device" name="device"></p>

            <h3>Search by buoy</h3>
            <select id="latlon">
<option value=",">Don't care</option>
<?php
$buoys = json_decode(file_get_contents('http://localhost/buoy/listBuoy.php?fmt=json'));
$buoys = $buoys->buoys;
foreach ($buoys as $buoy) {
    echo '<option value="' . $buoy->latitude . ',' . $buoy->longitude . '">' . $buoy->name . '</option>';
}
?>
            </select>

        </form>
        <button onclick="makeQuery(event);">Submit query</button>

        <div id="results"></div>

    </body>
        <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
        <script src="js/jquery-2.1.3.min.js"></script>
        <script src="js/jquery.datetimepicker.js"></script>
        <script>
            $("#startTime").datetimepicker();
            $("#endTime").datetimepicker();
        </script>

</html>
