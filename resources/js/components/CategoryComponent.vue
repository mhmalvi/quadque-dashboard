<template>
  <div class="row">
    <div class="col-md-4">
      <create-category @created="newCategory"></create-category>
    </div>
    <div class="col-md-7 offset-md-1 p-3">
      <div class="table-responsive">
        <table class="table mb-0">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Category</th>
              <th>Parent Category</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(category, key) in categories" :key="key">
              <th scope="row">{{ ++key }}</th>
              <td>
                {{ category.title }}

                <div class="pt-2">
                  <button class="btn text-primary">Edit</button>
                  <button class="btn text-primary">Delete</button>
                </div>
              </td>
              <td>{{ category.parent }}</td>
              <td>{{ category.created }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import CreateCategory from "./childs/CreateCategory.vue";
export default {
  components: { CreateCategory },
  data() {
    return {
      categories: [],
    };
  },
  methods: {
    async getData() {
      await axios
        .get("categories/all")
        .then((res) => {
          this.categories = res.data.data;

          console.log(this.categories);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    newCategory() {
      this.getData();
    },
  },
  created() {
    this.getData();
  },
};
</script>
<style>
</style>