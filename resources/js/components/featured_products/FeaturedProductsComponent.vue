<template>
  <div class="row">
  	<div class="col-md-3">
  		<add-new-featured-product-component @featuredProductAdded="onNewFeaturedProductAdded" />
  	</div>
  	<div class="col-md-7 offset-md-2">
  		<form>
	      <div class="row">
	        <div class="col-md-2">
	          <div class="form-group">
	            <select class="form-control" v-model="itemsPerPage">
	              <option value="5">5</option>
	              <option value="10">10</option>
	              <option value="25">25</option>
	              <option value="50">50</option>
	            </select>
	          </div>
	        </div>
	        <div class="col-md-2 offset-md-8">
	          <div class="form-group">
	            <input type="text" class="form-control" v-model="search" />
	          </div>
	        </div>
	      </div>
	    </form>
	    <div class="card">
	      <div class="card-body">
	        <div class="table-responsive">
	          <table class="table mb-0">
	            <thead class="thead-light">
	              <tr>
	                <th>Product</th>
	                <th>Status</th>
	                <th></th>
	              </tr>
	            </thead>
	            <tbody v-if="products.length == 0">
	              <tr>
	                <td colspan="3">
	                  <no-item-found name="featured product" />
	                </td>
	              </tr>
	            </tbody>
	            <tbody v-else>
	              <tr v-for="item in products" :key="item.id">
	                <td>
	                  {{ item.product.product }}
	                </td>
	                <td>
	                  <div class="custom-control custom-switch">
										  <input type="checkbox" class="custom-control-input" :id="'customSwitch' + item.id" :checked="item.status == '1'" @change="toggleStatus(item)">
										  <label class="custom-control-label" :for="'customSwitch' + item.id"></label>
										</div>
	                </td>
	              </tr>
	            </tbody>
	          </table>
	        </div>
	      </div>
	    </div>
	    <nav aria-label="Page navigation example">
	      <ul class="pagination">
	        <li
	          class="page-item"
	          v-for="(page, key) in links"
	          :key="key"
	          :class="page.url == null ? 'disabled' : ''"
	        >
	          <a
	            class="page-link"
	            href="javascript:void(0)"
	            @click="getLink(page.url)"
	            v-html="page.label"
	          ></a>
	        </li>
	      </ul>
	    </nav>
  	</div>
  </div>
</template>

<script>
	import NoItemFound from '../NoItemFound.vue';
	import axios from 'axios';
	import AddNewFeaturedProductComponent from './AddNewFeaturedProductComponent.vue';

	export default
	{
		components: {
			NoItemFound,
			AddNewFeaturedProductComponent
		},
		data()
		{
			return {
				products: [],
				action: 'featured-products/get',
				isLoading: false,
				itemsPerPage: 5,
				links: [],
				search: ""
			}
		},
		methods:
		{
			async getFeaturedProducts(link)
			{
				this.isLoading = true;

				await axios.get(link, {
					params: {
						items: this.itemsPerPage,
						search: this.search
					}
				}).then(res => {
					this.products = res.data.data;
					console.log("Found this data - ", res.data);
					this.links = res.data.meta.links;
				}).catch(error => {
					console.error('found an error', error);
				}).finally(() => {
					this.isLoading = false
				})
			},
			async onNewFeaturedProductAdded()
			{
				await this.getFeaturedProducts(this.action);
			},
			getLink(link)
			{
				this.getFeaturedProducts(link);
			},
			toggleStatus(featured_product)
			{
				let new_status = featured_product.status == 1 ? 0 : 1;

				axios.post('featured-products/' + featured_product.id + '/update', {
					status: new_status,
					_method: 'PATCH'
				}).then(res => {
					this.$swal(res.data.message, '', 'success');
					this.getFeaturedProducts(this.action);
				}).catch(error => {
					this.$swal('Something went wrong!', '', 'error');
					console.error(error);
				});
			}
		},
		created()
		{
			this.getFeaturedProducts(this.action);
		},
		watch:
		{
			itemsPerPage()
			{
				this.getFeaturedProducts(this.action);
			}
		}
	};
</script>