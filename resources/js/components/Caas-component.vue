<template>
    <div class="box">
        <div class="main-box">
            <div class="ui middle aligned centered grid">
                <div class="column user-data">
                    <img class="ui big image" src="https://avataaars.io/png/2000?accessoriesType=Round&avatarStyle=Transparent&clotheColor=Heather&clotheType=GraphicShirt&eyeType=Default&eyebrowType=UpDown&facialHairColor=Platinum&facialHairType=Blank&graphicType=Skull&hairColor=Black&hatColor=PastelRed&mouthType=Serious&skinColor=Pale&topType=Hat">
                    <div class="ui raised segment username">
                        {{ user.name }}
                    </div>
                    <div class="ui center aligned text container">
                        {{ user.status }}
                    </div>
                </div>
            </div>
        </div>

        <div class="ui centered grid fluid">
            <div class="left floated left aligned two wide column">
                <img class="mainLogo" id="daskom-logo" src="/assets/logo-daskom.svg" alt="daskom's logo">
            </div>
            <div class="right floated right aligned fourteen wide column" v-if="this.windowWidth < 600">
                <button class="ui big button onemenu usePopUp" data-content="Menu" v-on:click="showMenu">
                    <i class="bars icon"></i>
                </button>
            </div>
            <div class="right floated right aligned fourteen wide column" v-else>
                <div class="ui big icon buttons allmenu">
                    <button class="ui button usePopUp" data-content="Schedule"><i class="calendar alternate icon"></i></button>
                    <button class="ui button usePopUp" data-content="Notification" v-on:click="showNotifications">
                        <i class="red bell icon" v-if="notificationExist"></i>
                        <i class="bell icon" v-else></i>
                    </button>
                    <button class="ui button usePopUp" data-content="Setting" v-on:click="showSetting"><i class="sliders horizontal icon"></i></button>
                    <button class="ui button usePopUp" data-content="Information" v-on:click="dim"><i class="info icon"></i></button>
                </div>
                <button class="ui big labeled icon button logout" v-on:click="logout">
                    <i class="sign out alternate icon"></i>
                    Logout
                </button>
            </div>
        </div>

        <div class="ui modal notification">
            <div class="header">Notifications</div>
            <div class="scrolling content">
                <h3 class="ui header" v-if="this.notifications.length < 1">There are no notification yet</h3>
                <div class="ui feed" v-else v-for="notification in notifications" v-bind:key="notification.id">
                    <div class="event">
                        <div class="label">
                            <i class="big check icon" v-if="notification.seen == 1"></i>
                            <i class="big exclamation icon" v-else></i>
                        </div>
                        <div class="content">
                            <div class="summary">
                                {{ notification.message }}
                                <div class="date">
                                    {{ notification.created_at | moment("calendar") }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui modal setting">
            <div class="header">Setting</div>
            <div class="scrolling content">
                <form class="ui form setting">
                    <div class="field">
                        <label>Assistant Code</label>
                        <div class="ui left icon input">
                            <input type="text" name="code" placeholder="Your future assistant code" v-model="newUserData.code">
                            <i class="user secret icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>New password</label>
                        <div class="ui left icon input">
                            <input type="password" name="password" placeholder="New password" v-model="newUserData.password">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Confirm New Password</label>
                        <div class="ui left icon input">
                            <input type="password" name="confirm_password" placeholder="Confirm new password">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="ui error message"></div>
                </form>
            </div>
            <div class="actions">
                <div class="ui black deny button">
                    Cancel
                </div>
                <div class="ui positive right labeled icon button" v-on:click="changeUserData">
                    Commit changes
                    <i class="checkmark icon"></i>
                </div>
            </div>
        </div>

        <div class="ui modal schedule">
            <div class="header">Schedule</div>
            <div class="scrolling content">
                <form class="ui form schedule">
                    <div class="field">
                        <label>Ruangan</label>
                        <select class="ui fluid dropdown">
                            <option value="">Ruangan</option>
                            <option value="1">Daskom 3</option>
                            <option value="2">Daskom 1</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Schedule</label>
                        <div class="ui calendar" id="calendarSchedule">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" name="schedule" placeholder="Schedule's Date">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Confirm New Password</label>
                        <div class="ui left icon input">
                            <input type="password" name="confirm_password" placeholder="Confirm new password">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="ui error message"></div>
                </form>
            </div>
            <div class="actions">
                <div class="ui black deny button">
                    Cancel
                </div>
                <div class="ui positive right labeled icon button" v-on:click="changeUserData">
                    Commit changes
                    <i class="checkmark icon"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
    .ui.grid.fluid {
        padding: 25px;
        height: 100%;
    }

    .ui.segment.username {
        margin-top: 0;
        text-align: center;
        font-size: 20px;
        text-transform: uppercase;
        font-weight: bold;
    }

    .column.user-data {
        margin: 50px;
        text-align: center;
        font-size: 25px;
        font-weight: bold;
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

    .bg_main#bg_jurusan {
        width: 100%;
        height: 100%;
        background-image: linear-gradient(to bottom, #234c34, #31713e, #4d9740, #75bd38, #a8e31f);
    }
</style>

<script>
    export default {
        props: ['userData'],
        data(){
            return{
                notifications: [],
                availableSchedules: [],
                user: {
                    id: "",
                    name: "",
                    password: "",
                    nim: "",
                    jurusan: "",
                    api_token: "",
                    status: "",
                },
                schedule: {
                    shift: "",
                    ruangan: "",
                    schedule: "",
                },
                newUserData: {
                    code: "",
                    password: "",
                },
                notificationExist: false,
                windowWidth: 0,
                windowHeight: 0,
                hostname: "https://"+window.location.hostname //change this on production with an htttps
            }
        },
        
        methods: {

            dim(event) {
                $('.ui.dimmable')
                    .dimmer('show');
            },

            showMenu(){
                $('.ui.sidebar')
                    .sidebar('setting', 'transition', 'overlay')
                    .sidebar('toggle');
            },
            
            showSetting(){
                $('.ui.form.setting').form('clear');
                $('.ui.modal.setting')
                    .modal({
                        closable  : false,
                        onDeny    : function(){
                            return true;
                        },  
                        onApprove : function() {
                            $('.ui.form.setting').form('submit');
                            if(!$('.ui.form.setting').form('is valid')){
                                return false;
                            }
                        }
                    })
                    .modal('show');
            },

            showNotifications(){
                $('.ui.modal.notification')
                    .modal({
                        onHidden: function(){
                            fetch(this.hostname+`/api/seeAllNotifications`, {
                                headers: {
                                    'Authorization' : 'Bearer '+this.user.api_token,
                                    'Accept' : 'application/json',
                                }
                            })
                            .then(res => res.json())
                            .catch(err => console.log(err))
                        }
                    })
                    .modal('show');
                this.getAllNotifications();
            },

            logout(event) {
                window.location.href = this.hostname+"/logout";
            },

            getWindowSize(event) {
                this.windowWidth = document.documentElement.clientWidth;
                this.windowHeight = document.documentElement.clientHeight;
            },

            getAllNotifications(){
                fetch(this.hostname+`/api/notifications`, {
                    headers: {
                        'Authorization' : 'Bearer '+this.user.api_token,
                        'Accept' : 'application/json',
                    }
                })
                .then(res => res.json())
                .then(res => {
                    this.notifications = res.data;

                    this.notifications.forEach(notification => {
                        if(notification.seen == 0){
                            this.notificationExist = true;
                        }
                    });

                    if(this.notificationExist){
                        $('.bell.icon#notification-mobile').addClass('red');
                    } else {
                        $('.bell.icon#notification-mobile').removeClass('red');
                    }
                })
                .catch(err => console.log(err))
            },

            changeUserData(event) {
                var salt = bcrypt.genSaltSync(10);
                var hash = bcrypt.hashSync(this.newUserData.password, salt);
                this.newUserData.password = hash;
                fetch(this.hostname+`/api/changeUserData?api_token=`+this.user.api_token, {
                    method: 'post',
                    body: JSON.stringify(this.newUserData),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    if(res.response == "success"){
                        window.location.href = this.hostname+"/logout";
                    }
                })
                .catch(err => console.log(err))
            }
        },

        beforeDestroy() {
            window.removeEventListener('resize', this.getWindowSize);
        },

        mounted() {
            
            let globe = this;
            globe.user = JSON.parse(globe.userData);
            
            this.getAllNotifications();

            fetch(this.hostname+`/api/cekStatus`, {
                headers: {
                    'Authorization' : 'Bearer '+this.user.api_token,
                    'Accept' : 'application/json',
                }
            })
            .then(res => res.json())
            .then(res => {
                if(parseInt(response.response, 10) == 1){
                    this.user.status = "CONGRATULATION YOU HAVE PASSED THIS STAGE 😎"
                } else if(parseInt(response.response, 10) == 3) {
                    this.user.status = "WE'RE VERY SORRY TO CUT YOU DOWN 😢"
                } else {

                    var textArray = [
                        'Don’t let what you cannot do interfere with what you can do. 👊',
                        'Successful and unsuccessful people do not vary greatly in their abilities.\nThey vary in their desires to reach their potential. 🙌',
                        'Strive for progress, not perfection. 🏆',
                        'Talk is cheap. Show me the code. 👨‍💻',
                        'Any fool can write code that a computer can understand.\nGood programmers write code that humans can understand. 👏',
                    ];
                    var randomNumber = Math.floor(Math.random()*textArray.length);
                    this.user.status = "Stage On Progress...\n" + textArray[randomNumber];
                }
            })
            .catch(err => console.log(err))

            fetch(this.hostname+`/api/getAllAvailableSchedules?api_token=`+this.user.api_token)
                    .then(res => res.json())
                    .then(res => {
                        globe.availableSchedules = res.data;
                    })
                    .catch(err => console.log(err))

            $('.ui.form.setting')
                .submit(function(evt) {
                    evt.preventDefault();
                });

            $(".ui.button.schedule").click(function () {
                $('.ui.sidebar')
                    .sidebar('setting', 'transition', 'overlay')
                    .sidebar('toggle');
                //TODO for schedule on click
            });

            $(".ui.button.notification").click(function () {
                $('.ui.sidebar')
                    .sidebar('setting', 'transition', 'overlay')
                    .sidebar('toggle');
                globe.showNotifications();
            });

            $(".ui.button.settings").click(function () {
                $('.ui.sidebar')
                    .sidebar('setting', 'transition', 'overlay')
                    .sidebar('toggle');
                globe.showSetting();
            });

            $(".ui.button.information").click(function () {
                $('.ui.sidebar')
                    .sidebar('setting', 'transition', 'overlay')
                    .sidebar('toggle');
                globe.dim();
            });

            $(".ui.button.logout").click(function () {
                $('.ui.sidebar')
                    .sidebar('setting', 'transition', 'overlay')
                    .sidebar('toggle');
                globe.logout();
            });

            $('.ui.form.setting')
                .form({
                    on: 'blur',
                    fields: {
                        code: {
                            identifier  : 'code',
                            rules: [
                            {
                                type   : 'regExp[/^([A-Z]){3}$/]',
                                prompt : 'Please enter exactly 3 capital letter code (Ex: FIA)'
                            }
                            ]
                        },
                        password: {
                            identifier  : 'password',
                            rules: [
                            {
                                type   : 'regExp[/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+){8,16}$/]',
                                prompt : 'Please enter 8-16 character of letter and number (Must contain at least 1 number and 1 letter)'
                            }
                            ]
                        },
                        confirm_password: {
                            identifier  : 'confirm_password',
                            rules: [
                            {
                                type   : 'match[password]',
                                prompt : 'Confirm password not match'
                            }
                            ]
                        }
                    }
                });

            $(".ui.instagram.button").click(function(){
                window.open('https://www.instagram.com/telu.daskom/?hl=en', '_blank');
            });
            $(".ui.youtube.button").click(function(){
                window.open('https://www.youtube.com/channel/UCgCAhA5CK3tG3pofQnn-VEA/feed', '_blank');
            });
            $(".ui.line.button").click(function(){
                window.open('https://line.me/en/', '_blank');
            });
            $(".ui.button.usePopUp").popup();

            this.$nextTick(function() {
                window.addEventListener('resize', this.getWindowSize);

                //Init
                this.getWindowSize()
            })

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
