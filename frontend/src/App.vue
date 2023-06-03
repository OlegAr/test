<template>
  <div id="app">
    <h1>Vue Site</h1>
    <api-handler />
  </div>
</template>

<script>
import ApiHandler from "./components/ApiHandler.vue";

export default {
  components: {
    ApiHandler,
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
