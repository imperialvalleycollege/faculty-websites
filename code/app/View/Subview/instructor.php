
<pre>
	<?php echo print_r($this->model->getData(), true); ?>
</pre>

<?php echo $this->loadMenu('instructor'); ?>
<pre>
	<?php echo print_r($this->model->getCourses(), true); ?>
</pre>
