<?php $courses = $this->model->getUniqueCourses(); ?>

<?php if (!empty($courses)) : ?>
	<li class="active">
		<a href="#"><i class="fa fa-sitemap fa-fw"></i> <?php echo $this->model->getData()->sis_first_name . ' ' . $this->model->getData()->sis_last_name . "'s Courses"; ?> <span class="fa arrow"></span></a>
    	<ul class="nav nav-second-level">
    		<li>
	            <a href="<?php echo $this->getBaseRequestUri(false); ?>"><i class="fa fa-edit fa-fw"></i> <?php echo 'Instructor Main Page'; ?></a>
	        </li>
	<?php foreach($courses as $course_short_name => $course) : ?>
		<li>
            <a href="<?php echo $this->getBaseRequestUri(); ?><?php echo strtolower(str_replace(' ', '-', $course_short_name)); ?>"><i class="fa fa-edit fa-fw"></i> <?php echo $course_short_name; ?></a>
        </li>
	<?php endforeach; ?>
		</ul>
	</li>
<?php endif; ?>