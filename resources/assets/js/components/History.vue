<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 marginTop30">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>History</h4></div>
                    <div class="panel-body">
                      <router-link v-bind:to="{name:'homepage'}" class="marginR20"><i class="fa fa-home"></i> Home</router-link>
                      <router-link v-bind:to="{name:'history'}"> <i class="fa fa-history" aria-hidden="true"></i> History</router-link>


                      <div class="col-md-12">
                        <table class="table table-striped marginTop30">
                          <thead>
                            <tr>
                              <td>Vehicle</td>
                              <td>Plate</td>
                              <td>Subtotal</td>
                              <td>Discount</td>
                              <td>Taxes</td>
                              <td>Total</td>

                            </tr>
                          </thead>
                          <tbody>
                          <tr v-for="item in history">
                            <td>{{item.car_type}}</td>
                            <td>{{item.plate}}</td>
                            <td>{{item.subtotal}}</td>
                            <td>{{item.loyalty_discount}}</td>
                            <td>{{item.tax}}</td>
                            <td>{{item.total}}</td>

                          </tr>
                        </tbody>
                        </table>
                      </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

    //CarWash Vue single page App
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data:function(){
          return {
            history:[]
          }
        },
        mounted:
          function(){
            var vm=this;
            axios.get(`/history/`)
            .then(function(response){
              vm.history = response.data;
            });
          }

    }
</script>


<style scoped="">
.marginTop30{margin-top: 30px;}
.marginR20{margin-right: 20px;}

</style>
