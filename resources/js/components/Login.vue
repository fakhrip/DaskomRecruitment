<template>
    <div class="ui middle aligned centered grid">
        <div class="column">
            <div class="login-box-bg"></div>
            <div class="login-box">

                <img class="logo" id="daskom-logo" src="/assets/logo-daskom.svg" alt="daskom's logo">
                <form class="ui large form login">
                    <div class="field">
                        <label>Nim</label>
                        <div class="ui left icon input">
                            <input type="text" name="nim" placeholder="Nim">
                            <i class="user secret icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <div class="ui left icon input">
                            <input type="password" name="password" placeholder="Password">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="ui animated primary large fluid submit button" tabindex="0">
                        <div class="visible content">Login</div>
                        <div class="hidden content">
                            <i class="right arrow icon"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</template>

<script>
    export default {
        props: ['userData'],
        data(){
            return{
                hostname: "http://"+window.location.hostname //change this on production with an htttps
            }
        },

        mounted() {

            var globe = this;

            // if(!globe.userData == ""){
            //     window.location.href = globe.hostname+"/logout";
            // }

            $('.ui.form .submit.button')
                .api({
                    url: '/login',
                    method : 'POST',
                    serializeForm: true,
                    beforeSend: function (setting) {
                        if (!$(".ui.form").form('is valid')) {
                            return false;
                        } else return true;
                    },
                    onResponse: function(response) {
                        if(parseInt(response.response, 10) == 1){
                            window.location.href = globe.hostname+"/caas";
                        } else {
                            $('.ui.dimmable')
                                .dimmer('show');
                        }
                    },
                    onError: function(errorMessage, element, xhr){
                        console.log(errorMessage + "--" + element + "--" + xhr);
                    }
                });

            $('.ui.form')
                .submit(function(evt) {
                    evt.preventDefault();
                });
        }
    }
</script>
