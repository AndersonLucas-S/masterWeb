<template>
  <v-app>
    <v-main>
      <ProductComponent/>
    </v-main>
  </v-app>
</template>

<script>
import ProductComponent from './components/ProductComponent.vue'

export default {
  name: 'App',

  components: {
    ProductComponent
  },

  data: () => ({
    //
  }),
}
</script>
