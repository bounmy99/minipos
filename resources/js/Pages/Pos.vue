<template>
    <div>
        <div class="row">
            <div class="col-md-8" >
                <div class="row mb-3 g-2" style="overflow:auto;height:85vh;">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i><input type="text" class="form-control border-0 shadow-none" placeholder="ຄົ້ນຫາຂໍ້ມູນ..." aria-label="Search...">
                            </div>
                        </div><!-- /Search -->
                    </div>
                </nav>
                    <div class="col-md-3 col-lg-3  mt-3" v-for="item in DataStore.data" :key="item.id">
                        <div class="card h-100 pointer" @click="add_product(item.id)">
                            <span v-for="li in ListOrder" :key="li.id">
                                <span class="count-product" v-if="item.id==li.id">{{ li.order_amount }}</span>
                            </span>
                        <img class="card-img-top .img_cover" :src="('assets/img/images/'+item.image )" alt="Card image cap" v-if="item.image" style="max-height:fit-content">
                        <img class="card-img-top .img_cover" :src="('assets/img/images/no_image.jpg')" alt="Card image cap" v-if="!item.image">
                        <div class="card-body p-2 text-center">
                            <h5 class="card-title text-danger">{{formatPrice(item.prices_sell)}} ກີບ</h5>
                            <p class="card-text text-price">ຊື່:
                               {{item.name}}
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                        <div class="card h-100 mt-2" >
                        <div class="card-body p-1" style="overflow:auto;height:50vh;">
                            <div class="d-flex justify-content-between text-allprice mb-3">
                                <span>ລວມຍອດເງິນທັງໝົດ</span>
                                <span>{{formatPrice(TotalAmount) }} ກີບ</span>
                            </div>
                            <div>
                                <button class="btn btn-success d-grid w-100" :disabled="CheckBtnPay"   @click="BTN_Play()" >ຊຳລະເງິນ</button>
                                <button class="btn btn-danger mt-3 d-grid w-100" v-if="TotalAmount > 0" @click="del_all()">ຍົກເລີກການສັ່ງຊື້</button>
                            </div>
                            <div class="mt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ລາຍການ</th>
                                            <th>ລາຄາ</th>
                                            <th>ຍອດລວມ </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="list_item in ListOrder" :key="list_item.id">
                                            <td>{{list_item.name}}</td>
                                            <td class="text-end"> 
                                                <i class="bx bx-minus-circle pointer text-info" @click="add_amount(list_item.id)"></i>  
                                                        {{ list_item.order_amount }}  
                                                <i class="bx bx-plus-circle pointer text-info" @click="add_product(list_item.id)"></i> <i class="bx bx-x-circle pointer text-danger" @click="del(list_item.id)"></i> <br> {{formatPrice(list_item.prices_sell)}}</td>
                                            <td class="text-end">{{formatPrice(list_item.order_amount * list_item.prices_sell)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fw-bold text-center" id="modalCenterTitle">ຊຳລະສີ້ນຄ້າ</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
        <div class="modal-body">
            <h5 class="d-flex justify-content-between text-success">
              <span>ລວມຍອດເງິນ:</span>
              <span>{{formatPrice(TotalAmount) }} ກີບ</span>
            </h5>
            <h5 class="d-flex justify-content-between text-primary">
              <span>ເງິນທີ່ຮັບນຳລູກຄ້າ:</span>
              <span>{{formatPrice(CrashRecive) }} ກີບ</span>
            </h5>
            <h5 class="d-flex justify-content-between text-danger" v-if=" CrashBack > 0">
              <span>ເງິນທອນ:</span>
              <span>{{formatPrice(CrashBack) }} ກີບ</span>
            </h5>
            
            <cleave :options="options" class="form-control" v-model="CrashRecive" style="text-align:right" />
        <div class="p-2 justify-content-center d-flex">
              <div class="row" style="width: 250px">
                <div class="col-4 text-center mt-2">
                  <a @click="AddNum(1)"
                    class="btn btn-primary btn-lg text-white"
                    style="width: 60px"
                    >1</a
                  >
                </div>
                <div class="col-4 text-center mt-2">
                  <a @click="AddNum(2)"
                    class="btn btn-primary btn-lg text-white"
                    style="width: 60px"
                    >2</a
                  >
                </div>
                <div class="col-4 text-center mt-2">
                  <a @click="AddNum(3)"
                    class="btn btn-primary btn-lg text-white"
                    style="width: 60px"
                    >3</a
                  >
                </div>
                <div class="col-4 text-center mt-2">
                  <a @click="AddNum(4)"
                    class="btn btn-primary btn-lg text-white"
                    style="width: 60px"
                    >4</a
                  >
                </div>
                <div class="col-4 text-center mt-2">
                  <a @click="AddNum(5)"
                    class="btn btn-primary btn-lg text-white"
                    style="width: 60px"
                    >5</a
                  >
                </div>
                <div class="col-4 text-center mt-2">
                  <button @click="AddNum(6)"
                    type="button"
                    class="btn btn-primary btn-lg text-white"
                    style="width: 60px"
                  >
                    6
                  </button>
                </div>
                <div class="col-4 text-center mt-2">
                  <a @click="AddNum(7)"
                    class="btn btn-primary btn-lg text-white"
                    style="width: 60px"
                    >7</a
                  >
                </div>
                <div class="col-4 text-center mt-2">
                  <a @click="AddNum(8)"
                    class="btn btn-primary btn-lg text-white"
                    style="width: 60px"
                    >8</a
                  >
                </div>
                <div class="col-4 text-center mt-2">
                  <a @click="AddNum(9)"
                    class="btn btn-primary btn-lg text-white"
                    style="width: 60px"
                    >9</a
                  >
                </div>
                <div class="col-4 text-center mt-2">
                  <a @click="AddNum('00')"
                    class="btn btn-primary btn-lg text-white"
                    style="width: 60px"
                    >00</a
                  >
                </div>
                <div class="col-4 text-center mt-2">
                  <a @click="AddNum(0)"
                    class="btn btn-primary btn-lg text-white"
                    style="width: 60px"
                    >0</a
                  >
                </div>
                <div class="col-4 text-center mt-2">
                  <a @click="AddNum('-')"
                    class="btn btn-danger btn-lg text-white"
                    style="width: 60px"
                    > <i class='bx bx-left-arrow-alt'></i> </a>
                </div>
              </div>
            </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <button type="button" class="btn btn-info" :disabled="CheckConfirmPay"  @click="ConfirmPay()"><i class="bx bxl-paypal"></i>ຢືນຢັນການສຳລະ</button>
                </div>
              </div>
            </div>
          </div>
    </div>
</template>

<script>
export default {
    name: 'MiniPosPos',

    data() {
        return {
            search:'',
            CrashRecive:'',
            CrashBack:'',
            DataStore:[],
            ListOrder:[],
            options: {
                  //prefix: '₭ ',
                  numeral: true,
                  numeralPositiveOnly: true,
                  noImmediatePrefix: true,
                  rawValueTrimPrefix: true,
                  numeralIntegerScale: 10,
                  numeralDecimalScale: 2,
                  numeralDecimalMark: '.',
                  delimiter: ','
                },
        };
    },

    mounted() {
        
    },
    computed:{
        CrashBack(){
            return this.CrashRecive - this.TotalAmount
        },
        TotalAmount(){
            return this.ListOrder.reduce((num,list_item)=>num + list_item.prices_sell * list_item.order_amount,0);
        },
        CheckBtnPay(){
            if(this.TotalAmount > 0){
                return false
            }else{
                return true
            }
        },
        CheckConfirmPay(){
            if(this.TotalAmount <= this.CrashRecive){
                return false
            }else{
                return true
            }
        }
    },
    methods: {

        ConfirmPay(){
            this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
              this.$axios.post('/api/transition/add/', {
                 acc_type:"income",
                 ListOrder : this.ListOrder,
              }).then((response)=>{

                $("#modalCenter").modal("hide");//ປິດແບບຟອມຫຼັງຈາກບັນທຶກແລ້ວ
                 this.ListOrder = []; //ລ້າງລາຍການຫຼັງຈາກຊຳລະ
                 this.CrashRecive = "";//ລ້າງຂໍ້ມູນຫຼັງຈາກຢືນຢັນ
                 this.getDataStore(); //ອັບເດດການສັ່ງຊື້

                if(response.data.success){
                  this.$swal({
                    position: 'top-center',
                    icon: 'success',
                    title: response.data.message,
                    showConfirmButton: false,
                    timer: 2000
                  });
                }
              // this.getDataStore();
              }).catch((error)=>{
              console.log(error);
              });
              });
            
        },

      AddNum(num){
        // console.log(num);
        if(num=='-'){
            this.CrashRecive = this.CrashRecive.slice(0,-1);
        }else{
            this.CrashRecive = this.CrashRecive + num;
        }
    },
//ການສະແດງແບບຟອມຢືນຢັນການຊຳລະ
    BTN_Play(){
        $("#modalCenter").modal("show");
    },
    add_amount(id){
        this.ListOrder.find((i) => i.id == id).order_amount--;

        let item = this.ListOrder.find((i) => i.id == id).order_amount;

      if (item < 1) {
        //console.log(item);
        this.ListOrder.splice(this.ListOrder.map((i) => i.id).indexOf(id), 1);
      }
    },
    // del_amount(id){
    //     this.ListOrder.find((i) => i.id == id).order_amount++;
    // },
    del(id){

        this.ListOrder.splice(this.ListOrder.map((i) => i.id).indexOf(id), 1);
    },
    del_all(){
        this.ListOrder = []
    },

    add_product(id) {

      let Item = this.DataStore.data.find((i) => i.id == id);

      if(Item.amount > 0){ //ກວດສອບສີ້ນຄ້າຄ້າງສະຕັອກ

        let list_order = this.ListOrder.find((i) => i.id ==id);

          if(list_order){ //ກວດສອບລາຍການສັ່ງຊື້ ວ່າມີລະຫັດທີ່ຕ້ອງການສັ່ງໍື້ບໍ່

            let  old_order_amount = list_order.order_amount;

              if(Item.amount - old_order_amount > 0){ //ກວດສອບລາຍການສີ້ນຄ້າກັບລາຍການສັ່ງຊື້ວ່າມີສີ້ນຄ້າທີ່ຈະສັ່ງຊື້ບໍ່
                
                if(this.ListOrder.find((i) => i.id ==id)){//ກວດສອບການເພີ່ນຈຳນວນສີ້ນຄ້າ
                    this.ListOrder.find((i) => i.id ==id).order_amount++;
                   }else{
                    this.ListOrder.push({
                        id: Item.id,
                        name: Item.name,
                        prices_sell: Item.prices_sell,
                        order_amount: 1,
                    });
                }
              }else{
                this.$swal.fire("Warning","ສີ້ນຄ້າໝົດແລ້ວ","warning");
              }

          }else{
                 //ກວດສອບເພີ່ມສີ້ນຄ້າ
                  if(this.ListOrder.find((i) => i.id ==id)){
                    this.ListOrder.find((i) => i.id ==id).order_amount++;
                   }else{
                    this.ListOrder.push({
                        id: Item.id,
                        name: Item.name,
                        prices_sell: Item.prices_sell,
                        order_amount: 1,
                    });
                }
          }

 

      }else{
        this.$swal.fire("Warning","ສີ້ນຄ້າໝົດແລ້ວ","warning");
      }

       
      },
    
// ຟັງຊັນຕົວເລກສຳລັບໃຊ້ສະແດງລາຄາເປັນເງິນ
        formatPrice(value){
          let val = (value / 1).toFixed(0).replace(",", ".");
          return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",");      
         },

        getDataStore(page){
          this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
                this.$axios.get(`api/store?page=${page}&search=${this.search}`).then((response)=>{
                    this.DataStore = response.data;
                  }).catch((error)=>{
                    console.log(error);
                  });
              });
          
        },
     
    },


    created(){
      this.getDataStore();
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

<style>
    .text-allprice{
        font-weight: bold;
        color: rgb(19, 133, 148);
    }
    .text-price{
        font-weight: bold;
        color: rgb(41, 215, 238);
    }
    .img_cover{
        width:100%;
        height:140px;
        object-fit:cover;
        object-position:center;

    }
    .count-product{
    position: absolute;
    background-color: blueviolet;
    color: white;
    padding: 5px;
    right: 0px;
    border-radius: 0px 10px 0px 10px;

    }
    .pointer{
        cursor: pointer;
    }
</style>