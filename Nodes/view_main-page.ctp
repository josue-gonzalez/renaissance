<?php
$this->Helpers->load('Multiattach.Multiattach');
?>
<?php $this->Nodes->set($node); ?>
<section id="content-main">
	<article id="node-<?php echo $this->Nodes->field('id'); ?>" class="node node-type-<?php echo $this->Nodes->field('type'); ?>">
		<header>
			<h2 class="h-w-line"><span><?php echo $this->Nodes->field('title'); ?></span></h2>
		</header>
		<div id="article-container">
		<?php
			echo $this->Nodes->info();
			echo $this->Nodes->body();
			echo $this->Nodes->moreInfo();
		?>
		</div>
	</article>
	<aside id="youtube-video">
		<?php echo $this->Layout->blocks('main'); ?>
	</aside>
	<br class="clear">
</section>