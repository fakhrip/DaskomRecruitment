<template>
    <div class="ui middle aligned centered grid">
        <div class="ui shape">
            <div class="sides">
                <div class="side active">
                    <div class="column">
                        <div class="login-box-bg"></div>
                        <div class="login-box">
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
                <div class="side">
                    <div class="column">
                        <div class="login-box-bg"></div>
                        <div class="login-box">
                            <div class="ui text container">
                                <h2 class="ui header welcome">Welcome aboard 🤝,<br>{{ this.userData.name }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .ui.shape {
        margin: auto;
        text-align: initial;
    }

    .ui.text.container {
        width: 100%;
        height: 100%;
        text-align: center;
    }
</style>


<script>
    export default {
        data(){
            return{
                userData : {
                    name: "",
                    nim: "",
                    password: "",
                },
                hostname: "http://"+window.location.hostname //change this on production with an htttps
            }
        },

        mounted() {

            var globe = this;

            var delay = ( function() {
                var timer = 0;
                return function(callback, ms) {
                    clearTimeout (timer);
                    timer = setTimeout(callback, ms);
                };
            })();

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

                            globe.userData.name = response.user.name;
                            delay(function(){
                                $('.shape').shape('flip over');
                                delay(function(){
                                    window.location.href = globe.hostname+"/caas";
                                }, 1000 ); // end delay
                            }, 400 ); // end delay

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

            $('.ui.form.login')
                .form({
                    fields: {
                        nim     : 'empty',
                        password   : 'empty'
                    }
                });
        }
    }
</script>
