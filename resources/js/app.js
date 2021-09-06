import { createApp } from "vue";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import CategoryComponent from "./components/CategoryComponent.vue";

const app = createApp({});
app.use(VueSweetalert2);

/**
 * mount your components here
 */
app.component("category-component", CategoryComponent);

app.mount("#wrapper");

require("./bootstrap");

require("alpinejs");
