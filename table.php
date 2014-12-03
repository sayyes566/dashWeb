
<!DOCTYPE html>
<html>
<head>
    
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

	<title>DataTables example - Scroll - horizontal and vertical</title>
	<link rel="stylesheet" type="text/css" href="js/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="js/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="js/resources/demo.css">
	<style type="text/css" class="init">

	</style>
	<!---<script type="text/javascript" language="javascript" src="js/media/js/jquery.js"></script>------>
	<script type="text/javascript" language="javascript" src="js/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="js/resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="js/resources/demo.js"></script>
        
        
	
</head>

<body class="dt-example">
    <!--  <div id="reload_table">refresh</div>-->
	<div id="container" style="min-width: 210px; max-width: 500px; height: 400px; margin: 0 auto">     

		<section>
                    <center><h4>Yield by 20140930</h4></center>
			<div class="info" style="display:none">
				<p>In this example you can see DataTables doing both horizontal and vertical scrolling at the same
				time. Note also that pagination is enabled in this example, and the scrolling accounts for this.</p>
                                         <?php 
                                       
                                  require_once('data/dataTable.php');
               // $dt = new dataTable(); 
               // $dt->getJsonData();
             //   print_r($dt->columns);
                ?>
			</div>

	<table id="container_table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
       
                <th>Data</th>
                <th>Factory</th>
                <th>Yield</th>
             
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th>Data</th>
                <th>Factory</th>
                <th>Yield</th>
               
            </tr>
        </tfoot>
    </table>
                        	</section>
</div >
	
<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
    $('#container_table').dataTable( {
         "processing": true,
        "serverSide": true,
        "ajax": "data/dataTable.php"
   
    } );
  
} );
/*
$(document).ready(function() {
	$('#example').dataTable( {
		"scrollY": 200,
		"scrollX": true
	} );
} );
*/
	</script>			
</body>
</html>