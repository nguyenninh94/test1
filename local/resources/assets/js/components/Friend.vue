<template>
    <div>
            <p class="text-center" v-if="loading">
                Loading...
            </p>
            <p class="text-center" v-else-if="!loading">
                <button class="btn btn-primary" v-if="status == 0" @click="add_friend">Add Friend</button>
                <button class="btn btn-primary"  v-if="status == 'pending'" @click="accept_friend">Accept Friend</button>
                <span class="text-center" v-if="status == 'waiting'">Waiting for friend</span>
                <span class="text-center" v-if="status == 'friends'">Friends</span>
            </p>    
    </div>
</template>

<script>
    export default {
        mounted() {
            this.$http.get('/check-relationship-status/'+this.profile_user_id).then(function(response) {
                  this.status = response.body.status;
                  this.loading = false;
            });
        },

        props: ['profile_user_id'],

        data() {
           return {
              status: '',
              loading: true
           }
        },

        methods: {
           add_friend() {
              this.loading = true
              this.$http.get('/add-friend/' + this.profile_user_id).then(function(response) {
                 if(response.body == 1)
                    this.status = 'waiting'
                    noty({
                       type: 'success',
                       layout: 'bottomLeft',
                       text: 'Friend request have been sent'
                    })
                    this.loading = false
              });
           },

           accept_friend() {
              this.loading = true
              this.$http.get('/accept-friend/' + this.profile_user_id).then(function(response) {
                 if(response.body == 1)
                    this.status = 'friends'
                    noty({
                       type: 'success',
                       layout: 'bottomLeft',
                       text: 'You are now friend'
                    })
                    this.loading = false
              });
           }
        }
    }
</script>
