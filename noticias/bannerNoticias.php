<?php
session_start();
require_once("../clases/conexion.php");
$db=new conexion();
$sql="SELECT * FROM tbl_noticias WHERE fk_doctores = ".$_SESSION['pk_user']." AND edo=1";
$sql1="SELECT * FROM tbl_noticias WHERE fk_doctores = ".$_SESSION['pk_user']." AND edo=1";
$result= $db->executeQuery($sql);
$result1= $db->executeQuery($sql1);
?>
<link rel="stylesheet" type="text/css" href="wowslider/engine1/style.css" />

<div id="wowslider-container1">
    <div class="ws_images">
    <ul>
    <?php while($row= $db->getRows($result)){ 
  
  $description= strtr($row['descripcion'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
  $title= strtr($row['title'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
  
  ?>
        <li>
            <img src="<?php echo $row['url_image'];?>" 
            alt="<?php echo $description;?>" 
            title="<?php echo $title;?>" 
            id="<?php echo 'wows'.$row['idnoticias'].'_'.($row['idnoticias'])-1;?>"/>
        </li>
       <?php } ?>  
     </ul>
      </div>
      <div class="ws_bullets">
      <div>
      <?php while($row1= $db->getRows($result1)){ ?>
        <a href="#" title="<?php echo $title;?>">
          <span>
          	<img src="<?php echo $row1['url_tooltips'];?>" alt="<?php echo $description;?>"/><?php echo $row1['idnoticias'];?>
          </span>
        </a>
        <?php } ?>
      </div>
  </div>
  <div class="ws_shadow">
    <?php echo 
    '<center style="margin-top:150px;color:#FF0000;"><h3>No se encontraron resultados</h3></center><p/>
    <center><h5>Consulte al administrador</h5></center>
    '
    ?>
  </div>
</div>  

<script type="text/javascript" src="wowslider/engine1/wowslider.js"></script>
<script type="text/javascript" src="wowslider/engine1/script.js"></script>

