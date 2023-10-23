<?php
$_SESSION['pregunta'] = 0;

require_once("clases/clase.generaLista.php");
$generador = new generaLista;
$tematicas = $generador->listaTematicas();
?>

<script>
	
// SELECCION DE VARIAS TEMÁTICAS ------ crea un elemento de formulario llamado temática, que es una cadena con las ids de las temáticas seleccionadas separadas por comas
function lista_tematicas()
    {
    var t="";var s=",";
    var frm ="form_tematicas"; var nombre = "tematica";
    for(var i=0;i<document[frm].elements[nombre].length;i++)
        {
        if(document[frm].elements[nombre][i].checked == true)
            {
            t+=document[frm].elements[nombre][i].value+s;
            }
        }
    t=t.substr(0,t.length-1);
    document[frm].elements['tematicas'].value = t;
    // alert (document[frm].elements['tematicas'].value);
    // window.location = 'index.php?contenido=test.test&tematica='+t+'&preguntas=10&pregunta=1';  -- no funciona
    }
    
function toggle(source) {
  checkboxes = document.getElementsByName('tematica');
  for(var i in checkboxes)
    checkboxes[i].checked = source.checked;
}
</script>

<form action="test.varias_tematicas.php" method="post" name="form_tematicas" id="form_tematicas" onSubmit="lista_tematicas();return;">

<input type="hidden" name="tematicas" id="tematicas" value="-">

<table align="center" class="lista">
<tr class="cabecera">
	<td width='300' >Tematica:</td>
	<td  align='center'>Num de preguntas</td>
	<!-- <td  align='right'>seleccionar todas/no<input type="checkbox" onClick="toggle(this)" /></td> -->
	<?php if ($_SESSION['usuario_nivel'] == 1) { // si es administrador ?><td align='right' > </td><?php } ?>
</tr>

<?php	for ($i=0; $i<=count($tematicas)-1; $i++) {
	$tematica->id = $tematicas[$i][0];
	$tematica->tematica = $tematicas[$i][1];
    $tematica->activa = $tematicas[$i][2];
	$tematica->npreguntas = $tematicas[$i][3];

    $npreguntas = $_SESSION['npreguntas'];
    if ($tematica->npreguntas < $npreguntas) {
        $npreguntas = $tematica->npreguntas;
    }

    $texto = "temática activa";
    if ($tematica->activa == 0) { $texto = "temática no activa"; } else { $texto = "temática activa"; } 

    if ($_SESSION['usuario_nivel'] == 1) { // si es administrador  ?>

        <tr>
            <td>Tematica: <?php echo $tematica->tematica." - ".$tematica->npreguntas; ?></td>
            <td><?php echo $texto; ?></td>
            <td  align='center'><a href="index.php?contenido=test.test&tematicas=<?php  echo $tematica->id  ?>&npreguntas=<?php echo $npreguntas; ?>&npregunta=1&texto_tematicas=<?php   echo $tematica->tematica  ?>">Test de <?php echo $npreguntas; ?> preguntas</a>
            </td>
        </tr>

    <?php } else { // si no es administrador 
        if (($tematica->activa == 1) && ($tematica->npreguntas > 0)) {?>
            <tr>
                <td ><?php    echo $tematica->tematica ?>: </td>
                <td  align='center'><a href="index.php?contenido=test.test&tematicas=<?php  echo $tematica->id  ?>&npreguntas=50&npregunta=1&texto_tematicas=<?php   echo $tematica->tematica  ?>">Test de 50 preguntas</a>
                </td>
            </tr>
<?php } } } ?>

</table>

</form>
