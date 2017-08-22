<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 marginTop30">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>History</h4></div>
                    <div class="panel-body">
                      <router-link v-bind:to="{name:'homepage'}" class="marginR20"><i class="fa fa-home"></i> Home</router-link>
                      <router-link v-bind:to="{name:'history'}"> <i class="fa fa-history" aria-hidden="true"></i> History</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //CarWash Vue single page App
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data:function(){
          return {

          }
        }
    }
</script>


<style scoped="">
.marginTop30{margin-top: 30px;}
.marginR20{margin-right: 20px;}

</style>
