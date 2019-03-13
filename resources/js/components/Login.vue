<template>
    <div class="container">
        <div class="login-box-bg"></div>
        <div class="login-box">
            <form @submit.prevent="handleSubmit" class="form-box">
                <div class="form-group">
                    <label for="nim">Nim</label>
                    <input type="text" class="form-control" name="nim" placeholder="Nim" v-model="userData.nim" :class="{ 'is-invalid': submitted && !userData.nim }">
                    <div v-show="submitted && !userData.nim" class="invalid-feedback">Nim is required</div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Password" v-model="userData.password" :class="{ 'is-invalid': submitted && !userData.password }">
                    <div v-show="submitted && !userData.password" class="invalid-feedback">Password is required</div>
                </div>
                <button type="submit" style="width: 150px; display: block;" class="mx-auto btn btn-primary">Login</button>
            </form>
        </div>
        <div class="logo-box">
            <img class="logo" id="daskom-logo" src="/assets/logo-daskom.svg" alt="daskom's logo">
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                userData: {
                    id: '',
                    nim: '',
                    password: ''
                },
                submitted: false,
                hostname: "http://"+window.location.hostname //change this on production with an htttps
            }
        },
        
        methods: {
            handleSubmit() {
                
                this.submitted = true;
                fetch(this.hostname+`/api/loginPracticant`, {
                    method: 'post',
                    body: JSON.stringify(this.userData),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if(parseInt(data.response, 10) == 1){
                        
                    } else {
                        
                    }
                })
                .catch(err => console.log(err))
            }
        },

        mounted() {
            console.log('Component mounted.');
            fetch(this.hostname+`/api/logoutPracticant`, {
                method: 'post'
            })
            .then(data => {
                console.log("User successfully logout");
            })
            .catch(err => console.log(err))
        }
    }
</script>
