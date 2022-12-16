<template>
    <div>
        <div class="row">
  <div class="col-md-4 col-lg-4 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">ລາຍຮັບ</h5>
      </div>
           <div class="card-body">
                <ul class="p-0 m-0">
                    <li class="d-flex">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between">
                        <i class="menu-icon bx bx-line-chart"></i>
                        <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">12,000,000</h6> <span class="text-muted">ກີບ</span>
                        </div>
                    </div>
                    </li>
                    <li class="d-flex">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between mt-2" >
                        <h6 class="mb-0">Monthly Incom</h6> <span class="text-muted">50%</span>
                    </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
  <div class="col-md-4 col-lg-4 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">ລາຍຈ່າຍ</h5>
      </div>
           <div class="card-body">
            <ul class="p-0 m-0">
                    <li class="d-flex">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between">
                        <i class="menu-icon bx bx-line-chart"></i>
                        <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">12,000,000</h6> <span class="text-muted">ກີບ</span>
                        </div>
                    </div>
                    </li>
                    <li class="d-flex">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between mt-2" >
                        <h6 class="mb-0">Monthly Expens</h6> <span class="text-muted">50%</span>
                    </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
  <div class="col-md-4 col-lg-4 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">ກຳໄລ</h5>
      </div>
           <div class="card-body">
            <ul class="p-0 m-0">
                    <li class="d-flex">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between">
                        <i class="menu-icon bx bx-line-chart"></i>
                        <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">12,000,000</h6> <span class="text-muted">ກີບ</span>
                        </div>
                    </div>
                    </li>
                    <li class="d-flex">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between mt-2" >
                        <h6 class="mb-0">Monthly Profit</h6> <span class="text-muted">50%</span>
                    </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="my-3 mx-3 fw-bold">ລາຍການສະແດງລາຍງານ</h4>
                    <div class="d-flex justify-content-end">
                        
                        <div class="btn-group me-2" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-info" @click="month_type='d'"><i class="bx bx-chevron-right" v-if="month_type=='d'"></i> ວັນທີ</button>
                                <button type="button" class="btn btn-success" @click="month_type='m'"><i class="bx bx-chevron-right" v-if="month_type=='m'"></i> ເດືອນ</button>
                                <button type="button" class="btn btn-warning" @click="month_type='y'"><i class="bx bx-chevron-right" v-if="month_type=='y'"></i> ປີ</button>
                        </div>
                                    <input type="date" name="" id="" class="form-control" style="width:180px" v-model="dmy">
                               
                                <div class="mx-2">
                                    <button type="button" class="btn btn-primary" :disabled="disre" @click="create_report()"> ສະແດງການເຄື່ອນໄຫວ</button>
                                </div>
                    </div>
                    <div class="mt-3">
                        <MonthlyChart/>
                    </div>
                  </div>
               </div>
            </div>
        </div>
    </div>
</template>

<script>
import MonthlyChart from './../components/MonthlyChart.vue'

export default {
    name: 'MiniPosReport',

    data() {
        return {
            month_type:'y',
            dmy:''
        };
    },

    components:{
        MonthlyChart
    },

    mounted() {
        
    },
    computed:{
        sum_income(){
           
        },
        sum_expense(){

        },
        sum_report(){

        },
        disre(){
            if(this.dmy==''){
              return  true
            }else{
              return   false
            }
        }
    },
    methods: {

        create_report(){
            this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
                this.$axios.post(`api/report`,{
                    month_type: this.month_type,
                    dmy: this.dmy
                }).then((response)=>{
                    this.TranData = response.data.income;
                    this.TranData = response.data.expense;
                  }).catch((error)=>{
                    console.log(error);
                  });
              });
        }
    },

    beforeRouteEnter (to, from, next) {
      if(window.Laravel.isLoggin){
          next();
      }else{
          window.location.href ="/login"
      }
    }
};
</script>

<style lang="scss" scoped>

</style>