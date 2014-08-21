<ul>

<?php
  wp_list_categories('title_li=' . __('<h3>Categorias:</h3>'));
?>
<li id="search" class="busca">
	<h3 for="s"><?php _e('Busca:'); ?></h3>
	<form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
	<div>
	    <input type="text" name="s" id="s" size="15" placeholder="Digite aqui sua busca" /><br />
	    <button type="submit" class="bt-default">Buscar</button>
	</div>
	</form>
</li>



</ul>