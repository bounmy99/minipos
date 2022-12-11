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
                        <div class="card h-100">
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
                        <div class="card-body" style="overflow:auto;height:50vh;">
                            <div class="d-flex justify-content-between text-allprice mb-3">
                                <span>ລວມຍອດເງິນທັງໝົດ</span>
                                <span>1000,000 ກີບ</span>
                            </div>
                            <div>
                                <button class="btn btn-success d-grid w-100">ຊຳລະເງິນ</button>
                            </div>
                            <div class="mt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ລາຍການ</th>
                                            <th>ລາຄາ</th>
                                            <th>ຍອດລວມ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>a</td>
                                            <td>b</td>
                                            <td>c</td>
                                        </tr>
                                        <tr>
                                            <td>a</td>
                                            <td>b</td>
                                            <td>c</td>
                                        </tr>
                                        <tr>
                                            <td>a</td>
                                            <td>b</td>
                                            <td>c</td>
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
export default {
    name: 'MiniPosPos',

    data() {
        return {
            search:'',
            DataStore:[],
        };
    },

    mounted() {
        
    },

    methods: {
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
</style>