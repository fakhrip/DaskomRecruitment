<template>
    <div class="container">
        <div class="login-box-bg"></div>
        <div class="login-box">

            <img class="logo" id="daskom-logo" src="/assets/logo-daskom.svg" alt="daskom's logo">

            <div class="form-box">
                <form @submit.prevent="handleSubmit" class="ui large form">
                    <div class="field">
                        <div class="ui left icon input">
                            <input type="text" name="nim" placeholder="Nim" v-model="userData.nim">
                            <i class="user secret icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <input type="password" class="ui left icon input" name="password" placeholder="Password" v-model="userData.password">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <button class="ui button" type="submit">Submit</button>
                </form>
            </div>
        </div>
        <!-- <div class="logo-box">
            <img class="logo" id="daskom-logo" src="/assets/logo-daskom.svg" alt="daskom's logo">
        </div> -->
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
