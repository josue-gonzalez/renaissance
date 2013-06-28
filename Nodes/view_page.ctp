<?php
$this->Helpers->load('Multiattach.Multiattach');
?>
<?php $this->Nodes->set($node); ?>
<section id="content">
	<article id="node-<?php echo $this->Nodes->field('id'); ?>" class="node node-type-<?php echo $this->Nodes->field('type'); ?>">
		<header>
			<h1 id="header-n-line" class="h-w-line"><span><?php echo $this->Nodes->field('title'); ?></span></h1>
		</header>
		<div id="article-container">
		<?php
			echo $this->Nodes->info();
			echo $this->Nodes->body();
			echo $this->Nodes->moreInfo();
		?>
		</div>
	</article>
	<aside id="images-aside">		
<?php
	$this->Multiattach->set($node["Multiattach"]);
	$images = $this->Multiattach->filter(array('mime'=>'#image#i'));
	if ($images !== false) {
		foreach ($images as $image) {
			$imageF = array(
				'plugin' => 'Multiattach',
				'controller' => 'Multiattach',
				'action' => 'displayFile', 
				'admin' => false,
				'filename' => $image["Multiattach"]['filename']
			);
			?>
			<figure>
				<img class="thumbnail" id="thumbnail<?php echo $image["Multiattach"]["id"]; ?>" src="<?php echo $this->Html->url($imageF + array('dimension' => 'page_side') ); ?>" alt="Villas at Renaissance - <?php echo $image["Multiattach"]['comment']; ?>" />
			</figure>
			<?php
		}
	}
?>
	</aside>
	<br class="clear">
</section>