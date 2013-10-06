<?php include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'includes/functions.php' ?>

<?php plugin('header') ?>
<section class="wrapper">
	<header>
		<h1>Home</h1>
		<!-- Add your site or application content here -->
		<p><em>Hello world! This is <strong>obse</strong>.</em></p>
	</header>

	<div class="main">

		<?php plugin('home_news') ?>
	</div>

	<div class="sidebar">
		<?php plugin('twitter_widget') ?>
	</div>
</section>

<?php plugin('footer') ?>
