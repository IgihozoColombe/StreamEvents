<template>
  <div>
    <h1>Welcome to Your Dashboard</h1>

    <!-- Display Revenue and Followers -->
    <div>
      <h2>Statistics</h2>
      <div class="statistics">
   

<div class="stat-box" v-if="totalMerchSales !== null">
    <div class="stat-label">Total Merchandise Sales (Last 30 Days)</div>
    <div class="stat-value">$ {{ totalMerchSales }}</div>
</div>


    <!-- Display Top 3 Selling Items -->
  

        <div class="stat-box">
          <div class="stat-label">Top Selling Items (Last 30 Days)</div>
          <div class="stat-value">  <ol>
        <li v-for="(item, index) in topSellingItems" :key="index">{{ item.item_name }} - {{ item.totalSales }} sold</li>
      </ol></div>
        </div>

        <div class="stat-box">
          <div class="stat-label">Total Followers Gained (Last 30 Days)</div>
          <div class="stat-value">{{ totalFollowersGained }}</div>
        </div>
      </div>
    </div>


    <!-- Display Notifications -->
    <div>
      <h2>Notifications</h2>
      <ul>
        <!-- Display Unread Notifications -->
        <li v-for="notification in unreadNotifications" :key="notification.id" class="unread-notification">
          {{ notification.message }}
          <button @click="markNotificationAsRead(notification)">Mark as Read</button>
        </li>

           <!-- Display Unread Follower Notifications -->
        <li
        v-for="follower in followers"
        :key="follower.id"
        :class="{
          'unread-notification': !follower.is_read,
          'donation-notification-clicked': follower.clicked
        }"
         @click="markFollowerNotificationAsRead(follower)"
      >
        {{ follower.name }} followed you!
      </li>

      <!-- Display Unread Donation Notifications -->
      <li
        v-for="donation in donations"
        :key="donation.id"
        :class="{ 'unread-notification': !donation.is_read, 'donation-notification-clicked': donation.clicked }"
        @click="markDonationNotificationAsRead(donation)"
      >
        {{ donation.amount }} donated!
      </li>
         <!-- Display Subscribers -->
        <li v-for="subscriber in subscribers" :key="subscriber.id" :class="{ 'unread-notification': !subscriber.is_read, 'donation-notification-clicked': subscriber.clicked  }"
            @click="markSubscriberNotificationAsRead(subscriber)">
          {{ subscriber.subscriber_name }} subscribed!
          </li>
      
    <li v-for="sale in merchandiseSales" :key="sale.id" :class="{ 'unread-notification': !sale.is_read, 'donation-notification-clicked': sale.clicked }"
   @click="markMerchandiseSaleAsRead(sale)">
    {{ sale.item_name }} sold!
    </li>


        <!-- Display Read Notifications -->
        <li v-for="notification in readNotifications" :key="notification.id" class="read-notification">
          {{ notification.message }}
        </li>
      </ul>
         <infinite-loading :on-infinite="loadMoreNotifications" spinner="circles" ref="infiniteLoading">
            <div slot="no-more">No more notifications</div>
        </infinite-loading>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import InfiniteLoading from 'vue-infinite-loading';

export default {
  data() {
    return {
    followers: [],
      subscribers: [],
      donations: [],
      merchandiseSales: [],
      unreadNotifications: [],
      readNotifications: [],
      totalDonations: 0,
      totalSubscriptions: 0,
      totalMerchSales: 0,
      totalFollowersGained: 0,
      topSellingItems: [],
        visibleNotifications: [],
            currentPage: 1,
            perPage: 100,
      
    };
  },
  created() {
    // Fetch followers, notifications, revenue, and top selling items from your backend API
     this.fetchFollowers();
    this.fetchSubscribers();
    this.fetchDonations();
    this.fetchMerchandiseSales();
    this.fetchNotifications();
    this.fetchRevenue();
    this.fetchTopSellingItems();
    this.fetchTotalMerchandiseSales();
  },
  methods: {
    fetchFollowers() {
      // Fetch followers from your backend API
      axios.get('/api/followers').then((response) => {
        this.followers = response.data;
      });
    },
       fetchSubscribers() {
      // Fetch subscribers from your backend API
      axios.get('/api/subscribers').then((response) => {
        this.subscribers = response.data;
      });
    },
    fetchDonations() {
      // Fetch donations from your backend API
      axios.get('/api/donations').then((response) => {
        this.donations = response.data;
      });
    },
    fetchMerchandiseSales() {
      // Fetch merchandise sales from your backend API
      axios.get('/api/merchandise-sales').then((response) => {
        this.merchandiseSales = response.data;
      });
    },
    fetchNotifications() {
    // Fetch notifications from your backend API
    axios.get('/api/notifications').then((response) => {
      this.notifications = response.data.notifications;
    });
  },
     fetchRevenue() {
    // Fetch revenue data from your backend API (dashboard-data route)
    axios.get('/api/dashboard-data').then((response) => {
      this.totalDonations = response.data.totalDonations;
      this.totalSubscriptions = response.data.totalSubscriptions;
      this.totalMerchSales = response.data.totalMerchSales;
      this.totalFollowersGained = response.data.totalFollowersGained;
    });
  },

  fetchTopSellingItems() {
    // Fetch the top selling items from your backend API (dashboard-data route)
    axios.get('/api/dashboard-data').then((response) => {
      this.topSellingItems = response.data.topSellingItems;
    });
    
  }, 
     markFollowerNotificationAsRead(follower) {
      if (!follower.is_read) {
        // Send a request to your backend to mark the follower notification as read
        axios.put(`/api/followers/${follower.id}/mark-as-read`).then(() => {
          // Update the follower notification status in the component's data
          const index = this.followers.findIndex((f) => f.id === follower.id);
          if (index !== -1) {
            this.followers[index].is_read = true;
          }
        });
      }
    },
   markSubscriberNotificationAsRead(subscriber) {
      // Send a request to your backend to mark the subscriber notification as read
      axios.put(`/api/subscribers/${subscriber.id}/mark-as-read`).then(() => {
        // Update the subscriber notification status in the component's data
        const index = this.subscribers.findIndex((s) => s.id === subscriber.id);
        if (index !== -1) {
          this.subscribers[index].is_read = true;
        }
      });
    },
    markDonationNotificationAsRead(donation) {
      // Send a request to your backend to mark the donation notification as read
      axios.put(`/api/donations/${donation.id}/mark-as-read`).then(() => {
        // Update the donation notification status in the component's data
        const index = this.donations.findIndex((d) => d.id === donation.id);
        if (index !== -1) {
          this.donations[index].is_read = true;
        }
      });
    },
    
markMerchandiseSaleAsRead(sale) {
  // Send a request to your backend to mark the sale notification as read
  axios.put(`/api/sale/${sale.id}/mark-as-read`).then(() => {
    // Update the sale notification status in the component's data
    const index = this.merchandiseSales.findIndex((d) => d.id === sale.id);
    if (index !== -1) {
      this.merchandiseSales[index].is_read = true;
    }
  });
},


fetchTotalMerchandiseSales() {
    axios.get('/api/dashboard/total-merchandise-sales').then((response) => {
        console.log(response.data); // Log the response data
        this.totalMerchSales = response.data.totalMerchandiseSales;
    }).catch((error) => {
        console.error(error); // Log any errors
    });
},

   loadMoreNotifications() {
            // Fetch more notifications from your backend API
            axios.get(`/api/notifications?page=${this.currentPage}&perPage=${this.perPage}`).then((response) => {
                const newNotifications = response.data.notifications;

                // Append the new notifications to the visibleNotifications array
                this.visibleNotifications = this.visibleNotifications.concat(newNotifications);

                // Increment the current page number
                this.currentPage += 1;

                // Check if there are more notifications to load
                if (newNotifications.length === 0) {
                    this.$refs.infiniteLoading.complete();
                } else {
                    this.$refs.infiniteLoading.loaded();
                }
            });
            },

      markNotificationAsRead(notification) {
    // Send a request to your backend to mark the notification as read
    axios.put(`/api/notifications/${notification.id}/mark-as-read`).then(() => {
      // Update the notification status in the component's data
      const index = this.notifications.findIndex((n) => n.id === notification.id);
      if (index !== -1) {
        this.notifications[index].is_read = true;
      }
    });
  },
  },
};

</script>

<style scoped>
/* Add your CSS styles here */
.statistics {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}

.stat-box {
  flex-basis: 24%;
  padding: 10px;
  border: 1px solid #ddd;
  margin: 5px;
  background-color: #f5f5f5;
  text-align: center;
}

.unread-notification {
  background-color: #f2dede;
  padding: 8px;
  margin: 4px;
  border: 1px solid #ebccd1;
  cursor: pointer; /* Add cursor pointer for better UX */
}

.read-notification {
  background-color: #f5f5f5;
  padding: 8px;
  margin: 4px;
  border: 1px solid #ddd;
  cursor: pointer; /* Add cursor pointer for better UX */
}

.follower-notification {
  background-color: #dff0d8;
  padding: 8px;
  margin: 4px;
  border: 1px solid #d6e9c6;
}

.follower-notification-clicked {
  background-color: #dff0d8; /* Gray background color for follower notifications */
  padding: 8px;
  margin: 4px;
  border: 1px solid #d6e9c6;
}

/* New class for read donation notifications */
.donation-notification-clicked {
  background-color: #f5f5f5; /* Gray background color for donation notifications */
  padding: 8px;
  margin: 4px;
  border: 1px solid #ddd;
}

</style>
