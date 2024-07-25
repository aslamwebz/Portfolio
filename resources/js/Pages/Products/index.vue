<template>
  <div class="container">
    <header class="header">
      <h1>Products Dashboard</h1>
    </header>
    <section class="hero">
      <h2>Welcome to Our Product Showcase</h2>
    </section>
    <section class="services">
      <h2>Our Services</h2>
      <p>We offer a wide range of services to meet your needs.</p>
    </section>
    <section class="products">
      <h2>Products</h2>
      <div v-if="products.length">
        <ul>
          <li v-for="product in products" :key="product.id">
            <h3>{{ product.name }}</h3>
            <p>{{ product.description }}</p>
            <p>Price: ${{ product.price }}</p>
          </li>
        </ul>
      </div>
      <div v-else>
        <p>No products available.</p>
      </div>
    </section>
    <footer class="footer">
      <p>&copy; 2024 Your Company. All rights reserved.</p>
    </footer>
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
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.header {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
}

.hero {
  background-color: #f4f4f4;
  padding: 50px 20px;
  text-align: center;
}

.services {
  background-color: #fff;
  padding: 50px 20px;
  text-align: center;
}

.products {
  background-color: #f4f4f4;
  padding: 50px 20px;
}

.footer {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
}

h1 {
  font-size: 2.5em;
  margin-bottom: 0.5em;
}

h2 {
  font-size: 2em;
  margin-bottom: 0.5em;
}

h3 {
  font-size: 1.5em;
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

p {
  margin: 0.5em 0;
}
</style>
