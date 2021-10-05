<template>
  <div>
    <span>
      Product attributes for your store can be managed here. You can add, edit
      &amp; delete products attributes.
    </span>

    <h6 class="pt-3 text-primary">Add new attribute</h6>

    <form @submit.prevent="formSubmitHandler">
      <div class="form-group">
        <label for="name">Name <small class="text-danger">*</small></label>
        <input type="text" id="name" class="form-control" v-model="name" />
        <small>The name is how it appears on your site.</small>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          id="description"
          rows="5"
          style="resize: none"
          class="form-control"
          v-model="description"
        ></textarea>
      </div>

      <button type="submit" class="btn btn-sm btn-primary" :disabled="!isValid">
        {{ btnText }}
      </button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      name: "",
      description: "",
      btnText: "Add new attribute",
      isLoading: false,
    };
  },
  methods: {
    formSubmitHandler() {
      this.btnText = "Adding new attribute ...";
      this.isLoading = true;

      let formData = new FormData();
      formData.append("name", this.name);
      formData.append("description", this.description);

      axios
        .post("attributes/store", formData)
        .then((res) => {
          this.resetForm();
          this.$emit("addedNew");
        })
        .catch((error) => {
          console.log(error);
        });
    },

    resetForm() {
      this.name = "";
      this.description = "";
      this.btnText = "Add new attribute";
      this.isLoading = false;
    },
  },

  computed: {
    isValid() {
      return this.name && !this.isLoading;
    },
  },
};
</script>