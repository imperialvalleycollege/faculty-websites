<?php
	$letters = range('A', 'Z');
?>
<div id="letter-grouping-alpha-header">
<div>
<?php foreach($letters as $letter) : ?>
	<?php if (isset($this->data->grouped[$letter])) : ?>
		<a href="#letter-grouping-<?php echo $letter; ?>"><?php echo $letter; ?></a>
	<?php else : ?>
		<?php echo $letter; ?>
	<?php endif; ?>
	<?php echo ($letter !== 'Z') ? '|' : ''; ?>
<?php endforeach; ?>
</div>
</div>