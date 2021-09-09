<template>
  <div class="row">
    <div class="col-md-4">
      <create-component @change="onAddNewBrand"></create-component>
    </div>
    <div class="col-md-7 offset-md-1 p-3">
      <form>
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <select class="form-control" @change="onChangeHandler($event)">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
              </select>
            </div>
          </div>
          <div class="col-md-4 offset-md-6">
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
                <th>Image</th>
                <th>Brand</th>
                <th>Description</th>
                <th>Created At</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(brand, key) in brands" :key="key">
                <td>
                  <img
                    :src="imgPath + brand.icon"
                    :alt="brand.title"
                    width="30"
                  />
                </td>
                <td>
                  {{ brand.title }}
                  <div class="pt-1">
                    <button class="btn text-primary pl-0">Edit</button>
                    <button class="btn text-primary pl-0">Delete</button>
                  </div>
                </td>
                <td>{{ brand.description }}</td>
                <td>{{ brand.created }}</td>
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
  </div>
</template>
<script>
import axios from "axios";
import CreateComponent from "./CreateComponent.vue";
export default {
  components: { CreateComponent },
  data() {
    return {
      items: 5,
      brands: [],
      links: [],
      imgPath: "../../../../storage/",
      link: "brands",
    };
  },
  methods: {
    getBrands(getBrands) {
      axios
        .post(getBrands, {
          item: this.items,
        })
        .then((res) => {
          this.brands = res.data.data;
          this.links = res.data.meta.links;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    onChangeHandler(event) {
      this.items = event.target.value;
      this.getBrands(this.link);
    },

    onAddNewBrand() {
      this.getBrands(this.link);
    },

    getLink(link) {
      this.getBrands(link);
    },
  },
  created() {
    this.getBrands(this.link);
  },
};
</script>