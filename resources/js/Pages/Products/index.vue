<template>
  <div>
    <h1>Products Dashboard</h1>
    <div v-if="products.length">
      <ul>
        <li v-for="product in products" :key="product.id">
          <h2>{{ product.name }}</h2>
          <p>{{ product.description }}</p>
          <p>Price: ${{ product.price }}</p>
        </li>
      </ul>
    </div>
    <div v-else>
      <p>No products available.</p>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  products: {
    type: Array,
    required: true
  }
});
</script>

<style scoped>
h1 {
  font-size: 2em;
  margin-bottom: 0.5em;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  border: 1px solid #ccc;
  padding: 1em;
  margin-bottom: 0.5em;
}

h2 {
  margin: 0;
  font-size: 1.5em;
}

p {
  margin: 0.5em 0;
}
</style>
