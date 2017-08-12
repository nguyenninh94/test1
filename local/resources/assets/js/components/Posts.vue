<template>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    Create a post
                </div>
                <div class="panel-body">
                    <span>Content</span>
                    <textarea v-model="content" cols="30" rows="10" class="form-control"></textarea>
                    <br>
                    <button class="btn btn-success pull-right" @click="create_post" :disabled="not_working">Create a post</button>
                </div>
            </div>
        </div>
      </div> 
    </div>
</template>

<script>
    export default {
         data() {
            return {
               post: {},
               content: '',
               not_working: true
            }
         },

         created() {
            this.fetchContent()
         },

         methods: {
            fetchContent() {
               this.$http.get('/post').then(function(response) {
                   this.post = response.data
               })
            },

            create_post() {
               this.$http.post('/post', { content: this.content}).then(function(response) {
                   this.content = ''
                   noty({
                      type: 'success',
                      layout: 'topRight',
                      text: 'Create Post Successfully'
                   })
                   console.log(response)
               })
            }
         },

         watch: {
            content() {
               if(this.content.length > 0)
                   this.not_working = false
               else
                   this.not_working = true    
            }
         }
    }
</script>