<template>
  <v-app>
    <v-main>
      <v-container fluid class="background">
        <v-row justify="center" class="logo-row">
          <v-col cols="12">
            <v-img src="https://www.masterdaweb.com/images/logo-white-blue.png" class="logo"></v-img>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="8">
            <v-card class="product-card" v-for="product in products" :key="product.id">
              <v-card-title>{{ product.name }}</v-card-title>
              <v-card-text>
                {{ product.description }}
              </v-card-text>
              <v-card-actions>
                <v-btn color="primary" small @click="addToCart(product)">Adicionar ao Carrinho</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col cols="12" md="4">
            <v-card v-if="cartItems.length > 0" class="cart-card">
              <v-card-title>Seu Carrinho</v-card-title>
              <v-card-text>
                <v-list>
                  <v-list-item v-for="item in cartItems" :key="item.product.id">
                    <v-list-item-content>
                      <v-list-item-title>{{ item.product.name }}</v-list-item-title>
                      <v-list-item-subtitle>{{ item.product.description }}</v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-action>
                      <v-btn style="margin-top: 2%; margin-right: 2%;" rounded small color="primary" @click="decreaseQuantity(item)">
                        <v-icon small left>mdi-minus</v-icon>
                      </v-btn>
                      <span style="font-size: medium;">{{ item.quantity }}</span>
                      <v-btn style="margin-top: 2%; margin-left: 2%;" rounded small color="primary" @click="increaseQuantity(item)">
                        <v-icon small left>mdi-plus</v-icon>
                      </v-btn>
                    </v-list-item-action>
                  </v-list-item>
                </v-list>
              </v-card-text>
              <v-divider></v-divider>
              <v-card-actions>
                <v-btn color="#303f9f" class="checkout-button" outlined @click="checkout()">
                  <v-icon left>mdi-cart</v-icon>
                  Finalizar Compra
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>

 //modal sucesso
  <v-dialog v-model="successDialog" max-width="400">
    <v-card>
      <v-card-title class="success-dialog-title">Sucesso!</v-card-title>
      <v-card-text class="success-dialog-text">
        Seu pedido foi realizado com sucesso.
      </v-card-text>
      <v-card-actions>
        <v-btn color="success" text @click="successDialog = false">Fechar</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>

</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      cartItems: [],
      cartTotal: 0,
      successDialog: false,
    };
  },
  created() {
    this.fetchProducts();
  },
  methods: {
    fetchProducts() {
      axios.get('http://127.0.0.1:8000/api/products')
        .then(response => {
          this.products = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    addToCart(product) {
      const existingItem = this.cartItems.find(item => item.product.id === product.id);
      if (existingItem) {
        existingItem.quantity++;
      } else {
        const newItem = {
          product: product,
          quantity: 1,
        };
        this.cartItems.push(newItem);
      }
      this.calculateCartTotal();
    },
    removeFromCart(item) {
      const index = this.cartItems.indexOf(item);
      if (index > -1) {
        this.cartItems.splice(index, 1);
        this.calculateCartTotal();
      }
    },
    increaseQuantity(item) {
      item.quantity++;
      this.calculateCartTotal();
    },
    decreaseQuantity(item) {
      if (item.quantity > 1) {
        item.quantity--;
      } else {
        const index = this.cartItems.indexOf(item);
        if (index > -1) {
          this.cartItems.splice(index, 1);
        }
      }
      this.calculateCartTotal();
    },
    calculateCartTotal() {
      let total = 0;
      for (const item of this.cartItems) {
        total += item.product.price * item.quantity;
      }
      this.cartTotal = total;
    },
    checkout() {
      const order = {
        items: this.cartItems.map(item => ({
          id: item.product.id,
          name: item.product.name,
          quantity: item.quantity,
        })),
        total: this.cartTotal,
      };

      axios.post('http://127.0.0.1:8000/api/orders', order)
        .then(response => {
          console.log(response.data);
          this.cartItems = [];
          this.cartTotal = 0;
          this.showSuccessMessage();
        })
        .catch(error => {
          console.error(error);
        });
    },
    showSuccessMessage() {
      this.successDialog = true;
    },
  },
};
</script>

<style scoped>
.background {
  background: linear-gradient(#303f9f, rgb(255, 255, 255));
  padding: 1rem;
}

.product-card {
  margin-bottom: 1.5rem;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  padding: 1.5rem;
}

.cart-card {
  margin-bottom: 1.5rem;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.1);
  padding: 1.5rem;
  text-align: center;
}

.price {
  font-size: 1.2rem;
  margin-bottom: 0.5rem;
}

.total {
  font-size: 1.2rem;
  margin-top: 1rem;
  font-weight: bold;
}

.logo-row {
  margin-bottom: 2rem;
}

.logo {
  max-width: 300px;
  margin: 0 auto;
}

.checkout-button {
  width: 100%;
}

.success-dialog-title {
  background-color: #4caf50;
  color: white;
}

.success-dialog-text {
  color: #4caf50;
}

@media (min-width: 600px) {
  .product-card,
  .cart-card {
    width: 100%;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
  }
}
</style>
