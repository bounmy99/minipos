<template>
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
                        <h6 class="mb-0">12,000,000</h6> <span class="text-muted">ລາຍການ</span>
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
    <!-- table -->

    <div class="card">
      <h5 class="card-header mb-0">Hoverable rows</h5>
      <!-- {{FormData}} -->
      
       <!-- {{DataStore}} -->
       
       <!-- {{FormType}} -->
      <div class="demo-inline-spacing d-flex justify-content-end mt-0 mb-3  me-3">
        <button type="button" class="btn rounded-pill btn-primary" v-if="!FormShow" @click="add_store()">ເພີ່ມ</button>
        <button type="button" class="btn rounded-pill btn-success" v-if="FormShow" @click="save_Data()">ບັນທຶກ</button>
        <button type="button" class="btn rounded-pill btn-danger" v-if="FormShow" @click="cancel()">ຍົກເລີກ</button>
      </div>
      <div class="row card-body" v-if="FormShow">
      <h5 class="card-header">Default</h5>
      <div class="col-md-4">
          <label for="defaultFormControlInput" class="form-label">ຊື່ສີ້ນຄ້າ</label>
          <input type="text" class="form-control" id="" placeholder="John Doe" >
      </div>
    <div class="col-md-8">
        <div>
          <label for="defaultFormControlInput" class="form-label">ຊື່ສີ້ນຄ້າ</label>
          <input type="text" class="form-control" id="" placeholder="ກະລຸນາປ້ອນຊື່ສີ້ນຄ້າ " v-model="FormData.name" >
          <label for="defaultFormControlInput" class="form-label">ຈຳນວນ</label>
          <input type="text" class="form-control" id="" placeholder="ກະລຸນາປ້ອນຈຳນວນ" v-model="FormData.amount">
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="defaultFormControlInput" class="form-label">ລາຄາຊື້</label>
          <input type="text" class="form-control" id="" placeholder="ກະລຸນາປ້ອນລາຄາຊື້" v-model="FormData.prices_buy">
          </div>
          <div class="col-md-6">
            <label for="defaultFormControlInput" class="form-label">ລາຄາຂາຍ</label>
          <input type="text" class="form-control" id="" placeholder="ກະລຸນາປ້ອນລາຄາຂາຍ" v-model="FormData.prices_sell">
          </div>
        </div>
     </div>
      </div>
      <div class="table-responsive text-nowrap card-body" v-if="!FormShow">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ລະຫັດ</th>
          <th>ຊື່ສີ້ນຄ້າ</th>
          <th>ຈຳນວນ</th>
          <th>ລາຄາຊື້</th>
          <th>ລາຄາຂາຍ</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr v-for="list in DataStore" :key="list.id">
          <td><strong>{{list.id}}</strong></td>
          <td><strong>{{list.name}}</strong></td>
          <td><strong>{{list.amount}}</strong></td>
          <td><strong>{{list.prices_buy}}</strong></td>
          <td><strong>{{list.prices_sell}}</strong></td>
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
  </div>
</div>

</template>

<script>
export default {
    name: 'MiniPosStore',

    data() {
        return {
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
        };
    },

    mounted() {
        
    },

    methods: {
        add_store(){
          this.FormShow = true;
        },
        cancel(){
          this.FormShow = false;
        },

// saving data
        save_Data(){

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

            this.$axios.post(`/api/store/update/${this.EditID}`,FormDataStore).then((response)=>{
              // console.log("Update Data Successfully");
              this.getDataStore();
            }).catch((error)=>{
              console.log(error);
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

            this.$axios.post("/api/store/add",FormDataStore).then((response)=>{
              // console.log("Send Data Successfully");
              this.getDataStore();
            }).catch((error)=>{
              console.log(error);
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
            this.$axios.get(`api/store/edit/${id}`).then((response)=>{
              this.FormData.name = response.data.name 
              this.FormData.amount = response.data.amount 
              this.FormData.prices_buy = response.data.prices_buy
              this.FormData.prices_sell = response.data.prices_sell
            }).catch((error)=>{
              console.log(error)
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
                })
              }
            });
        },
//call data from database     
        getDataStore(){

          this.$axios.get('api/store').then((response)=>{

            this.DataStore = response.data;

          }).catch((error)=>{

            console.log(error);

          })
        },
    },
    created(){
      this.getDataStore();
    },

    
  
};
</script>

<style lang="scss" scoped>

</style>