<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017-2018
 */


$enc = $this->encoder();

$keys = [
	'product.lists.siteid', 'product.lists.type', 'product.lists.datestart', 'product.lists.dateend', 'config',
	'text.siteid', 'text.type', 'text.languageid', 'text.content', 'text.status'
];

/** admin/jqadm/api/translate
 * Configuration for realtime online translation service
 *
 * Contains the required settings for configuring the online translation service.
 * Currently, only DeepL is supported and a paid DeepL API account is required to
 * use the service. The necessary settings for DeepL are:
 *
 *  [
 *    'url' => 'https://api.deepl.com/v2',
 *    'key' => '<your-DeepL-API-key>',
 *  ]
 *
 * @param array Associative list of key/value pairs
 * @category Developer
 * @category User
 * @since 2019.10
 */

?>
<div id="text" class="item-text content-block tab-pane fade" role="tablist" aria-labelledby="text">
	<div id="item-text-group" role="tablist" aria-multiselectable="true"
		data-translate="<?= $enc->attr( json_encode( $this->config( 'admin/jqadm/api/translate', [] ) ) ) ?>"
		data-items="<?= $enc->attr( json_encode( $this->get( 'textData', [] ) ) ); ?>"
		data-listtype="<?= key( $this->get( 'textListTypes', [] ) ) ?>"
		data-keys="<?= $enc->attr( json_encode( $keys ) ) ?>"
		data-siteid="<?= $this->site()->siteid() ?>"
		data-domain="product" >

		<div class="group-list">
			<div is="draggable" v-model="items" group="text" handle=".act-move">
				<div v-for="(entry, idx) in items" v-bind:key="idx" class="group-item card">

					<div v-bind:id="'item-text-group-item-' + idx" v-bind:class="getCss(idx)"
						v-bind:data-target="'#item-text-group-data-' + idx" data-toggle="collapse" role="tab" class="card-header header"
						v-bind:aria-controls="'item-text-group-data-' + idx" aria-expanded="false">
						<div class="card-tools-left">
							<div class="btn btn-card-header act-show fa" tabindex="<?= $this->get( 'tabindex' ); ?>"
								title="<?= $enc->attr( $this->translate( 'admin', 'Show/hide this entry' ) ); ?>">
							</div>
						</div>
						<span class="item-label header-label" v-html="getLabel(idx)"></span>
						&nbsp;
						<div class="card-tools-right">
							<div v-if="!checkSite('product.lists.siteid', idx)" class="dropdown">
								<button class="btn btn-card-header act-translate fa dropdown-toggle" tabindex="<?= $this->get( 'tabindex' ); ?>"
									type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
									title="<?= $enc->attr( $this->translate( 'admin', 'Translate text' ) ); ?>">
								</button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#" v-on:click="translate(idx, 'DE')">Deutsch</a>
									<a class="dropdown-item" href="#" v-on:click="translate(idx, 'EN')">English</a>
									<a class="dropdown-item" href="#" v-on:click="translate(idx, 'ES')">Espa??ol</a>
									<a class="dropdown-item" href="#" v-on:click="translate(idx, 'FR')">Fran??ais</a>
									<a class="dropdown-item" href="#" v-on:click="translate(idx, 'IT')">Italiano</a>
									<a class="dropdown-item" href="#" v-on:click="translate(idx, 'NL')">Nederlands</a>
									<a class="dropdown-item" href="#" v-on:click="translate(idx, 'PL')">Polski</a>
									<a class="dropdown-item" href="#" v-on:click="translate(idx, 'PT')">Portugu??s</a>
									<a class="dropdown-item" href="#" v-on:click="translate(idx, 'RU')">?????????????? ????????</a>
								</div>
							</div>
							<div v-if="!checkSite('product.lists.siteid', idx)"
								class="btn btn-card-header act-move fa" tabindex="<?= $this->get( 'tabindex' ); ?>"
								title="<?= $enc->attr( $this->translate( 'admin', 'Move this entry up/down' ) ); ?>">
							</div>
							<div v-if="!checkSite('product.lists.siteid', idx)"
								class="btn btn-card-header act-delete fa" tabindex="<?= $this->get( 'tabindex' ); ?>"
								title="<?= $enc->attr( $this->translate( 'admin', 'Delete this entry' ) ); ?>"
								v-on:click.stop="removeItem(idx)">
							</div>
						</div>
					</div>

					<div v-bind:id="'item-text-group-data-' + idx" v-bind:class="getCss(idx)"
						v-bind:aria-labelledby="'item-text-group-item-' + idx" role="tabpanel" class="card-block collapse row">

						<input type="hidden" v-model="items[idx]['text.id']"
							v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'text.id' ) ) ); ?>'.replace('idx', idx)" />

						<div class="col-xl-6">

							<div class="form-group row mandatory">
								<div class="col-sm-12">
									<textarea is="html-editor" class="form-control item-content" required="required"
										v-bind:key="idx"
										v-bind:id="'cke-' + idx"
										v-bind:value="items[idx]['text.content']"
										v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'text.content' ) ) ); ?>'.replace('idx', idx)"
										v-bind:readonly="checkSite('text.siteid', idx)"
										v-bind:tabindex="<?= $this->get( 'tabindex' ); ?>"
										v-model="items[idx]['text.content']"
									></textarea>
								</div>
							</div>

						</div>

						<div class="col-xl-6">

							<div class="form-group row mandatory">
								<label class="col-sm-4 form-control-label"><?= $enc->html( $this->translate( 'admin', 'Status' ) ); ?></label>
								<div class="col-sm-8">
									<select class="form-control custom-select item-status" required="required" tabindex="<?= $this->get( 'tabindex' ); ?>"
										v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'text.status' ) ) ); ?>'.replace('idx', idx)"
										v-bind:readonly="checkSite('text.siteid', idx)"
										v-model="items[idx]['text.status']" >
										<option value="1" v-bind:selected="entry['text.status'] == 1" >
											<?= $enc->html( $this->translate( 'mshop/code', 'status:1' ) ); ?>
										</option>
										<option value="0" v-bind:selected="entry['text.status'] == 0" >
											<?= $enc->html( $this->translate( 'mshop/code', 'status:0' ) ); ?>
										</option>
										<option value="-1" v-bind:selected="entry['text.status'] == -1" >
											<?= $enc->html( $this->translate( 'mshop/code', 'status:-1' ) ); ?>
										</option>
										<option value="-2" v-bind:selected="entry['text.status'] == -2" >
											<?= $enc->html( $this->translate( 'mshop/code', 'status:-2' ) ); ?>
										</option>
									</select>
								</div>
							</div>

							<?php $languages = $this->get( 'pageLangItems', [] ); ?>
							<?php if( count( $languages ) > 1 ) : ?>
								<div class="form-group row mandatory">
									<label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'Language' ) ); ?></label>
									<div class="col-sm-8">
										<select class="form-control custom-select item-languageid" required="required" tabindex="<?= $this->get( 'tabindex' ); ?>"
											v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'text.languageid' ) ) ); ?>'.replace('idx', idx)"
											v-bind:readonly="checkSite('text.siteid', idx)"
											v-model="items[idx]['text.languageid']" >

											<option value="" disable >
												<?= $enc->attr( $this->translate( 'admin', 'Please select' ) ); ?>
											</option>
											<option v-bind:value="null">
												<?= $enc->attr( $this->translate( 'admin', 'All' ) ); ?>
											</option>

											<?php foreach( $languages as $langId => $langItem ) : ?>
												<option value="<?= $enc->attr( $langId ); ?>" v-bind:selected="entry['text.languageid'] == '<?= $enc->attr( $langId ) ?>'" >
													<?= $enc->html( $langItem->getLabel() ); ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-sm-12 form-text text-muted help-text">
										<?= $enc->html( $this->translate( 'admin', 'Language of the entered text' ) ); ?>
									</div>
								</div>
							<?php else : ?>
								<input class="text-langid" type="hidden"
									v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'text.languageid' ) ) ); ?>'.replace('idx', idx)"
									value="<?= $enc->attr( key( $languages ) ); ?>" />
							<?php endif; ?>

							<?php $textTypes = $this->get( 'textTypes', [] ); ?>
							<?php if( count( $textTypes ) > 1 ) : ?>
								<div class="form-group row mandatory">
									<label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'Type' ) ); ?></label>
									<div class="col-sm-8">
										<select class="form-control custom-select item-type" required="required" tabindex="<?= $this->get( 'tabindex' ); ?>"
											v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'text.type' ) ) ); ?>'.replace('idx', idx)"
											v-bind:readonly="checkSite('text.siteid', idx)"
											v-model="items[idx]['text.type']" >

											<option value="" disable >
												<?= $enc->attr( $this->translate( 'admin', 'Please select' ) ); ?>
											</option>

											<?php foreach( (array) $textTypes as $type => $item ) : ?>
												<option value="<?= $enc->attr( $type ); ?>" v-bind:selected="entry['text.type'] == '<?= $enc->attr( $type ) ?>'" >
													<?= $enc->html( $item->getLabel() ); ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-sm-12 form-text text-muted help-text">
										<?= $enc->html( $this->translate( 'admin', 'Types for additional texts like per one lb/kg or per month' ) ); ?>
									</div>
								</div>
							<?php else : ?>
								<input class="item-type" type="hidden"
									v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'text.type' ) ) ); ?>'.replace('idx', idx)"
									value="<?= $enc->attr( key( $textTypes ) ); ?>" />
							<?php endif; ?>

							<div class="form-group row optional">
									<label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'Label' ) ); ?></label>
								<div class="col-sm-8">
									<input class="form-control item-label" type="text" tabindex="<?= $this->get( 'tabindex' ); ?>"
										v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'text.label' ) ) ); ?>'.replace('idx', idx)"
										placeholder="<?= $enc->attr( $this->translate( 'admin', 'Label' ) ); ?>"
										v-bind:readonly="checkSite('text.siteid', idx)"
										v-model="items[idx]['text.label']" />
								</div>
								<div class="col-sm-12 form-text text-muted help-text">
									<?= $enc->html( $this->translate( 'admin', 'Description of the text content if it\'s in a foreign language' ) ); ?>
								</div>
							</div>

						</div>


						<div v-on:click="toggle(idx)" class="col-xl-12 advanced" v-bind:class="{ 'collapsed': !advanced[idx] }">
							<div class="card-tools-left">
								<div class="btn act-show fa" tabindex="<?= $this->get( 'tabindex' ); ?>"
									title="<?= $enc->attr( $this->translate( 'admin', 'Show/hide advanced data' ) ); ?>">
								</div>
							</div>
							<span class="header-label"><?= $enc->html( $this->translate( 'admin', 'Advanced' ) ); ?></span>
						</div>

						<div v-show="advanced[idx]" class="col-xl-6 content-block secondary">

							<input type="hidden" v-model="items[idx]['product.lists.type']"
								v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'product.lists.type' ) ) ); ?>'.replace( 'idx', idx )" />

							<?php $listTypes = $this->get( 'textListTypes', [] ); ?>
							<?php if( count( $listTypes ) > 1 ) : ?>
								<div class="form-group row mandatory">
									<label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'List type' ) ); ?></label>
									<div class="col-sm-8">
										<select class="form-control custom-select listitem-type" required="required" tabindex="<?= $this->get( 'tabindex' ); ?>"
											v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'product.lists.type' ) ) ); ?>'.replace('idx', idx)"
											v-bind:readonly="checkSite('product.lists.siteid', idx)"
											v-model="items[idx]['product.lists.type']" >

											<?php foreach( $this->get( 'textListTypes', [] ) as $type => $item ) : ?>
												<option value="<?= $enc->attr( $type ); ?>" v-bind:selected="entry['product.lists.type'] == '<?= $enc->attr( $type ) ?>'" >
													<?= $enc->html( $item->getLabel() ); ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-sm-12 form-text text-muted help-text">
										<?= $enc->html( $this->translate( 'admin', 'Second level type for grouping items' ) ); ?>
									</div>
								</div>
							<?php else : ?>
								<input class="listitem-type" type="hidden"
									v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'product.lists.type' ) ) ); ?>'.replace('idx', idx)"
									value="<?= $enc->attr( key( $listTypes ) ); ?>"
									v-model="items[idx]['product.lists.type']" />
							<?php endif; ?>

							<div class="form-group row optional">
								<label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'Start date' ) ); ?></label>
								<div class="col-sm-8">
									<input class="form-control listitem-datestart" type="datetime-local" tabindex="<?= $this->get( 'tabindex' ); ?>"
										v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'product.lists.datestart' ) ) ); ?>'.replace('idx', idx)"
										placeholder="<?= $enc->attr( $this->translate( 'admin', 'YYYY-MM-DD hh:mm:ss (optional)' ) ); ?>"
										v-bind:readonly="checkSite('product.lists.siteid', idx)"
										v-model="items[idx]['product.lists.datestart']" />
								</div>
								<div class="col-sm-12 form-text text-muted help-text">
									<?= $enc->html( $this->translate( 'admin', 'The item is only shown on the web site after that date and time' ) ); ?>
								</div>
							</div>
							<div class="form-group row optional">
								<label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'End date' ) ); ?></label>
								<div class="col-sm-8">
									<input class="form-control listitem-dateend" type="datetime-local" tabindex="<?= $this->get( 'tabindex' ); ?>"
										v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'product.lists.dateend' ) ) ); ?>'.replace('idx', idx)"
										placeholder="<?= $enc->attr( $this->translate( 'admin', 'YYYY-MM-DD hh:mm:ss (optional)' ) ); ?>"
										v-bind:readonly="checkSite('product.lists.siteid', idx)"
										v-model="items[idx]['product.lists.dateend']" />
								</div>
								<div class="col-sm-12 form-text text-muted help-text">
									<?= $enc->html( $this->translate( 'admin', 'The item is only shown on the web site until that date and time' ) ); ?>
								</div>
							</div>
						</div>

						<div v-show="advanced[idx]" class="col-xl-6 content-block secondary" v-bind:class="checkSite('product.lists.siteid', idx) ? 'readonly' : ''">
							<table class="item-config table table-striped">
								<thead>
									<tr>
										<th>
											<span class="help"><?= $enc->html( $this->translate( 'admin', 'Option' ) ); ?></span>
											<div class="form-text text-muted help-text">
												<?= $enc->html( $this->translate( 'admin', 'Configuration options, will be available as key/value pairs in the list item' ) ); ?>
											</div>
										</th>
										<th>
											<?= $enc->html( $this->translate( 'admin', 'Value' ) ); ?>
										</th>
										<th class="actions">
											<div class="btn act-add fa" tabindex="<?= $this->get( 'tabindex' ); ?>"
												title="<?= $enc->attr( $this->translate( 'admin', 'Insert new entry (Ctrl+I)' ) ); ?>"
												v-bind:readonly="checkSite('product.lists.siteid', idx)"
												v-on:click="addConfig(idx)" >
											</div>
										</th>
									</tr>
								</thead>
								<tbody>

									<tr v-for="(key, pos) in getConfig(idx)" v-bind:key="pos">
										<td>
											<input is="auto-complete"
												v-model="items[idx]['config']['key'][pos]"
												v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'config', 'key', '' ) ) ); ?>'.replace('idx', idx)"
												v-bind:readonly="checkSite('product.lists.siteid', idx)"
												v-bind:tabindex="<?= $this->get( 'tabindex' ); ?>"
												v-bind:keys="[]" />
										</td>
										<td>
											<input type="text" class="form-control" tabindex="<?= $this->get( 'tabindex' ); ?>"
												v-bind:name="'<?= $enc->attr( $this->formparam( array( 'text', 'idx', 'config', 'val', '' ) ) ); ?>'.replace('idx', idx)"
												v-bind:readonly="checkSite('product.lists.siteid', idx)"
												v-model="items[idx]['config']['val'][pos]" />
										</td>
										<td class="actions">
											<div v-if="!checkSite('product.lists.siteid', idx)" v-on:click="removeConfig(idx, pos)"
												class="btn act-delete fa" tabindex="<?= $this->get( 'tabindex' ); ?>"
												title="<?= $enc->attr( $this->translate( 'admin', 'Delete this entry' ) ); ?>">
											</div>
										</td>
									</tr>

								</tbody>
							</table>
						</div>

						<?= $this->get( 'textBody' ); ?>

					</div>
				</div>
			</div>

			<div slot="footer" class="card-tools-more">
				<div class="btn btn-primary btn-card-more act-add fa" tabindex="<?= $this->get( 'tabindex' ); ?>"
					title="<?= $enc->attr( $this->translate( 'admin', 'Insert new entry (Ctrl+I)' ) ); ?>"
					v-on:click="addItem('product.lists.')" >
				</div>
			</div>
		</div>
	</div>
</div>
