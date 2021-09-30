<template>
  <div>
    <form>
      <div class="row">
        <div class="col-md-1">
          <div class="form-group">
            <select class="form-control" v-model="itemsPerPage">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <select class="form-control" v-model="category">
              <option value="" selected disabled>Filter by category</option>
              <option value="">All</option>
              <option
                v-for="item in categories"
                :key="item.id"
                :value="item.slug"
              >
                {{ item.title }}
              </option>
            </select>
          </div>
        </div>
        <div class="col-md-2 offset-md-7">
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
              <th width="5%">Image</th>
              <th width="35%">Product</th>
              <th width="10%">SKU</th>
              <th width="10%">Price</th>
              <th width="10%">Category</th>
              <th width="10%">Brand</th>
              <th width="10%">Status</th>
              <th width="10%">Created At</th>
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
            <tr v-else-if="products.length == 0">
              <td colspan="8">
                <no-item-found name="product"/>
              </td>
            </tr>
            <tr v-for="item in products" :key="item.id" v-else>
              <td>
                <img
                  :src="imgPath + item.thumbnail"
                  :alt="item.title"
                  width="50"
                />
              </td>
              <td>
                {{ item.title }}
                <div class="pt-3">
                  <a :href="'/products/' + item.slug + '/edit'" class="text-primary pr-2"
                    >Edit</a
                  >
                  <a href="javascript:void(0)" @click.prevent="deleteProduct(item)" class="text-primary pr-2"
                    >Delete</a
                  >
                </div>
              </td>
              <td>{{ item.sku }}</td>
              <td></td>
              <td>{{ item.category }}</td>
              <td>{{ item.brand }}</td>
              <td></td>
              <td></td>
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
            @click="getLink(page.url)"
            v-html="page.label"
          ></a>
        </li>
      </ul>
    </nav>
  </div>
</template>
<script>
import axios from "axios";
import _ from 'lodash';
import NoItemFound from '../NoItemFound.vue';

export default {
  components: { NoItemFound },
  data() {
    return {
      isLoading: false,
      products: [],
      itemsPerPage: 5,
      links: [],
      action: "products/get",
      imgPath: "../../../../storage/thumbnails/",
      categories: [],
      search: "",
      category: "",
    };
  },
  methods: {
    async getAllProducts(actionLink) {
      this.isLoading = !this.isLoading;
      await axios
        .get(actionLink, {
          params: {
            items: this.itemsPerPage,
            search: this.search,
            category: this.category,
          },
        })
        .then((res) => {
          this.products = res.data.data;
          this.links = res.data.meta.links;
          this.isLoading = !this.isLoading;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    getLink(link) {
      this.getAllProducts(link);
    },
    /**
     * fetch all categories
     */
    fetchCategories() {
      axios
        .get("categories/all")
        .then((res) => {
          this.categories = res.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    /**
     * Filter By Category
     */
    filterProductsByCategory(event) {},

    deleteProduct(product)
    {
      this.$swal({
        icon: "warning",
        title: "Are you sure you want to delete this product?",
        html: "<b>Product name</b>: " + product.title + " <br /> <b>SKU</b>: " + product.sku,
        showCancelButton: true,
        showCloseButton: true
      }).then(result => {
        if(result.isConfirmed)
        {
          axios.post('/products/' + product.slug + '/delete', {
            _method: "DELETE"
          }).then(res => {
            this.$swal(res.data.message)
            
            let index = this.products.indexOf(product)
            if(index != -1)
            {
              this.products.splice(index, 1);
            }
          }).catch(error => {
            this.$swal({
              title: "Something went wrong!",
              text: "Couldn't delete the product.",
              icon: 'error'
            })
          });
        }
      });
    },
    searchByName: _.debounce(vm => {
      vm.getAllProducts(vm.action);
    }, 500)
  },

  mounted() {
    this.getAllProducts(this.action);
    this.fetchCategories();
  },
  watch: {
    search(newValue){
      if(newValue.length > 3 || newValue.length == 0)
      {
        this.searchByName(this);
      }
    },
    itemsPerPage() {
      this.getAllProducts(this.action);
    },
    category() {
      this.getAllProducts(this.action);
    },
  },
};
</script>
<style>
</style>