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
                        <h6 class="mb-0">{{ formatPrice(sum_income) }}</h6> <span class="text-muted">ກີບ</span>
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
                        <h6 class="mb-0">{{ formatPrice(sum_expense) }}</h6> <span class="text-muted">ກີບ</span>
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
                        <h6 class="mb-0">{{ formatPrice(sum_profit) }}</h6> <span class="text-muted">ກີບ</span>
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
                        <LineChart :ChartData="chdata" :ChartOptions="choption" :Update="chupdate" :key="key" v-if="Show_charts"/>
                    </div>
                  </div>
               </div>
            </div>
        </div>
    </div>
</template>

<script>
// import MonthlyChart from './../components/MonthlyChart.vue';
import LineChart from './../components/LineChart.vue';
import moment from "moment";
export default {
    name: 'MiniPosReport',

    data() {
        return {
            Show_charts: false,
            month_type:'y',
            dmy:'',
            data_income:[],
            data_expense:[],
            chdata:'',
            choption:{
                responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                    yAxes: [
                        {
                        ticks: {
                            display: true,
                            beginAtZero: false,
                            callback: function (value, index, values) {
                            return ( Number(value) .toFixed(0) .replace(/./g, function (c, i, a) { return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c; }) + " ກີບ" );
                            },
                        },
                        gridLines: {
                            show: true,
                        },
                        },
                    ],
                    },
                    tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                        return (
                            Number(tooltipItem.yLabel) .toFixed(0) .replace(/./g, function (c, i, a) { return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c; }) + " ກີບ" );
                        },
                    },
                    mode: "index",
                    intersect: false,
                    },
            },
            chupdate:null,
            key:0
        };
    },

    components:{
        LineChart,moment
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
                    this.data_income = response.data.income;
                    this.data_expense = response.data.expense;
                    this.GenGrap();
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

        GenGrap(){
        this.Show_charts = true;
        if(this.month_type == "m"){
          this.key++;
          let re_income = [];
          let re_expense = [];
          let m = this.dmy.split("-")[1];
          let y = this.dmy.split("-")[0];
          let lastday = this.Getlastday(y,m);
          let chart_label = [];
          for (let i = 0; i < lastday; i++) {
           chart_label.push("ວັນທີ່ " + (i + 1));
          }
        //   console.log(chart_label);
          re_income = this.Get_data_chart(lastday, this.data_income) || 0;
          re_expense = this.Get_data_chart(lastday, this.data_expense) || 0;
          this.chdata = {
            labels:chart_label,
            datasets:[
              {
                label: "ລາຍຮັບ",
                fill:false,
                borderColor: "#336600",
                data: re_income
              },
              {
                label: "ລາຍຈ່າຍ",
                fill:false,
                borderColor: "#DC3912",
                data: re_expense
              },
            ]
          };
          this.chupdate = Math.floor(Math.random() * 100);
        } else if(this.month_type == "y"){
          this.key++;
          let re_income = [];
          let re_expense = [];
          let m = this.dmy.split("-")[1];
          let y = this.dmy.split("-")[0];
          //let lastday = this.Getlastday(y,m);
          let chart_label = ["ເດືອນ 1","ເດືອນ 2","ເດືອນ 3","ເດືອນ 4","ເດືອນ 5","ເດືອນ 6","ເດືອນ 7","ເດືອນ 8","ເດືອນ 9","ເດືອນ 10","ເດືອນ 11","ເດືອນ 12"];
       
          //console.log(chart_label);
          re_income = this.Get_data_chart_y(12, this.data_income) || 0;
          re_expense = this.Get_data_chart_y(12, this.data_expense) || 0;
          this.chdata = {
            labels:chart_label,
            datasets:[
              {
                label: "ລາຍຮັບ",
                fill:false,
                borderColor: "#336600",
                data: re_income
              },
              {
                label: "ລາຍຈ່າຍ",
                fill:false,
                borderColor: "#DC3912",
                data: re_expense
              },
            ]
          };
          this.chupdate = Math.floor(Math.random() * 100);
        }
      },

        Getlastday(y,m){
		  let dd = new Date(y, m , 0).getDate();
        //   console.log('ວັນທີ່ສຸດທ້າຍ ຂອງເດືອນ:'+ dd)
          return dd
        },
        Getday(value){
          return moment(value).format("DD");
        },
        Getmonth(value){
          return moment(value).format("MM");
        },
        Get_data_chart(date, data){
          ///  console.log(data)
          let new_db_in = [];
          let databack = [];
          for (let y = 0; y < data.length; y++) {
            if (data[y] != "") {
            let day = this.Getday(data[y].created_at);
            new_db_in.push({ prices: data[y].prices, day: day });
            }
          }
          // console.log(new_db_in)
          
            let update_db_in = new_db_in.reduce((a, c) => {
              let filtered = a.filter((el) => el.day === c.day);
              if (filtered.length > 0) {
              a[a.indexOf(filtered[0])].prices =
                parseInt(a[a.indexOf(filtered[0])].prices) + parseInt(c.prices);
              } else {
              a.push(c);
              }
              return a;
            }, []);
           //console.log(update_db_in)
            for (let i = 0; i < date; i++) {
              let type = true;
              for (let k = 0; k < update_db_in.length; k++) {
              if (update_db_in[k].day == i + 1) {
                if (type) {
                databack.push(update_db_in[k].prices);
                type = false;
                }
              }
              }
              if (type) {
              databack.push(0);
              type = false;
              }
            }
            //console.log(databack)
          return databack;
        },
        Get_data_chart_y(monthchart, data){
          let new_db_in = [];
          let databack = [];
          for (let y = 0; y < data.length; y++) {
            if (data[y] != "") {
            let month = this.Getmonth(data[y].created_at);
            new_db_in.push({ prices: data[y].prices, month: month });
            }
          }
          let update_db_in = new_db_in.reduce((a, c) => {
            let filtered = a.filter((el) => el.month == c.month);
            if (filtered.length > 0) {
            a[a.indexOf(filtered[0])].prices =
              parseInt(a[a.indexOf(filtered[0])].prices) + parseInt(c.prices);
            } else {
            a.push(c);
            }
            return a;
          }, []);
          for (let i = 0; i < monthchart; i++) {
            let type = true;
            for (let k = 0; k < update_db_in.length; k++) {
            if (update_db_in[k].month == i + 1) {
              if (type) {
              databack.push(update_db_in[k].prices);
              type = false;
              }
            }
            }
            if (type) {
            databack.push(0);
            type = false;
            }
          }
          return databack;
        },
        
    },

    // beforeRouteEnter (to, from, next) {
    //   if(window.Laravel.isLoggin){
    //       next();
    //   }else{
    //        window.location.href ="/login"
    //       //location.reload();
    //   }
    // },

};
</script>

<style lang="scss" scoped>

</style>