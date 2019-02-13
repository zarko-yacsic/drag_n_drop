<?php
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Ejemplo Drag & Drop II</title>
<meta name="description" content="Ejemplo Drag & Drop II">
<meta name="author" content="SitePoint">
<link rel="stylesheet" href="lib/bootstrap-4.3.0-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php

// Listado de preguntas...
$sql = "SELECT id, pregunta, if(categoria IS NULL, 0, categoria) AS id_categoria, orden FROM test_preguntas 
	WHERE categoria IS NULL ORDER BY pregunta ASC;";
$p = 0; $preguntas = '';
if($result = $conDB->query($sql)){
	if (mysqli_num_rows($result) > 0){
		while ($row = $result->fetch_assoc()){
		$preguntas .= '<div draggable="true" ondragstart="drag(event)" class="draggable_item" id="drag_PRG_' . strval($p + 1) . '" data-id_pregunta="' . $row['id'] . '" data-orden="0">
					<div class="draggable_inner" id="draggable_inner_' . strval($p + 1) . '">' . $row['pregunta'] . '</div>
				</div>';
		$p++;
		}
	}
}

// Listado de categorias...
$sql = "SELECT id AS id_categoria, categoria, orden FROM test_categorias ORDER BY orden ASC;";
$categorias = '';
if($result = $conDB->query($sql)){
	if (mysqli_num_rows($result) > 0){
		$categorias .= '<ul id="ul_categorias">';
		while ($row = $result->fetch_assoc()){
			$categorias .= '<li><label for="rd_categoria_' . $row['id_categoria'] . '">
					<input type="radio" value="' . $row['id_categoria'] . '" name="rd_categoria" id="rd_categoria_' . $row['id_categoria'] . '">
					<span>' . $row['categoria'] . '</span>
				</label>
			</li>';
		}
		$categorias .= '</ul>';
	}
}
?>
	<div class="drag_container">
		<h2>Drag & Drop II</h2>
		<p>En este demo probaremos cómo relacionar preguntas a categorías usando 'arrastrar y soltar'</p>
		<div class="drag_subtitulos">
			<h3>Preguntas</h3>
			<h3>&nbsp;</h3>
			<h3>Categorías</h3>
		</div>
		<div class="drag_column" ondrop="drop(event, this)" ondragover="allowDrop(event)" id="preguntasListado">
			<?php
			echo $preguntas;
			?>
		</div>
		<div class="drag_column" ondrop="drop(event, this)" ondragover="allowDrop(event)" id="preguntasCategorias"></div>
		<div class="drag_column">
			<?php
			echo $categorias;
			?>
		</div>
	</div>
	<div class="drag_buttons">
		<button type="button" class="btn btn-primary">Guardar Cambios</button>
	</div>

<?php
$result->close();
?>
<script type="text/javascript" src="lib/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="lib/bootstrap-4.3.0-dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
$('.drag_buttons button').click(function(){
	if($('#ul_categorias input[type="radio"]').is(':checked')){
		var categoria = $('#ul_categorias input[type="radio"]:checked').val();
		var preguntas = '';
		var orden = '';
		$('#preguntasCategorias').find('div.draggable_item').each(function(){
			preguntas += $(this).data('id_pregunta') + '|';
			orden += $(this).data('orden') + '|';
	    });
	    if(preguntas != '' && orden != ''){
	    	$.ajax({
				url: 'includes/process.php?r=' + randomNumber(1000, 9999),
				type: 'POST',
				data: {
					accion : 'preguntas_categorias',
					categoria : categoria,
					preguntas : preguntas,
					orden : orden
				},
				success: function(data){
					var json = eval('(' + data + ')');
					if(json.status == 'SUCCESS'){
						$('.drag_subtitulos h3:nth-of-type(2)').html('&nbsp;');
						$('#preguntasCategorias').html('');
						$('#ul_categorias input[type="radio"]').prop('checked', false);
						alert(json.mensaje);
					}
					if(json.status == 'ERROR'){
						console.log(json.mensaje);
					}
				}
			});
	    }
	    if(preguntas == '' || orden == ''){
	    	alert('No se ha seleccionado ninguna pregunta para la categoría.');
	    	return;
	    }
	}
	else{
		alert('No se ha seleccionado una categoría.');
		return;
	}
});


$('#ul_categorias input[type="radio"]').click(function(){
	if($(this).is(':checked')){
		var rb = $(this).attr('id');
		var categoria = $('label[for="' + rb + '"] span').html();
		$('.drag_subtitulos h3:nth-of-type(2)').html(categoria);
	}
});


function allowDrop(ev){
	ev.preventDefault();
}


function drag(ev){
	ev.dataTransfer.setData('text/plain', ev.target.id);
}


function drop(ev, el){
  	ev.preventDefault();
  	var data = ev.dataTransfer.getData('text');
  	var target_id = ev.target.id;
  	var match_p = target_id.indexOf('drag_PRG_');
	var match_c = target_id.indexOf('drag_PCAT_');
	var match_i = target_id.indexOf('draggable_inner_');
	if(target_id != ''){
		if(target_id == 'preguntasListado' || target_id == 'preguntasCategorias'){
			$('#' + target_id).append(document.getElementById(data));
		}
		else if(match_i != -1){
			$('#' + target_id).parent().after(document.getElementById(data));
		}
		else{
			$('#' + target_id).after(document.getElementById(data));
		}
		if(target_id == 'preguntasListado' || match_p != -1){
			$('#preguntasListado').find('.draggable_item').each(function(){
				renameItem(this, 'drag_PCAT_', 'drag_PRG_');
			});
		}
		if(target_id == 'preguntasCategorias' || match_c != -1){
			$('#preguntasCategorias').find('.draggable_item').each(function(){
				renameItem(this, 'drag_PRG_', 'drag_PCAT_');
			});
		}
	}
}


function renameItem(myObj, str_search, str_replace){
	var id = $(myObj).attr('id');
	var id_new = id.replace(str_search, str_replace);
	$(myObj).attr('id', id_new);
}


function randomNumber(from, to){
	return Math.floor((Math.random() * to) + from);
}
</script>
</body>
</html>