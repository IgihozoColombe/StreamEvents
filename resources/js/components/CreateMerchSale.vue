<template>
  <div>
    <h1>Create a New Merchandise Sale</h1>
    <form @submit.prevent="createMerchSale">
      <div>
        <label for="amount">Amount:</label>
        <input type="number" id="amount" v-model="merchSale.amount" required>
      </div>
      <div>
        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" v-model="merchSale.item_name" required>
      </div>
      <div>
        <label for="price">Price:</label>
        <input type="number" id="price" v-model="merchSale.price" required>
      </div>
      <div>
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" v-model="merchSale.user_id" required>
      </div>
      <button type="submit">Create Merchandise Sale</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      merchSale: {
        amount: null,
        item_name: "",
        price: null,
        user_id: null,
      },
    };
  },
  methods: {
    createMerchSale() {
      // Send a POST request to your API endpoint to create the merchandise sale
      // You can use axios or your preferred HTTP library here
      axios.post('/api/merchandise-sales', this.merchSale)
        .then((response) => {
          // Handle success, e.g., show a success message
          console.log(response.data.message);
        })
        .catch((error) => {
          // Handle errors, e.g., show error messages
          console.error(error);
        });
    },
  },
};
</script>
