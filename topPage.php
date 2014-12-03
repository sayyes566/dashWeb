<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Droppable - Shopping Cart Demo</title>
  <link rel="stylesheet" href="css/jqueryUI/smoothness/jquery-ui.css">
  <script src="js/jquery-mini.js"></script>
  <script src="js/jquery-ui.js"></script>
 
  <style>
  h1 { padding: .2em; margin: 0; }
  #products { float:left; width: 500px; margin-right: 2em; }
  #cart { width: 700px; heigh: 300px; float: left; margin-top: 1em; }
  /* style the list to maximize the droppable hitarea */
  #cart ol { margin: 0; padding: 1em 0 1em 3em; }
  </style>
  <script>

$(document).ready(function () {
      
      function displayVals() 
      {
      var singleValues = $("#cart ol").children().html();
       var string = $('#cart').val();

      var request =  $.get('bar.php', { account: singleValues }, function (data) {  
        // alert(data);
         //   $('#feedback').text(data);
          $("p").html("<b>Single:</b> " + data);
        });
        request.done(function( msg ) {
          alert( "Data Saved: " + msg );
          $("#loadPage").load("bar.php");
    });
      /*
      $.ajax({
            url: "script.php",
            type: "POST",
            data: {account: singleValues},
            async: false,
         
         });
*/
     
    
     }
    $( "#catalog" ).accordion();
    $( "#catalog li" ).draggable({
      appendTo: "body",
      helper: "clone"
    });
    $( "#cart ol" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
        $( this ).find( ".placeholder" ).remove();
        $( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
        displayVals() ;
      }
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        // gets added unintentionally by droppable interacting with sortable
        // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
        $( this ).removeClass( "ui-state-default" );
      }
    });
  });
  </script>
</head>
<body>
    <p></p>
    <div id="loadPage"></div>
<div id="products">
  <h1 class="ui-widget-header">Products</h1>
  <div id="catalog">
    <h2><a href="#">T-Shirts</a></h2>
    <div>
      <ul>
        <li>Lolcat Shirt</li>
        <li>select  Factory, Yield,Date from FactoryDaily where Section='FATP' and Factory between 'F3' and 'F5' and Date ='20140930'</li>
        <li>Buckit Shirt</li>
      </ul>
    </div>
    <h2><a href="#">Bags</a></h2>
    <div>
      <ul>
        <li>Zebra Striped</li>
        <li>Black Leather</li>
        <li>Alligator Leather</li>
      </ul>
    </div>
    <h2><a href="#">Gadgets</a></h2>
    <div>
      <ul>
        <li>iPhone</li>
        <li>iPod</li>
        <li>iPad</li>
      </ul>
    </div>
  </div>
</div>
 
<div id="cart">
  <h1 class="ui-widget-header">Shopping Cart</h1>
  <div class="ui-widget-content">
    <ol>
      <li class="placeholder">Add your items here</li>
    </ol>
  </div>
</div>
 
 
</body>
</html>