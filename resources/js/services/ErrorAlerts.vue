<template>
  <div>
    <p class="mb-1" v-for="(error, index) in errors" :key="index">
      {{ error }}
      <a
        href="javascript:void(0)"
        @click.prevent="removeAlert(index)"
        class="text-danger"
      >
        <i class="bi bi-x-circle-fill"></i>
      </a>
    </p>
  </div>
</template>
<script>
export default {
  props: ["alerts"],
  data() {
    return {
      errors: this.alerts,
    };
  },
  methods: {
    removeAlert(index) {
      this.errors.splice(index, 1);
    },
  },
};
</script>