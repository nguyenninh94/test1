<template>
   <li>
       <a href="/notifications">
          Unread Notifications <span class="badge">{{all_not_count}}</span>
       </a>
   </li>
</template>

<script>
    export default {
        mounted() {
           this.get_unread()
        },

        methods: {
           get_unread() {
              this.$http.get('/get-unread').then(function(nots) {
                  nots.body.forEach((not) => {
                      this.$store.commit('add_not', not)
                  })
              })
           }
        },

        computed: {
           all_not_count() {
              return this.$store.getters.all_nots_count
           }
        }
    }          
