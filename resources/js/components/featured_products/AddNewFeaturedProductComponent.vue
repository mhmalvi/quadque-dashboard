<template>
	<div>
		<h6>Add new featured product</h6>

		<form @submit.prevent="saveProduct">
			<div class="form-group">
				<label>Select a Product Category</label>
				<multiselect placeholder="Select a category" :searchable="true" v-model="category" :options="categories" />
			</div>
			<div class="form-group">
				<label>Product</label>
				<multiselect placeholder="Select a product" :searchable="true" :options="products" v-model="product" mode="multiple" />
				<p v-if="isLoadingProducts">Loading products...</p>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary" :disabled="!isValid || isSubmitting">
					<span
	          class="spinner-border spinner-border-sm"
	          role="status"
	          aria-hidden="true"
	          v-if="isSubmitting"
	        ></span>
					{{ isSubmitting ? "Adding..." : "Add" }}
				</button>
			</div>
		</form>
	</div>
</template>

<script>
	import Multiselect from '@vueform/multiselect';
	import axios from 'axios';

	export default
	{
		components: {
			Multiselect
		},
		data()
		{
			return {
				action: 'featured-products/store',
				category: "",
				product: [],
				categories: [],
				products: [],
				isSubmitting: false,
				isLoadingProducts: false
			}
		},
		methods:
		{
			getAllCategories()
			{
				this.categories = [];
				axios.get('categories/all?children=true')
					.then(res => {
						let categories_data = res.data.data;
						categories_data.forEach(item => {
							this.categories.push(item.title);
						})
						console.log('categories', this.categories);
					}).catch(error => {
						console.error('error', error);
					})
			},
			getAllProducts(category)
			{
				console.log("fetching " + category + " products");
				this.products = [];
				this.isLoadingProducts = true;

				axios.get('products/get', {
					params: {
						category: category
					}
				}).then(res => {
					console.log('products', res.data);
					let products_data = res.data.data;
					products_data.forEach(item => {
						console.log('product data -> ', item);
						this.products.push(item.title);
					})
				}).catch(error => {
					console.error(error);
				}).finally(() => {
					this.isLoadingProducts = false;
				})
			},
			saveProduct()
			{
				this.isSubmitting = true;

				axios.post(this.action, {
					products: this.product, // this.product is type of array[]
				}).then(res => {
					this.$swal(res.data.message, '', 'success');

					this.product = [];

					this.$emit('featuredProductAdded');
				}).catch(error => {
					this.$swal("Something went wrong!", '', 'error');
				}).finally(() => {
					this.isSubmitting = false;
				})
			}
		},
		created()
		{
			this.getAllCategories();
		},
		computed:
		{
			isValid()
			{
				return this.product.length > 0;
			}
		},
		watch:
		{
			category(newVal, oldVal)
			{
				this.product = [];
				this.products = [];
				if(newVal != '' && newVal != null)
				{
					this.getAllProducts(newVal);
				}
			}
		}
	};
</script>