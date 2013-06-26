<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<?php
		echo $this->Html->css(array("reset","bootstrap.min","layout.css?v=0002","modal",'slideshow'));
		echo $this->Seo->meta();
		echo $this->Layout->feed();	
		?>
		<!--[if IE]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php
			echo $this->Html->script('jquery-1.10.1.min');
			echo $this->Html->script('cycle');
			echo $this->Layout->js();
			echo $scripts_for_layout;
		?>
		<script type="text/javascript">
			WebFontConfig = {
				google: { families: [ 'Parisienne::latin', 'Michroma::latin' ]  }
			  };
			  (function() {
				var wf = document.createElement('script');
				wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
				  '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
				wf.type = 'text/javascript';
				wf.async = 'true';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(wf, s);
			  })();
		</script>
		<script type="text/jscript">
			$(document).ready(function(){
				$('.slideshow').cycle({
					fx: 'fade'
				});
			});
		</script>
	</head>
	<body>
	<!--[if lte IE 8]>
	  <iframe src="http://www.browserupgrade.info/ie6-upgrade/?lang=en&title=GMAC Development&gc=true&more-info-at=http://www.browserupgrade.info" frameborder="no" style="height: 81px; width: 100%; border: none;"></iframe>
	<![endif]-->
		<div id="wrapper">
			<header id="header">
				<?php 
				if(Router::url('/')==Router::url(null, false))
					$tag="h1";
				else
					$tag='div';
				?>
				<<?php echo $tag; ?> id="logo-heading">
					<?php echo $this->Html->image('Villas_at_Renaissance.png', array('alt' => 'Villas at Renaissance', 'width' => '757', 'height' => '394', 'id' => 'topImage')); ?>
				</<?php echo $tag; ?>>
				<div id="social-region">
					<?php echo $this->Layout->blocks('social'); ?>
				</div>
				<div id="slide-background">
					<nav>
						<?php echo $this->Layout->menu('main'); ?>
					</nav>
					<section>
						<div class="slideshow">
							<img src="img/kitchen.jpg" alt="Kitchen">
							<img src="img/outdoors.jpg" alt="Outdoors">
						</div>
					</section>
				</div>
			</header>
			<br class="clear">
			<div>
				<?php echo $content_for_layout; ?>
			</div>
			<footer id="footer">
				<div id="footer-container">
					<?php echo $this->Html->image('Villas_at_renaissance_2.png', array('alt' => 'Villas at Renaissance', 'width' => '126', 'height' => '76')); ?>
					<nav id="nav-footer">
						<?php echo $this->Layout->menu('main'); ?>
					</nav>
					<div id="footer-region">
						<?php echo $this->Layout->blocks('footer'); ?>
					</div>
					<br class="clear">
				</div>
			</footer>
		</div>
	</body>
</html>