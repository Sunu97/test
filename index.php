<!doctype html>
<html>
<?php
session_start();
$ser="localhost";
$usr="root";
$pwd="";
$db="sl";
$con=mysqli_connect($ser,$usr,$pwd) or die("Connection failed");

if (isset($_REQUEST['obj'])) {
    $obj = $_REQUEST['obj'];
	mysqli_select_db( $con ,$db);
	$sql="SELECT * FROM details WHERE org  LIKE '%{$obj}%' ORDER BY org ASC";
	$retval=mysqli_query($con, $sql);
}
else
{
   mysqli_select_db( $con ,$db);
    $sql = 'SELECT * from details ORDER BY org ASC';
   $retval = mysqli_query( $con, $sql);
}
   ?>
<head>

<meta charset="utf-8">
<title>Untitled Document</title>
	<link href="css/bootstrap.css" rel="stylesheet">
</head>
<style>
	body {
 background-image: url("images/bg1.jpg");
  background-repeat: repeat-x;
	}

	</style>
<body>
	
	<div class="container">
	
			
			 <br><br>
				 <font size="6">
					 <center><input type="text" name="search" id="search">
 				 </font>    
		<p>
	 <?php
	
   if(! $retval ) {
      die('Could not get data: ' . mysqli_error());
   }
if($retval->num_rows == 0) {
     echo "<p><font size=4><center>Did not find the organism in the database!</center></font></p>";
}
	
else
{
	
echo "<p>List of organisms</p>";
}
?>
    </div>
	<?php
	if($retval->num_rows == 0)
	{
	}
	else
		
   echo  '<div class="clearfix colelem" id="pu20599"><!-- group -->
     <div class="grpelem" id="u20599"><!-- simple frame --></div>
     <div class="clearfix grpelem" id="u20984-3" data-muse-temp-textContainer-sizePolicy="true" data-muse-temp-textContainer-pinning="true">
<p class="heading"><br>
<table width="95%" align=center style="line-height: 25px">
 
   <th><center><b>NAME OF THE ORGANISM</center></th>
   <th><center><b>SINGLE LETHAL REACTIONS</center></th>
   <th><center><b>DOUBLE LETHAL REACTIONS</center></th>
   <th><center><b>TRIPLE LETHAL REACTIONS</center></th>
   <th><center><b>SINGLE LETHAL GENES</center></th>
   <th><center><b>DOUBLE LETHAL GENES</center></th>
   <th><center><b>TRIPLE LETHAL GENES</center></th>
   
   </p>
   </tr>';
   
   
	   while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
	   {echo "<center>";

 $org = $row['org'];

    $location="syntheticlethals.php?org=".$org;
	?>
	<tr><td><a href="<?php echo $location;?>"><font color="DarkBlue"><?php echo $org;?></font></a>&nbsp;&nbsp;<a href="zip/<?php echo $org;?>.rar" download><img src="images/down1.jpg" height="16" width="16"></a></td>
		  <?php
         echo "<td><center>{$row['slr']}</center></td>";
		 echo "<td><center>{$row['dlr']}</center></td> ";
		 echo "<td><center>{$row['tlr']}</center></td> ";
		 echo "<td><center>{$row['slg']}</center></td> ";
		 echo "<td><center>{$row['dlg']}</center></td> ";
		 echo "<td><center>{$row['tlg']}</center></td></tr> ";
		 
   }
   echo "</table>";
   
   //echo "Fetched data successfully\n";
   
   mysqli_close($con);

      
     echo '</div>';
    echo '</div>';
	?>
	
		
	</div>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script type="text/javascript">
	$('input')
  .data("oldValue",'')
  .bind('input propertychange',function() 
  {

    var $this = $(this);
    var newValue = $this.val();
    var search = document.getElementById('search').value;

    if(this.id =="search")                        
    alert(search);
   /* if(this.id =="search"){
      if (residue >= startres && residue <= endres)
       {  
        $(document.getElementById('residue')).removeClass("redborder");
        $('#u12169').css('pointer-events', 'auto'); $('#u12169').css('opacity', '1.0'); document.getElementById("resname1").style.color = "black"
        $(".residue").change();
		
       }

    else
       {
         //$(document.getElementById('residue')).addClass("redborder"); 
         //$( "#resname1" ).text(" - Invalid Residue Number"); document.getElementById("resname1").style.color = "#C1272D"
         $('#u12169').css('pointer-events', 'none'); $('#u12169').css('opacity', '0.5'); 
         viewer.clear();
         viewer.cartoon('structure', structure, { color: color.bySS(SS_Color) });
         viewer.autoZoom();
         jQuery("#changeto option:selected").removeAttr("selected");
         jQuery("#changeto option[value='1']").attr('selected', 'selected'); 
        }
		
      }
   
    return $this.data('oldValue',newValue);
 });
  
  $( ".residue" )
  .change(function () {
    var $this = $(this);
    var newValue = $this.val();
    var residue =parseInt(document.getElementById('residue').value);
     var strres=document.getElementById('residue').value;
  var startres = <?php echo $startres; ?>;
  var endres = <?php echo $endres; ?>;
  var SS_Color = { C:'lightgrey', H:'lightmagenta', E: 'lightyellow'};
   if (!(residue=='')) {
    if (residue <= endres && residue >= startres) {
      //$( "#resname1" ).text(" - " + resname[residue - startres] + residue + ":" + cID); document.getElementById("resname1").style.color = "black";
 $('#u12169').css('pointer-events', 'auto'); $('#u12169').css('opacity', '1.0');
      viewer.clear();
      viewer.cartoon('structure', structure, { color: color.bySS(SS_Color) });
      var res = structure.select({ chain: cID, rnum : residue, aname : 'CA' });
      viewer.spheres('res', res, { color : color.uniform("red")});
      var res1 = structure.select({ chain: cID, rnum : residue, anames : ['CA', 'CB', 'CG1', 'CG2', 'CG', 'CD1', 'CD2', 'CG1', 'CG2', 'CG', 'CE', 'SD', 'CE1', 'CE2', 'CZ', 'OH','NE1','NE2','CE3','CZ2','CZ3','CH2','OG','OD1','OD2','ND1','ND2','OG1','OE1','OE2','NE2','NZ','NE','NH1','NH2','SG','CD' ] });
      viewer.ballsAndSticks('res1', res1, { color : color.uniform("red")});
         jQuery("#changeto option:selected").removeAttr("selected");
         jQuery("#changeto option[value='1']").attr('selected', 'selected'); 
       
if(strres.includes(","))
{
  var i;
  var indxs = strres.split(",");
      viewer.cartoon('structure', structure, { color: color.bySS(SS_Color) });
  for (i=0; i<indxs.length; i++)
     {
          if (indxs[i] <= endres && indxs[i] >= startres)
          {
      var res = structure.select({ chain: cID, rnum : parseInt(indxs[i]), aname : 'CA' });
      viewer.spheres('res', res, { color : color.uniform("red")});
      var res1 = structure.select({ chain: cID, rnum : parseInt(indxs[i]), anames : ['CA', 'CB', 'CG1', 'CG2', 'CG', 'CD1', 'CD2', 'CG1', 'CG2', 'CG', 'CE', 'SD', 'CE1', 'CE2', 'CZ', 'OH','NE1','NE2','CE3','CZ2','CZ3','CH2','OG','OD1','OD2','ND1','ND2','OG1','OE1','OE2','NE2','NZ','NE','NH1','NH2','SG','CD' ] });
      viewer.ballsAndSticks('res1', res1, { color : color.uniform("red")});
          }
        }
}
 }
    else {
      //$( "#resname1" ).text(" - Invalid Residue Number"); document.getElementById("resname1").style.color = "#C1272D";
      $('#u12169').css('pointer-events', 'none'); $('#u12169').css('opacity', '0.5');
      viewer.clear();
      viewer.cartoon('structure', structure, { color: color.bySS(SS_Color) });
      var res = structure.select({ chain: cID, rnum : residue, aname : 'CA' });
      viewer.spheres('res', res, { color : color.uniform("red")});
      var res1 = structure.select({ chain: cID, rnum : residue, anames : ['CA', 'CB', 'CG1', 'CG2', 'CG', 'CD1', 'CD2', 'CG1', 'CG2', 'CG', 'CE', 'SD', 'CE1', 'CE2', 'CZ', 'OH','NE1','NE2','CE3','CZ2','CZ3','CH2','OG','OD1','OD2','ND1','ND2','OG1','OE1','OE2','NE2','NZ','NE','NH1','NH2','SG','CD' ] });
      viewer.ballsAndSticks('res1', res1, { color : color.uniform("red")});
         jQuery("#changeto option:selected").removeAttr("selected");
         jQuery("#changeto option[value='1']").attr('selected', 'selected'); 
         }    
      }

 
    else {
     // $( "#resname1" ).text(" - Invalid Residue Number"); document.getElementById("resname1").style.color = "#C1272D";
 $('#u12169').css('pointer-events', 'none'); $('#u12169').css('opacity', '0.5');
      viewer.clear();
      viewer.cartoon('structure', structure, { color: color.bySS(SS_Color) });
      var res = structure.select({ chain: cID, rnum : residue, aname : 'CA' });
      viewer.spheres('res', res, { color : color.uniform("red")});
      var res1 = structure.select({ chain: cID, rnum : residue, anames : ['CA', 'CB', 'CG1', 'CG2', 'CG', 'CD1', 'CD2', 'CG1', 'CG2', 'CG', 'CE', 'SD', 'CE1', 'CE2', 'CZ', 'OH','NE1','NE2','CE3','CZ2','CZ3','CH2','OG','OD1','OD2','ND1','ND2','OG1','OE1','OE2','NE2','NZ','NE','NH1','NH2','SG','CD' ] });
      viewer.ballsAndSticks('res1', res1, { color : color.uniform("red")});
         jQuery("#changeto option:selected").removeAttr("selected");
         jQuery("#changeto option[value='1']").attr('selected', 'selected'); 
      }*/
      return $this.data('oldValue',newValue);
  }).change();
  
	
	
	</script>
	</body>
</html>
