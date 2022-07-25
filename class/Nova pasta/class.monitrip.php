<?php
$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
class monitrip {
  function visualize_base($prefixo,$id) {  
   //Visualizar pendencias de viagens
    if($id=1){
    $query = mysqlii_query( "SELECT * FROM `indicador_viagens` WHERE prefixo='$prefixo' order by prefixo asc" );
    if ( mysqlii_num_rows( $query ) ) {
       }else{
        echo "<h4><tr><td style=background-color:white align=center> $prefixo </FONT></td></tr><h4>";
       }
}
  //Visualizar pendencias de passagens
if($id=2){
  $query = mysqlii_query( "SELECT * FROM `indicador_passagens` WHERE prefixo='$prefixo' order by prefixo asc" );
  if ( mysqlii_num_rows( $query ) ) {
   
     }else{
      echo "<h4><tr><td style=background-color:white align=center>$prefixo </FONT></td></tr><h4>";
     }
}
 
}
    
}
?>