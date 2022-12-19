<template>
       <Nav_dash/>
    <!-- table -->

    <div class="card">
      <h5 class="card-header mb-0" v-if="!FormShow"><b>ລາຍການຂໍ້ມູນ</b></h5>
      <h5 class="card-header mb-0" v-if="FormShow"><b>ແບບຟອມບັນທຶກຂໍ້ມູນ</b></h5>
      <!-- {{FormData}} -->
      
       <!-- {{DataStore}} -->
       
       <!-- {{FormType}} -->
      <div class="demo-inline-spacing d-flex justify-content-start mt-0 mb-3  ms-4">
        <button type="button" class="btn rounded-pill btn-primary" v-if="!FormShow" @click="add_store()"><i class="bx bx-plus-circle mb-1"></i> ເພີ່ມ</button>
      </div>
      <div class="row card-body" v-if="FormShow">
      <!-- <h5 class="card-header">Default</h5> -->
      <div class="col-md-4">
          <img :src="image_preview" alt="" style="width:100%"  >
          <input type="file" class="form-control mt-2" id="" @change="onSelected">
      </div>
    <div class="col-md-8">
            <div class="alert alert-danger alert-dismissible" role="alert" v-if="show_error">
                <i class="bx bx-info-circle fs-20"></i>
            {{ text_error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
            </div>
        <div>
          <label for="defaultFormControlInput" class="form-label">ຊື່ສີ້ນຄ້າ</label>
          <input type="text" class="form-control" id="" placeholder="ກະລຸນາປ້ອນຊື່ສີ້ນຄ້າ " v-model="FormData.name" >
          <label for="defaultFormControlInput" class="form-label">ຈຳນວນ</label>
          <input type="text" class="form-control" id="" placeholder="ກະລຸນາປ້ອນຈຳນວນ" v-model="FormData.amount">
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="defaultFormControlInput" class="form-label">ລາຄາຊື້</label>
          <cleave  :options="options" type="text" class="form-control" id="" placeholder="ກະລຸນາປ້ອນລາຄາຊື້" v-model="FormData.prices_buy" />
          </div>
          <div class="col-md-6">
            <label for="defaultFormControlInput" class="form-label">ລາຄາຂາຍ</label>
          <cleave  :options="options" type="text" class="form-control" id="" placeholder="ກະລຸນາປ້ອນລາຄາຂາຍ" v-model="FormData.prices_sell" />
          </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
          <button type="button" class="btn rounded-pill btn-success me-2" v-if="FormShow" @click="save_Data()"><i class="bx bx-download mb-1"></i> ບັນທຶກ</button>
          <button type="button" class="btn rounded-pill btn-danger" v-if="FormShow" @click="cancel()"><i class="bx bx-x-circle mb-1"></i> ຍົກເລີກ</button>
        </div>
     </div>
      </div>
      <div class="table-responsive text-nowrap card-body " v-if="!FormShow">
        <div class="row mb-3">
          <div class="col-md-6">
              <!-- <input   class="form-control" placeholder="ຄົ້ນຫາຂໍ້ມູນ" v-model="search" @keyup.enter="getDataStore()"> -->
              <div class="navbar-nav align-items-start">
              <div class="nav-item d-flex align-items-start">
                <i class="bx bx-search fs-4 lh-0 mt-2"></i><input type="text" class="form-control border-0 shadow-none" placeholder="ຄົ້ນຫາຂໍ້ມູນ..."  v-model="search" @keyup.enter="getDataStore()">
              </div>
            </div>
          </div>
          <div class="col-md-6"></div>
        </div>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>ລະຫັດ</th>
          <th class="text-center">ຮູບພາບ</th>
          <th>ຊື່ສີ້ນຄ້າ</th>
          <th>ຈຳນວນ</th>
          <th>ລາຄາຊື້</th>
          <th>ລາຄາຂາຍ</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0"> 
        <tr v-for="list in DataStore.data" :key="list.id">
          <td><strong>{{list.id}}</strong></td>
          <td>
            <img class="card-img-top .img_cover" :src="('assets/img/images/'+list.image )" alt="Card image cap" v-if="list.image" style="width:40px;height:40">
            <img class="card-img-top .img_cover" :src="('assets/img/images/no_image.jpg')" alt="Card image cap" v-if="!list.image" style="width:40px;height:40">
          </td>
          <td><strong>{{list.name}}</strong></td>
          <td><strong>{{list.amount}}</strong></td>
          <td><strong>{{formatPrice(list.prices_buy)}}</strong></td>
          <td><strong>{{formatPrice(list.prices_sell)}}</strong></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);" @click="edit_store(list.id)"><i class="bx bx-edit-alt me-1 btn btn-info"></i>ແກ້ໄຂ</a>
                <a class="dropdown-item" href="javascript:void(0);" @click="del_store(list.id) "><i class="bx bx-trash me-1 btn btn-danger"></i> ລົບ</a>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <pagination :pagination="DataStore" :offset="4" @paginate="getDataStore($event)" />
  </div>
</div>

</template>

<script>
export default {
    name: 'MiniPosStore',

    data() {
        return {

            show_error: false,
            text_error:'',
            image_preview:window.location.origin + '/assets/img/images/placeholder.jpg',
            image_product:'',
            search:'',
            EditID :'',
            FormShow : false,
            FormType : false,
            DataStore:[],
            FormData:{
              name:'',
              amount:'',
              prices_buy:'',
              prices_sell:'',
            },
// ຟັງຊັນຕົວເລກສຳລັບໃຊ້ຫົວໜ່ວຍເງິນ
            options: {
                    prefix:'₭',
                    numeral:true,
                    numeralPositveOnly:true,
                    noImmediaPrefix:true,
                    rawValueTrimPrefix:true,
                    numeralIntegerScale:10,
                    numeralDecimalScale:2,
                    numeralDecimalMark:'.',
                    delimiter:','

                },

        };
    },

    mounted() {
        
    },

    methods: {
      onSelected(event){
        console.log(event.target.files[0]);
        this.image_product = event.target.files[0]; // ຟັງຊັນໃນການອ່ານໄຟຮູບພາບ
        let reader = new FileReader();
        reader.readAsDataURL(this.image_product);
        reader.addEventListener("load",function(){ //ຟັງຊັນໃນການ preview ຮູບພາບ
          this.image_preview = reader.result;
        }.bind(this),false);
      },
      
// ຟັງຊັນຕົວເລກສຳລັບໃຊ້ສະແດງລາຄາເປັນເງິນ
        formatPrice(value){
          let val = (value / 1).toFixed(0).replace(",", ".");
          return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",");      
         },
// ການສະແດງແບບຟອມ
        add_store(){
          this.FormShow = true;
          this.FormData.name = '' 
          this.FormData.amount = ''
          this.FormData.prices_buy = ''
          this.FormData.prices_sell = ''
          this.image_preview = window.location.origin + '/assets/img/images/placeholder.jpg';
        },
// ການຍົກເລີກແບບຟອມ
        cancel(){
          this.FormShow = false;
          this.show_error = false;
        },

// saving data
        save_Data(){

           
          if(this.FormData.name==''||this.image_product==''||this.FormData.amount==''||this.FormData.prices_buy==''||this.FormData.prices_sell==''){
            
            this.show_error = true;
            this.text_error = "ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົນຖ້ວນ";

          }else{
            
            this.show_error = false;
            this.text_error = ""; 

          if(this.FormType){ // if variable FormType have values is true
// save edit data
          // this.DataStore.find((i)=>i.id == this.EditID).name = this.FormData.name;
          // this.DataStore.find((i)=>i.id == this.EditID).amount = this.FormData.amount;
          // this.DataStore.find((i)=>i.id == this.EditID).prices_buy = this.FormData.prices_buy;
          // this.DataStore.find((i)=>i.id == this.EditID).prices_sell = this.FormData.prices_sell;

//shoot data to backend by axios to update data
        

          let FormDataStore = new FormData();
            FormDataStore.append("name",this.FormData.name);
            FormDataStore.append("amount",this.FormData.amount);
            FormDataStore.append("prices_buy",this.FormData.prices_buy);
            FormDataStore.append("prices_sell",this.FormData.prices_sell);
            FormDataStore.append("file",this.image_product);

             this.$axios.get("/sanctum/csrf-cookie").then((response)=>{

                    this.$axios.post(`/api/store/update/${this.EditID}`,FormDataStore, {headers:{"content-Type":"multipart\form-data"}}).then((response)=>{
                      this.$swal({
                          position: 'top-center',
                          icon: 'success',
                          title: response.data.message,
                          showConfirmButton: false,
                          timer: 2000
                        });
                    // console.log("Update Data Successfully");
                    this.getDataStore();
                  }).catch((error)=>{
                    console.log(error);
                  });
               });
            
          }else{// if variable FormType have values is false
// add new data

          // this.DataStore.push({
          //   id: Math.floor(Math.random()*1000),
          //   name : this.FormData.name ,
          //   amount: this.FormData.amount,
          //   prices_buy: this.FormData.prices_buy,
          //   prices_sell: this.FormData.prices_sell
          // });

//shoot data to backend by axios
       


            let FormDataStore = new FormData();
            FormDataStore.append("name",this.FormData.name);
            FormDataStore.append("amount",this.FormData.amount);
            FormDataStore.append("prices_buy",this.FormData.prices_buy);
            FormDataStore.append("prices_sell",this.FormData.prices_sell);
            FormDataStore.append("file",this.image_product);
            FormDataStore.append("acc_type","expense");
            this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
              this.$axios.post("/api/store/add",FormDataStore,{headers:{"content-Type":"multipart\form-data"}}).then((response)=>{
                this.$swal({
                      position: 'top-center',
                      icon: 'success',
                      title: response.data.message,
                      showConfirmButton: false,
                      timer: 2000
                    });
                  this.getDataStore();
                }).catch((error)=>{
                  console.log(error);
                });
            });
            
       }
    
// clear data input form
            this.FormData.name = '' 
            this.FormData.amount = ''
            this.FormData.prices_buy = ''
            this.FormData.prices_sell = ''
// close form when save data
            this.FormShow = false;
// when save data status is false
            this.FormType = false;
      }
    },
// edit data
        edit_store(id){
// recieve id from form
        this.EditID = id;
// when save edit data status is true
        this.FormType = true;
//ການຫາ ID ໃນກ້ອນຂໍ້ມູນ
//         let item = this.DataStore.find((i)=>i.id == id); 
//ການຫາ ID ໃນຖານຂໍ້ມູນ

          this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
                  this.$axios.get(`api/store/edit/${id}`).then((response)=>{
                      this.FormData.name = response.data.name 
                      this.FormData.amount = response.data.amount 
                      this.FormData.prices_buy = response.data.prices_buy
                      this.FormData.prices_sell = response.data.prices_sell
//ກຳນົດຄ່າໃຫ້ຮູບພາບ  
                      this.image_product = response.data.image;

                      if(response.data.image){
                          this.image_preview = window.location.origin + '/assets/img/images/' + response.data.image;
                      }else{
                          this.image_preview = window.location.origin + '/assets/img/images/placeholder.jpg';
                      }

                    }).catch((error)=>{
                      console.log(error)
                    });
          });
        
 //ການບັນທຶກການແກ້ໄຂໃນກ້ອນຂໍ້ມູນ           
        //  this.FormData.name = item.name 
        //  this.FormData.amount = item.amount 
        //  this.FormData.prices_buy = item.prices_buy
        //  this.FormData.prices_sell = item.prices_sell
// show form edit when press edit button   
         this.FormShow = true;
        },
// delete data
        del_store(id){
          // let index = this.DataStore.map((i)=>i.id).indexOf(id);
          // this.DataStore.splice(index, 1);
          this.$swal({
              title: 'ທ່ານຕ້ອງການລົບຂໍ້ມູນແທ້ບໍ່?',
              text: "ທ່ານຈະບໍ່ສາມາດກູ້ຄືນຂໍ້ມູນອັນນີ້ໄດ້ເມື່ອລົບໄປແລ້ວ!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'ລົບຂໍ້ມູນ',
              cancelButtonText: 'ຍົກເລີກ'
            }).then((result) => {

              if (result.isConfirmed) {
                this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
                     this.$axios.delete(`api/store/delete/${id}`).then((response)=>{
                          this.$swal({
                                  position: 'top-center',
                                  icon: 'success',
                                  title: response.data.message,
                                  showConfirmButton: false,
                                  timer: 2000
                                })
                          this.getDataStore();
                          }).catch((error)=>{
                            console.log(error)
                          });
                });
                
              }
            });
        },
//call data from database     
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
    watch:{
      "search"(){
        if(this.search==''){
          this.getDataStore();
        }
      }
    },
    created(){
      this.getDataStore();
      console.log('store:'+window.Laravel.isLoggin);
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