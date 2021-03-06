<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017-2018
 */

$enc = $this->encoder();

$keys = [
	'product.lists.id', 'product.lists.siteid', 'product.lists.refid', 'product.label', 'product.code'
];


?>
<div class="col-xl-6 content-block item-related-bought">

	<table class="product-list table table-default"
		data-items="<?= $enc->attr( json_encode( $this->get( 'boughtData', [] ) ) ); ?>"
		data-keys="<?= $enc->attr( json_encode( $keys ) ) ?>"
		data-prefix="product.lists."
		data-siteid="<?= $this->site()->siteid() ?>" >

		<thead>
			<tr>
				<th>
					<span class="help"><?= $enc->html( $this->translate( 'admin', 'Products bought together' ) ); ?></span>
					<div class="form-text text-muted help-text">
						<?= $enc->html( $this->translate( 'admin', 'List of products often bought together' ) ); ?>
					</div>
				</th>
				<th class="actions">
					<div class="btn act-add fa" tabindex="<?= $this->get( 'tabindex' ); ?>"
						title="<?= $enc->attr( $this->translate( 'admin', 'Insert new entry (Ctrl+I)' ) ); ?>"
						v-on:click="addItem()">
					</div>
				</th>
			</tr>
		</thead>

		<tbody is="draggable" v-model="items" group="related" handle=".act-move" tag="tbody">

			<tr v-for="(item, idx) in items" v-bind:key="idx"
				v-bind:class="item['product.lists.siteid'] != '<?= $this->site()->siteid() ?>' ? 'readonly' : ''">
				<td v-bind:class="(item['css'] || '')">
					<input class="item-listid" type="hidden" v-model="item['product.lists.id']"
						v-bind:name="'<?= $enc->attr( $this->formparam( ['related', 'bought', 'idx', 'product.lists.id'] ) ); ?>'.replace( 'idx', idx )" />

					<input class="item-label" type="hidden" v-model="item['product.label']"
						v-bind:name="'<?= $enc->attr( $this->formparam( ['related', 'bought', 'idx', 'product.label'] ) ); ?>'.replace( 'idx', idx )" />

					<input class="item-code" type="hidden" v-model="item['product.code']"
						v-bind:name="'<?= $enc->attr( $this->formparam( ['related', 'bought', 'idx', 'product.code'] ) ); ?>'.replace( 'idx', idx )" />

					<select is="combo-box" class="form-control custom-select item-refid"
						v-bind:name="'<?= $enc->attr( $this->formparam( ['related', 'bought', 'idx', 'product.lists.refid'] ) ); ?>'.replace( 'idx', idx )"
						v-bind:readonly="checkSite('product.lists.siteid', idx) || item['product.lists.id'] != ''"
						v-bind:tabindex="'<?= $this->get( 'tabindex' ); ?>'"
						v-bind:label="getLabel(idx)"
						v-bind:required="'required'"
						v-bind:getfcn="getItems"
						v-bind:index="idx"
						v-on:select="update"
						v-model="item['product.lists.refid']">
					</select>
				</td>
				<td class="actions">
					<div v-if="!checkSite('product.lists.siteid', idx) && item['product.lists.id'] != ''"
						class="btn btn-card-header act-move fa" tabindex="<?= $this->get( 'tabindex' ); ?>"
						title="<?= $enc->attr( $this->translate( 'admin', 'Move this entry up/down' ) ); ?>">
					</div>
					<div v-if="!checkSite('product.lists.siteid', idx)"
						class="btn act-delete fa" tabindex="<?= $this->get( 'tabindex' ); ?>"
						title="<?= $enc->attr( $this->translate( 'admin', 'Delete this entry' ) ); ?>"
						v-on:click.stop="removeItem(idx)">
					</div>
				</td>
			</tr>

		</tbody>
	</table>

	<?= $this->get( 'boughtBody' ); ?>
</div>
