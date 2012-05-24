<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Student database</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.8.20/themes/base/jquery-ui.css" type="text/css" media="all" />
    
  </head>
  <body>
    <?php
    echo $body;
    ?>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
     <script type="text/javascript">
     $(function() {
     		$(".datepicker").datepicker({dateFormat: "yy-mm-dd"});
     		$("a[data-type=destroy]").click(function(e){
     		  return confirm("Are you sure?");
     		})
     });
      </script>
  </body>
</html>