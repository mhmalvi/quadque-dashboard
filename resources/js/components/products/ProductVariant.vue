<template>
  <div>
    <div class="card card-body">
      <div class="row">
        <div class="col-md-4">
          <h5>Product variants</h5>
          <small>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa
            molestiae ea tenetur suscipit repudiandae illum.
          </small>
        </div>
        <div class="col-md-7 offset-md-1">
          <multiselect
            v-model="selected_attributes"
            :options="attributes"
            placeholder="Select Product Attributes"
            mode="tags"
            :search="true"
          />

          <div
            class="row py-2"
            v-for="(attribute, index) in selected_attributes"
            :key="index"
          >
            <div class="col-md-4">
              <label>{{ attribute }}</label>
            </div>
            <div class="col-md-8">
              <multiselect
                mode="tags"
                v-model="selected_children[attribute]"
                :options="children_data[attribute]"
              />
            </div>
          </div>

          <transition name="fade">
            <table
              class="table table-bordered mt-2"
              v-show="variants.length > 0"
            >
              <tbody v-for="(item, index) in variants" :key="index">
                <tr>
                  <td class="align-middle bg-light">
                    {{ item }}
                  </td>
                  <td class="p-0 align-middle">
                    <input
                      type="text"
                      class="form-control border-0"
                      v-model="variant_form[item].price"
                      placeholder="price"
                    />
                  </td>
                  <td class="p-0 align-middle">
                    <input
                      type="text"
                      class="form-control border-0"
                      v-model="variant_form[item].sku"
                      placeholder="sku"
                    />
                  </td>
                  <td class="p-0 align-middle">
                    <input
                      type="text"
                      class="form-control border-0"
                      v-model="variant_form[item].quantity"
                      placeholder="quantity"
                    />
                  </td>
                </tr>
              </tbody>
            </table>
          </transition>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Multiselect from "@vueform/multiselect";

export default {
  components: { Multiselect },
  data() {
    return {
      attributes: [],
      selected_attributes: [],
      children_data: {},
      selected_children: {},
      variants: [],
      variant_form: {},
    };
  },
  methods: {
    getAttributes() {
      axios
        .get("attributes/get")
        .then((res) => {
          this.attributes = [];
          res.data.data.forEach((item) => {
            this.attributes.push(item.title);
            item.children.data.forEach((child) => {
              if (this.children_data[item.title] == null) {
                this.children_data[item.title] = [];
              }
              this.children_data[item.title].push(child.title);
              this.selected_children[item.title] = [];
            });
          });
        })
        .catch((error) => {
          console.error(error);
        });
    },
    getVariants() {
      let first_keywords = [];
      let all_keywords = [];

      for (let key in this.selected_children) {
        let curr_children = this.selected_children[key];

        if (curr_children.length == 0) {
          continue;
        }
        if (first_keywords.length == 0) {
          first_keywords = curr_children;
        } else {
          if (all_keywords.length == 0) {
            first_keywords.forEach((first_keyword) => {
              curr_children.forEach((curr_child) => {
                all_keywords.push(first_keyword + "-" + curr_child);
              });
            });
          } else {
            let temp = all_keywords;
            all_keywords = [];
            temp.forEach((first_keyword) => {
              curr_children.forEach((curr_child) => {
                all_keywords.push(first_keyword + "-" + curr_child);
              });
            });
          }
        }
      }
      if (all_keywords.length == 0) {
        all_keywords = first_keywords;
      }

      // remove the fields in variant form which doesnt exist in variant keywords array
      for (let key in this.variant_form) {
        if (all_keywords.indexOf(key) == -1) {
          delete this.variant_form[key];
        }
      }

      all_keywords.forEach((keyword) => {
        if (this.variant_form[keyword] == null) {
          this.variant_form[keyword] = {
            price: "",
            sku: "",
            quantity: "",
          };
        }
      });
      return all_keywords;
    },
  },
  mounted() {
    this.getAttributes();
  },
  watch: {
    selected_attributes(newVal, oldVal) {
      for (let child_key in this.selected_children) {
        if (newVal.indexOf(child_key) == -1) {
          delete this.selected_children[child_key];
        }
      }
    },
    selected_children: {
      handler(newVal, oldVal) {
        let variants = this.getVariants();
        this.variants = variants;
      },
      deep: true,
    },
    variant_form: {
      handler(newVal, oldVal) {
        this.$emit("form_update", newVal);
      },
      deep: true,
    },
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>