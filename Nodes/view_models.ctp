<?php
$this->Helpers->load('Multiattach.Multiattach');
if (count($nodes) == 0) {
	echo __d('croogo', 'No items found.');
}
$this->Html->scriptStart(array('inline' => false));
?>
$(document).ready(function(){
	$('.slideshow2').cycle({fx: 'scrollLeft'});
	$('.slideSwitch').each(function(i, e){
		$.each($(e)[0].classList, function(ik, ev) {
			dest = ev.toString().split("_");
			if (dest[0] == "sS") {
				$(e).on('click',{destination:dest[1]},function(event){
					switchSlider(event.data.destination);
					event.preventDefault();
				});
			}
		});
	});
});
function switchSlider(whichOne){
	$("#eslide").html(slider[whichOne]["html"]);
	$("#etitle").html(slider[whichOne]["title"]);
	$('.slideshow2').cycle({fx: 'scrollLeft'});
}



<?php
$this->Html->scriptEnd();
?>
<section id="content">
	<article id="article">
		<header>
			<h2 id="header-n-line" class="h-w-line"><span>Models</span></h2>
			<div class="model-menu">
				<nav>
					<ul>
						<?php
						
						foreach ($nodes as $node):
							$sel = "";
							if ($node["Node"]["id"] == $currentNode["Node"]["id"]) {
								$vNode = $node;
								$sel = "selected";
							}
							$this->Nodes->set($node);
							$urlNode = array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'indexCustom', 'slug' => $this->Nodes->field('slug'));
							$urlNode = "/models/" . $this->Nodes->field('slug');
							?>
							<li><?php echo $this->Html->link($this->Nodes->field('title'), $urlNode, array("class" => $sel)); ?></li>
							<?php
						endforeach;
						?>
					</ul>
				</nav>
			</div>
		</header>
		<div id="top-half">
			<?php
			$this->Nodes->set($vNode);
			$this->Multiattach->set($vNode["Multiattach"]);
			$images = $this->Multiattach->filterMeta(array('e' => '#.#'));
			foreach ($images as $image) {
				$image = $image["Multiattach"];
				$slides[$image["meta"]["e"]]['alias'] = $image["meta"]["e"];
				$slides[$image["meta"]["e"]]['title'] = $image["comment"];
				$slides[$image["meta"]["e"]]['nodes'][] = $image;

				$imageF = array(
					'plugin' => 'Multiattach',
					'controller' => 'Multiattach',
					'action' => 'displayFile',
					'admin' => false,
					'filename' => $image['filename']
				);
				$imageF = $this->Html->url($imageF + array('dimension' => 'model_slide'));
				if (key_exists("html", $slides[$image["meta"]["e"]])) {
					$slides[$image["meta"]["e"]]['html'] .= PHP_EOL . '<img src="' . $imageF . '" alt="' . $image["comment"] . '" >';
				} else {
					$slides[$image["meta"]["e"]]['html'] = '<img src="' . $imageF . '" alt="' . $image["comment"] . '" >';
				}
			}
			// First slider
			$fr = reset($slides);
			?>
			<section id="slideshow2-section">
				<header>
					<h3 id='etitle'><?php echo $fr['title']; ?></h3>
				</header>
				<div class="slideshow2" id='eslide'>
					<?php
					echo $fr['html'];
					?>
				</div>
			</section>
			<section id="elevation-section">
				<header>
					<h3 id="header-elevations">ELEVATIONS</h3>
				</header>
				<div id="elevation-thumbnails">
					<figure>
						<?php
						$imageF = array(
								'plugin' => 'Multiattach',
								'controller' => 'Multiattach',
								'action' => 'displayFile',
								'admin' => false,
						);
						foreach ($slides as $slideGroup) {
							?>
							<a href='#' class='slideSwitch sS_<?php echo $slideGroup['alias']; ?>'>
								<img class="elevation_thumbnail" src="<?php echo $this->Html->url($imageF + array('dimension' => 'model_slide_thumb', 'filename' => $slideGroup['nodes'][0]['filename']) ); ?>" alt="Villas at Renaissance - <?php echo $slideGroup['nodes'][0]['comment']; ?>" />
							</a>
							<?php
						}
						?>
					</figure>
				</div>
				<script>
				var slider =
				<?php
					echo json_encode($slides);
				?>;
				</script>
			</section>
			<br class="clear">
		</div>
		<!--<aside id="details-aside">-->
		<div id="bottom-half">
			<section id="description-section">
				<?php
					echo $this->Nodes->body();
				?>
			</section>
			<section id="plant-section">
				<header>
					<h3>PLANT</h3>
				</header>
				<?php
				$notSlider = $this->Multiattach->filter(array('meta' => '#^$#','mime' => '#image#'));
				$display = array(
								'plugin' => 'Multiattach',
								'controller' => 'Multiattach',
								'action' => 'displayFile',
								'admin' => false,
							);
				foreach ($notSlider as $nS) {
					$nS = $nS["Multiattach"];
				?>
				<figure>
					<img class="thumbnail" src="<?php echo $this->Html->url($display + array('dimension' => 'page_side', 'filename' => $nS['filename']) ); ?>" alt="Villas at Renaissance - <?php echo $nS['comment']; ?>" />
				</figure>
				<?php
				}
				$downloads = $this->Multiattach->filter(array('meta' => '#^$#','mime' => '#pdf#'));
				
				foreach ($downloads as $dl) {
					$dl = $dl['Multiattach'];
					?>
					<a id="download_link" href="<?php echo $this->Html->url($display + array('dimension' => 'normal', 'filename' => $dl['filename'])); ?>">DOWNLOAD SPECS AND FEATURE LIST <?php echo $this->Html->image("pdf.png", array('alt' => "Download PDF")); ?></a>
					<?php
				}
				?>
			</section>
			<br class="clear">
		</div>
		<!--</aside>-->
		<br class="clear">
	</article>
</section>