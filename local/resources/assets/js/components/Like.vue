<template>
   <div>
      <hr>
      <p class="text-center" v-for="like in post.likes">
         <img :src="like.user.avatar" alt="" with="40px" height="40px" class="avatar-like">
      </p>
      <hr>
      <button class="btn btn-primary" v-if="!auth_user_likes_post" @click="like">
          Like
      </button>
      <button class="btn btn-danger" v-else @click="dislike()">
          Dislike
      </button>
   </div>
</template>

<script>
   export default {
      mounted() {

      },

      props: ['id'], 

      computed: {
         likers() {
            var likers = []

            this.post.likes.forEach((like) => {
               likers.push(like.user.id)
            })

            return likers
         },

         auth_user_likes_post() {
            var check_index = this.likers.indexOf(
               this.$store.state.auth_user.id
            )

            if(check_index === -1)
               return false
            else
               return true   
         },

         post() {
            return this.$store.state.posts.find((post) => {
               return post.id === this.id
            })
         }
      },

      methods: {
         like() {
            this.$http.get('/like/' + this.id).then((response) => {
                this.$store.commit('update_post_likes', {
                    id: this.id,
                    like: response.body
                })

                noty({
                   type: 'success',
                   layout: 'bottomLeft',
                   text: 'You liked this'
                })
            })
         },

         dislike() {
            this.$http.get('/dislike/' + this.id).then((response) => {
                this.$store.commit('dislike_post', {
                    post_id: this.id,
                    like_id: response.body
                })

                noty({
                   type: 'success',
                   layout: 'bottomLeft',
                   text: 'You disliked this'
                })
            })
         }
      }
   }
</script>

<style>
   .avatar-like{
      border-radius:50px
   }
</style>