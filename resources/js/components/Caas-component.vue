<template>
    <div class="ui centered grid fluid">
        <div class="left floated left aligned two wide column">
            <img class="mainLogo" id="daskom-logo" src="/assets/logo-daskom.svg" alt="daskom's logo">
        </div>
        <div class="right floated right aligned fourteen wide column">
            <div class="ui big icon buttons">
                <div class="ui top left pointing dropdown button" tabindex="0">
                    <i class="calendar alternate icon"></i>
                    <div class="menu">
                        <div class="header">Display Density</div>
                        <div class="item">Comfortable</div>
                        <div class="item">Cozy</div>
                        <div class="item">Compact</div>
                        <div class="ui divider"></div>
                        <div class="item">Settings</div>
                        <div class="item">
                        <i class="dropdown icon"></i>
                        <span class="text">Upload Settings</span>
                        <div class="menu">
                            <div class="item">
                            <i class="check icon"></i>
                            Convert Uploaded Files to PDF
                            </div>
                            <div class="item">
                            <i class="check icon"></i>
                            Digitize Text from Uploaded Files
                            </div>
                        </div>
                        </div>
                        <div class="item">Manage Apps</div>
                        <div class="item">Keyboard Shortcuts</div>
                        <div class="item">Help</div>
                    </div>
                </div>
                <button class="ui button"><i class="bell icon"></i></button>
                <button class="ui button"><i class="sliders horizontal icon"></i></button>
                <button class="ui button"><i class="info icon"></i></button>
            </div>
            <button class="ui big labeled icon button">
                <i class="sign out alternate icon"></i>
                Logout
            </button>
        </div>
    </div>
</template>

<style lang="scss">
    .ui.grid.fluid {
        padding: 25px;
        height: 100%;
    }

    .ui.big.icon.buttons {
        margin-right: 10px;
    }

    .six.wide.column {
        align-content: flex-end;
    }

    #swup, .body-box, #app {
        height: 100%;
    }
</style>


<script>
    export default {
        props: ['userData'],
        data(){
            return{
                user: {
                    name: "",
                    password: "",
                    nim: "",
                    jurusan: "",
                    kelebihan: "",
                    kekurangan: "",
                },
                windowWidth: 0,
                windowHeight: 0,
                hostname: "http://"+window.location.hostname //change this on production with an htttps
            }
        },
        
        methods: {
            getWindowWidth(event) {
                this.windowWidth = document.documentElement.clientWidth;
            },

            getWindowHeight(event) {
                this.windowHeight = document.documentElement.clientHeight;
            }
        },

        beforeDestroy() {
            window.removeEventListener('resize', this.getWindowWidth);
            window.removeEventListener('resize', this.getWindowHeight);
        },

        mounted() {

            this.$nextTick(function() {
                window.addEventListener('resize', this.getWindowWidth);
                window.addEventListener('resize', this.getWindowHeight);

                //Init
                this.getWindowWidth()
                this.getWindowHeight()
            })
            
            let globe = this;
            globe.user = JSON.parse(globe.userData);

            $('.ui.dropdown.button')
                .dropdown()
                ;

            //TODO
            if(globe.user.jurusan == "el"){
                //$("#bg_jurusan").attr("src","/assets/bg-elektro.jpg"); // BACKGROUND ELEKTRO
            } else if(globe.user.jurusan == "tf") {
                //$("#bg_jurusan").attr("src","/assets/second.jpg"); // BACKGROUND FISIKA
            } else {
                //$("#bg_jurusan").attr("src","/assets/second.jpg"); // BACKGROUND TELEKOMUNIKASI
            }
        }
    }
</script>
