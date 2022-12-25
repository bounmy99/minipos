<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="my-3 mx-3 fw-bold">ລາຍການສະແດງການເຄື່ອນໄຫວ</h4>
                    <div class="d-flex justify-content-end">
                        
                        <div class="btn-group me-2" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-info" @click="month_type='d'"><i class="bx bx-chevron-right" v-if="month_type=='d'"></i> ວັນທີ</button>
                                <button type="button" class="btn btn-success" @click="month_type='m'"><i class="bx bx-chevron-right" v-if="month_type=='m'"></i> ເດືອນ</button>
                                <button type="button" class="btn btn-warning" @click="month_type='y'"><i class="bx bx-chevron-right" v-if="month_type=='y'"></i> ປີ</button>
                        </div>
                              
                                    <input type="date" name="" id="" class="form-control" style="width:180px" v-model="dmy">
                               
                                <div class="mx-2">
                                    <button type="button" class="btn btn-primary" @click="GetTran()"> ສະແດງການເຄື່ອນໄຫວ</button>
                                </div>
                            
                    </div>
                    <div class="table-responesive text-nowrap mt-2">
                        <table class="table table-bordered table-hover"> 
                            <thead>
                                <tr>
                                    <th class="text-center">ວັນທີ</th>
                                    <th>ເລກທຸລະກຳ</th>
                                    <th>ປະເພດທຸລະກຳ</th>
                                    <th>ລາຍລະອຽດ</th>
                                    <th>ມູນຄ່າ</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr v-for="list in TranData.data" :key="list.id" >
                                        <td class="text-center">{{ date(list.created_at)}}</td>
                                        <td>{{ list.tran_id}}</td>
                                        <td>{{ list.tran_type}}</td>
                                        <td>{{ list.tran_detail}}</td>
                                        <td>{{ formatPrice(list.prices)}}</td>                          
                                    </tr>
                            </tbody>
                        </table>
                        <pagination :pagination="TranData" :offset="4" @paginate="GetTran($event)" />
                    </div>
                  </div>
               </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: 'MiniPosTransfer',

    data() {
        return {
            print:'',
            TranData:[],
            month_type:'y',
            dmy:''
        };
        
    },
    components:{
        moment
        },

    mounted() {
        
    },

    methods: {

        date(value){
            return moment(value).format("DD/MM/YYYY");
        },

        GetTran(page){
            this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
                this.$axios.post(`api/transition?page=${page}`,{
                    month_type: this.month_type,
                    dmy: this.dmy
                }).then((response)=>{
                    this.TranData = response.data;
                  }).catch((error)=>{
                    console.log(error);
                  });
              });
        },
            // ຟັງຊັນຕົວເລກສຳລັບໃຊ້ສະແດງລາຄາເປັນເງິນ
        formatPrice(value){
            let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",");      
            }
    },
    created(){
        this.GetTran();
    },

    // beforeRouteEnter (to, from, next) {
    //   if(window.Laravel.isLoggin){
    //       next();
    //   }else{
    //       window.location.href ="/login"
    //      // location.reload();
    //   }
    // },

};
</script>

<style lang="scss" scoped>

</style>