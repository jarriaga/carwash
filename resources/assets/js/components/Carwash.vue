<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 marginTop30">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Carwash Dashboard</h4></div>
                    <div class="panel-body">

                      <div v-show="currentStep==1" class="step1">
                        <router-link v-bind:to="{name:'homepage'}" class="marginR20"><i class="fa fa-home"></i> Home</router-link>
                        <router-link v-bind:to="{name:'history'}"> <i class="fa fa-history" aria-hidden="true"></i> History</router-link>
                        <div class="col-md-12 text-center">
                          <h3> 1. Please select vehicle</h3>
                        </div>
                        <div class="col-md-6 col-xs-6 text-center">
                          <button class="btn btn-large btn-info btn-auto">
                            <h3>CAR</h3>
                            <img src="/images/car.png" class="img-button">
                          </button>
                        </div>
                        <div class="col-md-6 col-xs-6 text-center">
                          <button class="btn btn-large btn-info btn-auto">
                            <h3>TRUCK</h3>
                            <img src="/images/truck.png" class="img-button">
                          </button>
                        </div>
                      </div>





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
            rules:{
              washPrice:{
                car:5,
                truck:10
              }
            },
            // define step to show
            currentStep:1,
            // final object to save
            object:{
              vehicle:null,
              price:null,
              plate:null,
              mud:0,
              discount:0,
            }
          }
        }
    }
</script>


<style scoped="">
.marginTop30{margin-top: 30px;}
.marginR20{margin-right: 20px;}
.img-button{ width:80px;height: auto;margin-top:-32px}
.btn-auto{width:150px;}

</style>
