				<section id="content">
					<article id="contact-<?php echo $contact['Contact']['id']; ?>">
						<header>
							<h2 id="header-n-line" class="h-w-line"><span><?php echo $contact['Contact']['title']; ?></span></h2>
						</header>
						<div id="article-container">
							<p><?php echo $contact['Contact']['body']; ?></p>
							<?php if ($contact['Contact']['message_status']):
								
								echo $this->Form->create('Message', array(
									'url' => array(
										'plugin' => 'contacts',
										'controller' => 'contacts',
										'action' => 'view',
										$contact['Contact']['alias'],
									),
								));
								echo $this->Form->input('Message.name', array('class' => 'input-block-level'));
								echo $this->Form->input('Message.email', array('class' => 'input-block-level'));
								echo $this->Form->input('Message.city', array('class' => 'input-block-level'));
								echo $this->Form->input('Message.state', array('class' => 'input-block-level'));
								echo $this->Form->input('Message.subject', array('class' => 'input-block-level'));
								echo $this->Form->input('Message.body', array('class' => 'input-block-level'));
								if ($contact['Contact']['message_captcha']):
									echo $this->Recaptcha->display_form();
								endif;
								echo $this->Form->end(__d('croogo', 'Send'), array('class' => 'btn btn-primary'));
							?>
							<?php endif; ?>
						</div>
					</article>
					<aside id="map-aside">
						<section id="address-aside">
							<?php echo $this->Layout->blocks('contact'); ?>
						</section>
					</aside>
					<br class="clear">
				</section>