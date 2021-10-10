<template>
	<div>
		<h5>Add new featured product</h5>

		<form>
			<div class="form-group">
				<label>Product</label>
				<multiselect placeholder="Select a product" :search="true" mode="tags" />
			</div>
			<div class="form-group">
				<label>Status</label>
				<select class="form-control">
					<option value="1">Active</option>
					<option value="0">Inactive</option>
				</select>
			</div>

			<div class="form-group">
				<button class="btn btn-primary">Add</button>
			</div>
		</form>
	</div>
</template>

<script>
	import Multiselect from '@vueform/multiselect';

	export default
	{
		components: {
			Multiselect
		},
		data()
		{
			return {

			}
		}
	};
</script>