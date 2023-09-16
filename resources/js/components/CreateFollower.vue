<template>
  <div>
    <h1>Create a New Follower</h1>
    <form @submit.prevent="createFollower">
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="followerData.name" required />
      </div>
      <div>
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" v-model="followerData.user_id" required />
      </div>
      <div>
        <button type="submit">Create Follower</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      followerData: {
        name: '',
        user_id: null,
      },
    };
  },
  methods: {
    createFollower() {
      axios
        .post('/api/followers', this.followerData)
        .then((response) => {
          const createdFollower = response.data.follower;
          // Handle the response as needed, e.g., display a success message or redirect to a different page.
          console.log('Follower created:', createdFollower);
        })
        .catch((error) => {
          // Handle any errors from the API request, e.g., display error messages.
          console.error('Error creating follower:', error);
        });
    },
  },
};
</script>
