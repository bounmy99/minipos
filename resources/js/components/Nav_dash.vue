<template>
    <div>
        <div class="row">
  <div class="col-md-3 col-lg-3 order-2 mb-4">
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
                        <h6 class="mb-0">{{formatPrice(sum_income)}}</h6> <span class="text-muted">ກີບ</span>
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
  <div class="col-md-3 col-lg-3 order-2 mb-4">
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
                        <h6 class="mb-0">{{formatPrice(sum_expense)}}</h6> <span class="text-muted">ກີບ</span>
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
  <div class="col-md-3 col-lg-3 order-2 mb-4">
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
                        <h6 class="mb-0">{{formatPrice(sum_profit)}}</h6> <span class="text-muted">ກີບ</span>
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
  <div class="col-md-3 col-lg-3 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">ສະຕ໋ອກ</h5>
      </div>
           <div class="card-body">
            <ul class="p-0 m-0">
                    <li class="d-flex">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between">
                        <i class="menu-icon bx bx-line-chart"></i>
                        <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">{{formatPrice(sum_store)}}</h6> <span class="text-muted">ລາຍການ</span>
                        </div>
                    </div>
                    </li>
                    <li class="d-flex">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between mt-2" >
                        <h6 class="mb-0">Monthly Store</h6> <span class="text-muted">75,65</span>
                    </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
    </div>
</template>

<script>
export default {
    name: 'MiniPosNavDash',

    data() {
        return {
            data_income:[],
            data_expense:[],
            data_store:[]
        };
    },

    mounted() {
        
    },
    computed:{
        sum_income(){
           return this.data_income.reduce((num,item)=>num+item.prices,0);
        },
        sum_expense(){
            return this.data_expense.reduce((num,item)=>num+item.prices,0);
        },
        sum_profit(){
            return this.sum_income - this.sum_expense;
        },
        sum_store(){
            return this.data_expense.reduce((num,item)=>num+item.amount,0);
        }
    },

    methods: {

        Getdata(){
            this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
                this.$axios.get(`api/report/dash`).then((response)=>{
                  
                    this.data_income = response.data.income;
                    this.data_expense = response.data.expense;
                    this.data_store = response.data.store;
                     console.log(response.data.store);
                  }).catch((error)=>{
                    console.log(error);
                  });
              });
        },
        // ຟັງຊັນຕົວເລກສຳລັບໃຊ້ສະແດງລາຄາເປັນເງິນ
        formatPrice(value){
          let val = (value / 1).toFixed(0).replace(",", ".");
          return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",");      
         },
        
    },

    created(){
        this.Getdata();
    }
};
</script>

<style lang="scss" scoped>

</style>