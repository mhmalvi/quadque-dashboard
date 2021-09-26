<template>
	<div class="row">
		<div class="col-md-4">
			<create-component @addedNew="onAddNewAttribute"></create-component>
		</div>
		<div class="col-md-7 offset-md-1 p-3">
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
	        <div class="col-md-4 offset-md-6">
	          <div class="form-group">
	            <input type="text" class="form-control" v-model="search" />
	          </div>
	        </div>
	      </div>
	    </form>
	    <div class="card-box">
	      <div class="table-responsive">
	        <table class="table mb-0">
	          <thead class="thead-light">
	            <tr>
	              <th>Name</th>
	              <th>Description</th>
	              <th>Created At</th>
	            </tr>
	          </thead>
	          <tbody>
	            <tr class="text-center" v-if="isLoading">
	              <td colspan="8">
	                <div class="sk-double-bounce">
	                  <div class="sk-child sk-double-bounce1"></div>
	                  <div class="sk-child sk-double-bounce2"></div>
	                </div>
	              </td>
	            </tr>
	            <tr v-for="item in attributes" :key="item.id" v-else>
	              <td>
	              	{{ item.title }}
	              </td>
	              <td>
	              	{{ item.description }}
	              </td>
	              <td>
	              	{{ item.created_at }}
	              </td>
	            </tr>
	          </tbody>
	        </table>
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
	            @click="getAttributes(page.url)"
	            v-html="page.label"
	          ></a>
	        </li>
	      </ul>
	    </nav>
		</div>
	</div>
</template>

<script>
	import CreateComponent from './CreateComponent.vue';
	import axios from "axios";

	export default {
		name: 'AttributeList',
		components: {
			CreateComponent
		},
		data(){
			return {
				links: [],
				attributes: [],
				isLoading: false,
				itemsPerPage: 5,
				search: '',
				action: 'attributes/get'
			}
		},
		mounted()
		{
			this.getAttributes(this.action)
		},
		methods: {
			async getAttributes(actionLink)
			{
				this.isLoading = !this.isLoading;

				await axios.get(actionLink, {
					items: this.itemsPerPage,
					search: this.search
				}).then(res => {
					this.attributes = res.data.data;
					this.links = res.data.meta.links;
					this.isLoading = !this.isLoading;
				}).catch(error => {
					console.error(error)
				})
			},
			onAddNewAttribute(event)
			{
				this.getAttributes(this.action);
			}
		},
		watch: {
			search(newValue, oldValue)
			{
				if(newValue >= 3 || oldValue >= 3)
				{
					this.getAttributes(this.action)
				}
			},
			itemsPerPage()
			{
				this.getAttributes(this.action)
			}
		}
	}
</script>