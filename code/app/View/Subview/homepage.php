<?php if (!empty($this->data->grouped)): ?>
		<?php $this->loadPartial('homepage_alpha_header'); ?>

		<?php foreach($this->data->grouped as $letter => $grouping) : ?>
			<div class="letter-grouping-container">
				<div id="letter-grouping-<?php echo $letter; ?>" class="letter-grouping-heading-container">
					<span class="letter-grouping-heading"><?php echo $letter; ?></span>
				</div>
				<div class="letter-grouping-links-container">
					<ul style=" font-weight: bold">
						<?php foreach($grouping as $user) : ?>
						<li><a href="<?php echo $user->sis_username ?>"><?php echo $user->sis_last_name . ', ' . $user->sis_first_name; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<p class="letter-grouping-return-to-top"><a href="#letter-grouping-alpha-header">Back to Top</a></p>
			</div>
		<?php endforeach; ?>


<?php endif; ?>

<?php if (!empty($this->data->users)): ?>
	<pre>
	<?php echo print_r($this->data->users, true); ?>
	</pre>
<?php endif; ?>
