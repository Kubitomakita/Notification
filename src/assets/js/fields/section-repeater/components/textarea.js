/* global Vue */

import { inputsHandler } from '../../repeater/mixins/inputsHandler';
import { fieldHandler } from '../../repeater/mixins/fieldHandler';
import { inputNameHandler } from '../mixins/inputNameHandler';

Vue.component( 'notification-textarea', {
	template:
	`
	<div>
		<label>
			{{ subfield.label }}
			<textarea
			:id="subfield.id"
			:class="subfield.css_class"
			:value="subfield.value"
			:rows="subfield.rows || 20"
			:name="inputName"
			:placeholder="subfield.placeholder"
			:parent-field="parentField"
			:row-index="rowIndex"
			></textarea>
			<small
				v-if="subfield.description"
			class="description">
				{{ subfield.description }}
			</small>
		</label>
	</div>
	`,
	props: ['subfield','rowIndex', 'keyIndex', 'type', 'sectionName', 'inputType', 'parentField' ],
	mixins: [ inputsHandler,  fieldHandler, inputNameHandler ],
	computed: {
		inputName(){
			const baseFieldName = this.createFieldName( this.type, this.rowIndex, this.subfield );
			const fieldName = `[${this.parentFieldName}][${this.keyIndex}]`;
			if( 'repeater' === this.inputType){
				return `${baseFieldName}${fieldName.toLowerCase()}[${this.sectionName.toLowerCase()}][${this.subfield.name.toLowerCase()}]`
			} 
				return `${baseFieldName}${fieldName.toLowerCase()}[${this.subfield.name.toLowerCase()}]`
			
		}
	}
} )