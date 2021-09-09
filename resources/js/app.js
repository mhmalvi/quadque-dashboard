import { createApp } from "vue";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import ProductComponent from "./components/products/ProductComponent.vue";

//Category
import CategoryComponent from "./components/category/CategoryComponent.vue";
import UpdateComponent from "./components/category/UpdateComponent.vue";

//Brand
import BrandsComponent from "./components/brands/BrandsComponent.vue";

const app = createApp({});
app.use(VueSweetalert2);

/**
 * mount your components here
 */
app.component("product-component", ProductComponent);
app.component("category-component", CategoryComponent);
app.component("update-category", UpdateComponent);
app.component("brands-component", BrandsComponent);

app.mount("#wrapper");

require("./bootstrap");

require("alpinejs");
