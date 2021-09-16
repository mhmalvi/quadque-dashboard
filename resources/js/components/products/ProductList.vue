<template>
  <div>
    <form>
      <div class="row">
        <div class="col-md-1">
          <div class="form-group">
            <select class="form-control" @change="onChangeHandler($event)">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
            </select>
          </div>
        </div>
        <div class="col-md-3 offset-md-8">
          <div class="form-group">
            <input type="text" class="form-control" />
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
                  <a href="javascript:void(0)" class="text-primary pr-2"
                    >Edit</a
                  >
                  <a href="javascript:void(0)" class="text-primary pr-2"
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
export default {
  data() {
    return {
      isLoading: false,
      products: [],
      items: 5,
      links: [],
      getProducts: "products/all",
      imgPath: "../../../../storage/thumbnails/",
    };
  },
  methods: {
    async getAllProducts(actionLink) {
      await axios
        .post(
          actionLink,
          { items: this.items },
          {
            onUploadProgress: () => {
              this.isLoading = !this.isLoading;
            },
          }
        )
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
    onChangeHandler(event) {
      this.items = event.target.value;
      this.getAllProducts(this.getProducts);
    },
  },

  mounted() {
    this.getAllProducts(this.getProducts);
  },
};
</script>
<style>
</style>