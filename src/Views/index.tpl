<?php require 'header.tpl'; ?>

<div class="container">
	<div class="inner">
		<?php foreach ($items as $v): ?>
			<div>
				<a href="/type/<?php echo $v['alias'] ?>"><?php echo $v['title'] ?></a>
			</div>
		<?php endforeach ?>
	</div>
</div>
<?php require 'footer.tpl'; ?>