<template>
  <div class="row">
    <div class="col-md-4">
      <create-component></create-component>
    </div>
    <div class="col-md-7 offset-md-1 p-3">
      <form>
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <select class="form-control">
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
            <tbody></tbody>
          </table>
        </div>
      </div>
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
      categories: [],
      links: [],
    };
  },
  methods: {},
};
</script>