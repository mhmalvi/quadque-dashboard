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
	              	<div class="pt-3">
	                  <a href="javascript:void(0)" class="text-primary pr-2"
	                    >Edit</a>
	                  <a href="javascript:void(0)" @click.prevent="deleteAttribute(item)" class="text-primary pr-2"
	                    >Delete</a>
                    <a href="javascript:void(0)" @click.prevent="showNewChildAttributeModal(item)">
	                    Add new {{ item.title }}
	                  </a>
	                </div>
	              </td>
	              <td>
	              	{{ item.description }}
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

		<modal v-if="showNewChildModalStatus" @close="showNewChildModalStatus = false"
			size="lg">
			<template v-slot:header>
				{{ activeAddNewModalAttribute.title }} Attribute's Children
			</template>

			<template v-slot:body>
				<form @submit.prevent="addNewChildAttribute">
					<div class="row">
						<div class="col">
							<label>Name</label>
							<input type="text" class="form-control" v-model="childAttributeForm.name">
						</div>
						<div class="col" v-if="activeAddNewModalAttribute.title.toLowerCase() == 'color'">
							<label>Color code</label>
							<input type="text" class="form-control" v-model="childAttributeForm.info">
						</div>
					</div>

					<div class="mt-2 form-group d-flex justify-content-end">
						<button class="btn btn-primary"
							:disabled="childAttributeFormSubmitting">
							{{ (childAttributeFormSubmitting) ? 'Adding...' : 'Add' }}
						</button>
					</div>
				</form>

				<div class="mt-2">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Name</th>
							</tr>
						</thead>
						<tbody>
							<tr class="text-center" v-if="childAttributeModal.isLoading">
	              <td colspan="8">
	                <div class="sk-double-bounce">
	                  <div class="sk-child sk-double-bounce1"></div>
	                  <div class="sk-child sk-double-bounce2"></div>
	                </div>
	              </td>
	            </tr>
							<tr v-for="child in childAttributeModal.data" v-else>
								<td colspan="3" class="d-flex justify-content-between">
									<div>
										{{ child.title }} <span v-if="child.info != null">({{ child.info }})</span>
									</div>
									<div>
										<a href="javascript:void(0)" @click="deleteChild(child)">
											<i class="bi bi-x text-lg" style="font-size: 1.2rem;"></i>
										</a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>

					<nav aria-label="Page navigation example">
			      <ul class="pagination">
			        <li
			          class="page-item"
			          v-for="(page, key) in childAttributeModal.links"
			          :key="key"
			          :class="page.url == null ? 'disabled' : ''"
			        >
			          <a
			            class="page-link"
			            href="javascript:void(0)"
			            @click="getChildAttribute(page.url)"
			            v-html="page.label"
			          ></a>
			        </li>
			      </ul>
			    </nav>
				</div>
			</template>
		</modal>
	</div>
</template>

<script>
	import CreateComponent from './CreateComponent.vue';
	import axios from "axios";
	import Modal from "../Modal.vue";

	export default {
		components: {
			CreateComponent,
			Modal
		},
		data(){
			return {
				links: [],
				attributes: [],
				isLoading: false,
				itemsPerPage: 5,
				search: '',
				action: 'attributes/get',
				showNewChildModalStatus: false,
				activeAddNewModalAttribute: {
					id: 0,
					name: ""
				},
				childAttributeForm: {
					name: '',
					info: ''
				},
				childAttributeModal: {
					data: [],
					links: [],
					itemsPerPage: 5,
					isLoading: false
				},
				childAttributeFormSubmitting: false
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
					params: {
						items: this.itemsPerPage,
						search: this.search
					}
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
			},
			deleteAttribute(attribute)
			{
				this.$swal({
					icon: 'warning',
					title: "Are you sure you want to delete this?",
					html: "<b>Attribute name:</b> " + attribute.title,
					showCancelButton: true,
					showCloseButton: true
				}).then(res => {
					if(res.isConfirmed)
					{
						axios.post("attributes/" + attribute.id + '/delete', {
							_method: "DELETE"
						}).then(res => {
							this.$swal(res.data.message, '', 'success');

							this.getAttributes(this.action);
						})
					}
				}).catch(error => {
					this.$swal({
						icon: "error",
						title: "Something went wrong!"
					});
					console.error(error);
				});
			},
			showNewChildAttributeModal(attribute)
			{
				console.log('attribute', attribute);
				this.activeAddNewModalAttribute.id = attribute.id;
				this.activeAddNewModalAttribute.title = attribute.title;

				this.getChildAttribute('attributes/children/' + this.activeAddNewModalAttribute.id + '/all');

				this.showNewChildModalStatus = true;
			},
			async getChildAttribute(actionLink)
			{
				this.childAttributeModal.isLoading = true;
				await axios.get(actionLink)
					.then(res => {
						this.childAttributeModal.data = res.data.data;
						this.childAttributeModal.links = res.data.meta.links;
						this.childAttributeModal.isLoading = false;
					})
					.catch(error => {
						this.$swal("Some went wrong while fetching the children attributes", '', 'error');
						console.log(error);

						this.showNewChildModalStatus = false;
					})
			},
			addNewChildAttribute()
			{
				if(this.childAttributeForm.name == "")
				{
					return false;
				}
				this.childAttributeFormSubmitting = true;

				axios.post('attributes/children/add-new', {
					name: this.childAttributeForm.name,
					info: this.childAttributeForm.info,
					parent_id: this.activeAddNewModalAttribute.id
				})
					.then(res => {
						this.resetChildCreateForm();

						this.getChildAttribute('attributes/children/' + this.activeAddNewModalAttribute.id + '/all');
					})
					.catch(error => {
						console.error(error);
					})
			},
			resetChildCreateForm()
			{
				this.childAttributeForm.name = '';
				this.childAttributeForm.info = '';
				this.childAttributeFormSubmitting = false;
			},
			deleteChild(child)
			{
				axios.post('attributes/children/' + child.parent_id + '/' + child.id + '/delete', {
						_method: "DELETE"
					}).then(res => {
						console.log(res.data.message);
						this.getChildAttribute('attributes/children/' + this.activeAddNewModalAttribute.id + '/all');
					}).catch(error => {
						console.error(error)
						alert("Something went wrong!");
					})
			},
			searchByName: _.debounce(vm => {
				vm.getAttributes(vm.action);
			}, 500)
		},
		watch: {
			search(newValue, oldValue)
			{
				if(newValue.length > 2 || newValue.length == 0)
				{
					this.searchByName(this);
				}
			},
			itemsPerPage()
			{
				this.getAttributes(this.action)
			}
		}
	}
</script>