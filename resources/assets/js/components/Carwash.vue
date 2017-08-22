<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 marginTop30">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Carwash Dashboard</h4></div>
                    <div class="panel-body">

                      <div v-show="currentStep==1" class="step1">
                        {{reset}}
                        <router-link v-bind:to="{name:'homepage'}" class="marginR20"><i class="fa fa-home"></i> Home</router-link>
                        <router-link v-bind:to="{name:'history'}"> <i class="fa fa-history" aria-hidden="true"></i> History</router-link>
                        <div class="col-md-12 text-center">
                          <h3> Please select vehicle</h3>
                        </div>
                        <div class="col-md-6 col-xs-6 text-center">
                          <button class="btn btn-large btn-info btn-auto" v-on:click="setVehicle('car')">
                            <h3>CAR</h3>
                            <img src="/images/car.png" class="img-button" >
                          </button>
                        </div>
                        <div class="col-md-6 col-xs-6 text-center">
                          <button class="btn btn-large btn-info btn-auto" v-on:click="setVehicle('truck')">
                            <h3>TRUCK</h3>
                            <img src="/images/truck.png" class="img-button">
                          </button>
                        </div>
                      </div>

                      <div v-show="currentStep==2" class="step2 ">
                        <a href="#" v-on:click.prevent="currentStep=1"><i class="fa fa-arrow-left"></i> Back</a>

                        <div class="form-group marginTop30">
                            <h3 class="text-center">License plate</h3>
                          <div class="input-group">
                            <input type="text" class="form-control input-lg" v-model="object.plate" placeholder="Type car's license plate">
                            <span class="input-group-btn">
                              <button class="btn btn-success btn-lg"  v-on:click="searchPlate" type="button">
                                <i class="fa fa-search"></i> Submit</button>
                            </span>
                          </div><!-- /input-group -->
                          <p v-show="errors.plate"class="text-danger">Please insert license plate</p>
                        </div>
                      </div>

                      <div v-show="currentStep==3" class="step3 ">
                        <a href="#" v-on:click.prevent="currentStep=2"><i class="fa fa-arrow-left"></i> Back</a>
                        <div class="row" v-show="object.discount>0">
                          <div class="col-md-6 marginTop30">
                            <img src="/images/loyalty.png" class="img-loyalty img-responsive">
                          </div>
                          <div class="col-md-6 marginTop30">
                            <h3 class="text-center">Woohoo!<br>We have <strong>50% off</strong> for you</h3>
                          </div>
                        </div>

                        <div v-show="object.vehicle=='truck'" class="col-md-12 text-center marginTop30">
                          <h4>Services for trucks <small>Check if apply</small></h4>

                          <label class="marginTop30" for="bed">Does your truck has the bed down? </label>
                          <input name="bed" id="bed" type="checkbox"
                          v-bind:true-value="1" v-bind:false-value="0" v-model="object.bed">
                          <br>
                          <label for="mud">Does your truck has mud? </label>
                          <input name="mud" id="mud" type="checkbox"
                          v-bind:true-value="1" v-bind:false-value="0" v-model="object.mud" > +$2 fee

                        </div>

                        <div class="col-md-12 text-center marginTop30">
                          <button type="button" class="btn btn-success btn-lg" v-on:click="checkAdditionals">
                            <i class="fa fa-credit-card"></i> Checkout
                          </button>
                        </div>
                      </div>

                      <div v-show="currentStep==4" class="step4">


                        <div class="col-md-6 col-md-offset-3">
                        <h3 class="marginTop30 text-center">Checkout</h3>
                        <ul class="list-group marginTop30">
                           <li class="list-group-item">Vehicle: {{object.vehicle}}</li>
                           <li class="list-group-item">Plate: {{object.plate}}</li>
                           <li class="list-group-item">Visits: {{object.visits}}</li>
                           <li class="list-group-item">Price: ${{object.price}}</li>
                           <li class="list-group-item" v-show="object.mud && object.vehicle=='truck'">Extra Mud: $2</li>
                           <li class="list-group-item">Subtotal: ${{object.final.subtotal}}</li>
                           <li class="list-group-item" v-if="object.discount>0">Discount {{object.discount*100}}% off</li>
                           <li class="list-group-item" v-if="object.discount>0">Subtotal after discount ${{object.final.subtotal-object.final.discount}} </li>
                           <li class="list-group-item">Taxes (8%) ${{ object.final.taxes }}</li>
                           <li class="list-group-item"><strong>Gran Total ${{object.final.total }}</strong></li>
                         </ul>
                         <button class="btn btn-block btn-lg btn-success marginTop30" v-on:click="finish"> Pay & finish</button>
                       </div>

                      </div>



                    </div>
                </div>

                <div class="col-md-12">
                  <h5>Jesus Arriaga Barron - jarriagabarron@gmail.com </h5>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

import Vue from 'vue'
import VueSweetAlert from 'vue-sweetalert'

Vue.use(VueSweetAlert)
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
              visits:0,
              bed:0,
              pricemud:0,
              final:{
                subtotal:0,
                total:0,
                taxes:0,
                discount:0,
              }
            },
            errors:{
              plate:0,
            }
          }
        },
      methods:{
        getLicenseInfo: function(){
          var vm = this;
          //request for alerts
          let plate =  this.object.plate.replace(/-|\s/g,"").toLowerCase();
          axios.get(`/get-alerts/${plate}`)
            .then(function(response){
              if( response.data.alert==1){
                vm.$swal(
                  'ALERT! - STOLEN CAR',
                  'The license plate has been reported as stolen car',
                  'error'
                );
                vm.currentStep=1;
              }else{
                //request for loyalty discount
                axios.get(`/get-loyalty/${plate}`)
                .then(function(response){
                  vm.object.discount = response.data.loyalty_discount;
                  vm.object.visits = response.data.visits;
                  if(vm.object.discount>0 || vm.object.vehicle=='truck'){
                    vm.currentStep=3;
                  }
                  else{
                    vm.calculateBill();
                    vm.currentStep=4;
                  }
                });
              }
            });
        },
        setVehicle: function(typeVehicle){
          this.object.vehicle=typeVehicle;
          this.object.price=this.rules.washPrice[typeVehicle];
          this.currentStep=2;
        },
        searchPlate:function(){
          this.errors.plate=0;
          if(this.object.plate){
            //get Alerts for this plate
            this.getLicenseInfo();
          }else{
            //set error if empty
            this.errors.plate=1;
          }
        },
        checkAdditionals:function(){
          if(this.object.bed && this.object.vehicle=='truck'){
            this.$swal(
              'SORRY',
              'We can not accept truck with bed let down ',
              'warning'
            );
            this.currentStep=3;
          }else{
            this.calculateBill();
            this.currentStep=4;
          }
        },
        calculateBill:function(){
          if(this.object.mud){this.object.pricemud=2;}
          this.object.final.subtotal = this.object.price+this.object.pricemud;
          this.object.final.discount =  this.object.final.subtotal * this.object.discount;
          this.object.final.taxes =  (this.object.final.subtotal - this.object.final.discount) * 0.08;
          this.object.final.total = this.object.final.subtotal+this.object.final.taxes-this.object.final.discount;
        },
        finish:function(){
          var vm= this;
          axios.post(`/proccess/`,this.object)
          .then(function(response){
            console.log(response);
            vm.$swal(
              'THANK YOU',
              'We appreciate your business',
              'success'
            );
            vm.currentStep=1;
          });
        }
      },
      computed:{
        reset: function(){
          if(this.currentStep==1){
            console.log('object was reset');
            this.object={
              vehicle:null,
              price:null,
              plate:null,
              mud:0,
              discount:0,
              visits:0,
              bed:0,
              pricemud:0,
              final:{
                subtotal:0,
                total:0,
                taxes:0,
                discount:0,
              }
            };
          }
        },

      }
    }
</script>


<style scoped="">
.marginTop30{margin-top: 30px;}
.marginR20{margin-right: 20px;}
.img-button{ width:80px;height: auto;margin-top:-32px}
.btn-auto{width:150px;}
.panel{min-height:400px;}
.img-loyalty{width:250px; height:auto;}

</style>
