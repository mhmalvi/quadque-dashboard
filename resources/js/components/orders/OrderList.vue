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
        <div class="col-md-2 offset-md-9">
          <div class="form-group">
            <input type="text" class="form-control" v-model="search" />
          </div>
        </div>
      </div>
    </form>
    <div class="qa-dt">
      <div class="card qa-dt-inner">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead class="thead-light">
                <tr>
                  <th>Order</th>
                  <th>Payment Status</th>
                  <th>Order Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody v-if="isLoading">
                <tr>
                  <td colspan="3">
                    <no-item-found name="data" />
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr v-for="item in orders" :key="item.id">
                  <td>
                    {{ item.order_no }}
                  </td>
                  <td>
                    <b>{{ item.payment_status.toUpperCase() }}</b>
                  </td>
                  <td>
                    <b>{{ item.order_status.toUpperCase() }}</b>
                  </td>
                  <td>
                    <a
                      :href="'orders/view/' + item.order_no"
                      class="btn btn-sm btn-primary"
                      >View</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
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
</template>
<script>
import axios from "axios";
import _ from "lodash";
import NoItemFound from "../NoItemFound.vue";

export default {
  components: { NoItemFound },
  data() {
    return {
      isLoading: false,
      orders: [],
      itemsPerPage: 5,
      links: [],
      action: "orders/get",
      imgPath: "../../../../storage/thumbnails/",
      categories: [],
      search: "",
      category: "",
    };
  },
  methods: {
    async gettAllOrders(actionLink) {
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
          this.orders = res.data.data;
          this.links = res.data.meta.links;
          this.isLoading = !this.isLoading;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    getLink(link) {
      this.gettAllOrders(link);
    },
    searchByName: _.debounce((vm) => {
      vm.gettAllOrders(vm.action);
    }, 500),
  },

  mounted() {
    this.gettAllOrders(this.action);
  },
  watch: {
    search(newValue) {
      if (newValue.length > 2 || newValue.length == 0) {
        this.searchByName(this);
      }
    },
    itemsPerPage() {
      this.gettAllOrders(this.action);
    },
  },
};
</script>
<style>
</style>