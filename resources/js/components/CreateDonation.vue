<template>
  <div>
    <h1>Create a New Donation</h1>
    <form @submit.prevent="createDonation">
      <div>
        <label for="amount">Amount:</label>
        <input type="number" id="amount" v-model="donation.amount" required>
      </div>
      <div>
        <label for="currency">Currency:</label>
        <input type="text" id="currency" v-model="donation.currency" required>
      </div>
      <div>
        <label for="donation_message">Message (Optional):</label>
        <textarea id="donation_message" v-model="donation.donation_message"></textarea>
      </div>
      <div>
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" v-model="donation.user_id" required>
      </div>
      <button type="submit">Create Donation</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      donation: {
        amount: null,
        currency: "",
        donation_message: "",
        user_id: null,
      },
    };
  },
  methods: {
    createDonation() {
      // Send a POST request to your API endpoint to create the donation
      // You can use axios or your preferred HTTP library here
      axios.post('/api/donations', this.donation)
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
