<template>
  <div>
    <h1>Create a New Subscriber</h1>
    <form @submit.prevent="createSubscriber">
      <div>
        <label for="subscriber_name">Subscriber Name:</label>
        <input type="text" id="subscriber_name" v-model="subscriber.subscriber_name" required>
      </div>
      <div>
        <label for="subscription_tier">Subscription Tier:</label>
        <input type="number" id="subscription_tier" v-model="subscriber.subscription_tier" required>
      </div>
      <div>
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" v-model="subscriber.user_id" required>
      </div>
      <button type="submit">Create Subscriber</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      subscriber: {
        subscriber_name: "",
        subscription_tier: null,
        user_id: null,
      },
    };
  },
  methods: {
    createSubscriber() {
      // Send a POST request to your API endpoint to create the subscriber
      // You can use axios or your preferred HTTP library here
      axios.post('/api/subscribers', this.subscriber)
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
