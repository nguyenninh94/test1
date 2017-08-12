<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <input type="text" class="input-lg form-control" placeholder="you looking for?" v-model="query" @keyup="search()">
                <i class="icon-box"></i>
                <br>
                <div class="row" v-if="results.length">
                    <div class="text-center" v-for="user in results">
                        <img :src="user.avatar" alt="">
                        <h4 class="text-center">{{user.name}}</h4>
                        <h4 class="text-center">{{user.email}}</h4>
                    </div>
                </div>
                <div class="row" v-else>
                    <p class="text-center">No results</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var algoliasearch = require('algoliasearch');
    var client = algoliasearch('GQVK5BZEQI', '19080c743714c3c59e1f5496c4b9b1dc');
    var index = client.initIndex('users');

    export default {
        mounted() {
            
        },

        data() {
           return {
              query: '',
              results: []
           }
        },

        methods: {
            search() {
               index.search(this.query, (err, content) => {
                  this.results  = content.hits
                })
            }
        }
    }
</script>