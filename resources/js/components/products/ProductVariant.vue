<template>
	<div>
		<h3>Product variants</h3>
		<label>Attributes</label>
		<multiselect v-model="selected_attributes" :options="attributes" placeholder="Product Attributes"
			mode="tags" :searchable="true">
		</multiselect>

		<div class="row py-2" v-for="attribute in selected_attributes">
			<div class="col-md-4">
				<label>{{ attribute }}</label>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control">
			</div>
		</div>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Variant</th>
					<th>Variant price</th>
					<th>SKU</th>
					<th>Quantity</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						asd
					</td>
					<td>
						<input type="text" class="form-control">
					</td>
					<td>
						<input type="text" class="form-control">
					</td>
					<td>
						<input type="text" class="form-control">
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	import axios from 'axios';
	import Multiselect from '@vueform/multiselect';

	export default {
		components: { Multiselect },
		data()
		{
			return {
				attributes: ["No attribute exists"],
				selected_attributes: []
			}
		},
		methods:
		{
			getAttributes()
			{
				axios.get('attributes/get')
					.then(res => {
						this.attributes = [];
						res.data.data.forEach(item => {
							this.attributes.push(item.title);
						});
					})
					.catch(error => {
						console.error(error);
					});
			}
		},
		mounted()
		{
			this.getAttributes();
		}
	}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>