<template>
   <div class="container">
       <div class="row">
          <div class="col-lg-8 col-lg-offset-2">
              <div class="panel panel-default" v-for="p in posts">
                  <div class="panel-heading">
                      <img :src="p.user.avatar" alt="" width="40px" height="40px" class="avatar_feed">
                      {{p.user.name}}
                      <span class="pull-right">
                        {{p.created_at}}
                      </span>
                  </div>

                  <div class="panel-body">
                      <p class="text-center">
                          {{p.content}}
                      </p>
                      <like :id="p.id"></like>
              </div>
          </div>
       </div>
   </div>
</template>

<script>
   import Like from './Like.vue'

   export default {
      mounted() {
         this.get_feed()
      },

      components: {
         Like
      },

      methods: {
         get_feed() {
            this.$http.get('/feed').then((response) =>{
                response.body.forEach((post) => {
                    this.$store.commit('add_post', post)
                })
            })
         }
      },

      computed: {
         posts() {
            return this.$store.getters.all_posts
         }
      }
   }
</script>

<style>
   .avatar_feed {
       border-radius:50px
   }
</style>