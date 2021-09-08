<template>
  <div class="card card-body">
    <div class="row">
      <div class="col-md-4">
        <h5>Basic Information</h5>
        <small>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum vero
          illo optio consectetur corrupti, laudantium
        </small>
      </div>
      <div class="col-md-7 offset-md-1">
        <div class="form-group">
          <label for="sku">Product SKU</label>
          <input type="text" id="sku" class="form-control" />
        </div>
        <div class="form-group">
          <label for="title">Product Title</label>
          <input type="text" id="title" class="form-control" />
        </div>
        <div class="form-group">
          <label for="slug">Product Slug</label>
          <input type="text" id="slug" class="form-control" />
          <small
            >The “slug” is the URL-friendly version of the name. It is usually
            all lowercase and contains only letters, numbers, and
            hyphens.</small
          >
        </div>
        <div class="form-group">
          <label for="category">Product Category</label>
          <select id="category" class="form-control">
            <option value="">Category</option>
          </select>
        </div>
        <div class="form-group">
          <label for="brand">Product Brand</label>
          <select id="brand" class="form-control">
            <option value="">brand</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="card card-body">
    <div class="row">
      <div class="col-md-4">
        <h5>Additional Informations</h5>
        <small>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa
          molestiae ea tenetur suscipit repudiandae illum.
        </small>
      </div>
      <div class="col-md-7 offset-md-1">
        <div class="form-group">
          <label for="r_price">Regular Price</label>
          <input type="number" id="r_price" class="form-control" />
        </div>
        <div class="row form-group">
          <div class="col-md-8">
            <label for="d_price">Discount</label>
            <input type="number" id="d_price" class="form-control" />
          </div>
          <div class="col-md-4">
            <label for="d_type">Discount Type</label>
            <select id="d_type" class="form-control">
              <option value="flat">Flat</option>
              <option value="percent">Percent</option>
            </select>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-md-8">
            <label for="unit">Minimum Sale Unit</label>
            <input type="number" id="unit" class="form-control" />
          </div>
          <div class="col-md-4">
            <label for="u_type">Unit Type</label>
            <select id="u_type" class="form-control">
              <option value="">Sale units</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card card-body">
    <h5>Product Details</h5>
    <small>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa molestiae ea
      tenetur suscipit repudiandae illum. neque?
    </small>
    <div class="form-group pt-4">
      <QuillEditor theme="snow" />
    </div>
  </div>

  <div class="card card-body">
    <div class="row">
      <div class="col-md-4">
        <h5>Product SEO Informations</h5>
        <small>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis,
          inventore explicabo.
        </small>
      </div>
      <div class="col-md-7 offset-md-1">
        <div class="form-group">
          <label for="keywords">Meta Keywords</label>
          <input type="text" id="keywords" class="form-control" />
          <small>
            seo keywords should be comma seperated and not more than five
            keywords. EX: shirt, jeans ...
          </small>
        </div>
        <div class="form-group">
          <label for="tags">Meta Tags</label>
          <input type="text" id="tags" class="form-control" />
          <small>
            seo tags should be comma seperated and not more than five tags. EX:
            shirt, jeans ...
          </small>
        </div>
        <div class="form-group">
          <label for="metaDescription">Meta Description</label>
          <textarea
            id="metaDescription"
            cols="3"
            style="resize: none"
            class="form-control"
          ></textarea>
          <small> meta description should not exceed 50 words </small>
        </div>
      </div>
    </div>
  </div>

  <div class="card card-body">
    <div class="row">
      <div class="col-md-4">
        <h5>Product Images</h5>
        <small
          >Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil
          accusantium consequuntur ullam voluptatum praesentium vero.</small
        >
      </div>
      <div class="col-md-7 offset-md-1">
        <div class="form-group">
          <label for="thumbnail">Product Thumbnail</label>
          <input type="file" id="thumbnail" class="form-control" />
        </div>
        <div class="form-group">
          <label for="gallary">Gallary Images</label>
          <input type="file" id="gallary" class="form-control" multiple />
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between pb-3">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="draft" />
      <label class="custom-control-label" for="draft">Save as draft</label>
    </div>

    <button type="button" class="btn btn-sm btn-primary">
      Add new product
    </button>
  </div>
</template>
<script>
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
export default {
  components: { QuillEditor },
};
</script>
<style>
.ql-container {
  height: 450px !important;
}
</style>