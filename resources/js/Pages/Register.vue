<template>
    <div>
        <div class="container-xxl d-flex justify-content-center">
          <div class="authentication-wrapper authentication-basic container-p-y col-md-4 ">
            <div class="authentication-inner">
            <!-- Register -->
              <div class="card">
                <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <!-- <a href="index.html" class="app-brand-link gap-2">

                    <span class="app-brand-text demo text-body fw-bolder">Sneat</span>
                    </a> -->
                </div>
                <!-- /Logo -->
                <h4 class="mb-2 d-flex justify-content-center">ສ້າງບັນຊີໃໝ່</h4>
                <p class="mb-4 d-flex justify-content-center"></p>

                <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
                        <div class="alert alert-danger alert-dismissible" role="alert" v-if="show_error">
                            <i class="bx bx-info-circle fs-20"></i>
                        {{ text_error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                        </div>
                    
                    <div class="mb-3">
                    <label for="email" class="form-label">ຊື່ຜູ້ໃຊ້</label>
                    <input type="text" class="form-control" placeholder="ກະລຸນາປ້ອນຊື່" v-model="username">
                    </div>
                    <div class="mb-3">
                    <label for="email" class="form-label">ອີ່ເມວ</label>
                    <input type="email" class="form-control" placeholder="ກະລຸນາປ້ອນອີເມວ" v-model="email">
                    </div>
                    <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">ລະຫັດຜ່ານ</label>
                    </div>
                    <div class="input-group input-group-merge">
                        <input type="password"  class="form-control"  placeholder="ກະລຸນາປ້ອນລະຫັດຜ່ານ" v-model="password">
                    </div>
                </div>
                    <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">ຢືນລະຫັດຜ່ານ</label>
                    </div>
                    <div class="input-group input-group-merge">
                    <input type="password"  class="form-control"  placeholder="ກະລຸນາຢືນລະຫັດຜ່ານ" v-model="confirmpassword">
                </div>
                </div>
                
                    <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="button" @click="Register()">ເຂົ້າສູ່ລະບົບ</button>
                    </div>
                    <p class="text-center">
                        <span class="me-2">ຖ້າລົງທະບຽນແລ້ວຄຼິກທີ່ນີ້?</span>
                        <a href="auth-register-basic.html">
                        <span>ເພື່ອເຂົ້າສູ່ລະບົບ</span>
                        </a>
                    </p>
                </form>
                </div>
            </div>
            <!-- /Register -->
            </div>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MiniPosRegister',

    data() {
        return {
            username : '',
            email :'',
            password : '',
            confirmpassword : '',
            show_error: false,
            text_error:''
        };
    },

    mounted() {
        
    },

    methods: {
        Register(){
            if(this.name ==''|| this.email==''|| this.pasword==''|| this.confirmpassword==''){
                this.show_error = true;
                this.text_error = "ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົນຖ້ວນ";
            }else{

                if(this.password !== this.confirmpassword){
                
                    this.show_error = true;
                    this.text_error = "ລະຫັດບໍ່ຕົງກັນ ກະລຸນາປ້ອນໃໝ່";

                }else{
                    this.show_error = false;
                    this.text_error = ""; 

                    this.$axios.post("/api/register",{
                        username: this.username,
                        email: this.email,
                        password: this.password
                    }).then((response)=>{

                    }).catch((error)=>{
                        console.log(error);
                    });
                }
                
            }
        }
    },
};
</script>

<style lang="scss" scoped>

</style>