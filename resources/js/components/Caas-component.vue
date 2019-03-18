<template>
    <div class="box">

        <div class="main-box">
            <div class="ui middle aligned centered grid">
                <div class="column user-data">
                    <img class="ui big image" src="https://avataaars.io/png/2000?accessoriesType=Round&avatarStyle=Transparent&clotheColor=Heather&clotheType=GraphicShirt&eyeType=Default&eyebrowType=UpDown&facialHairColor=Platinum&facialHairType=Blank&graphicType=Skull&hairColor=Black&hatColor=PastelRed&mouthType=Serious&skinColor=Pale&topType=Hat">
                    <div class="ui raised segment">
                        {{ user.name }}
                    </div>
                </div>
            </div>
        </div>

        <div class="ui centered grid fluid">
            <div class="left floated left aligned two wide column">
                <img class="mainLogo" id="daskom-logo" src="/assets/logo-daskom.svg" alt="daskom's logo">
            </div>
            <div class="right floated right aligned fourteen wide column">
                <div class="ui big icon buttons">
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
                <h3 class="ui header" v-if="notifications">There are no notification yet</h3>
                <div class="ui feed" v-else v-for="notification in notifications" v-bind:key="notification.id">
                    <div class="event">
                        <div class="label">
                            <i class="big check icon" v-if="notification.seen === '1'"></i>
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

    .column.user-data {
        padding: 50px;
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

    .bg#bg_jurusan {
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
                hostname: "http://"+window.location.hostname //change this on production with an htttps
            }
        },
        
        methods: {

            dim(event) {
                $('.ui.dimmable')
                    .dimmer('show');
            },

            newNotificationExist() {
                this.notifications.forEach(notification => {
                    if(notification.seen === '0'){
                        return true;
                    }
                });
                return false;
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
                    .modal('show');
                fetch(this.hostname+`/api/seeAllNotifications?api_token=`+this.user.api_token)
                    .then(res => res.json())
                    .then(res => {
                        this.getAllNotifications();
                    })
                    .catch(err => console.log(err))
            },

            logout(event) {
                window.location.href = this.hostname+"/logout";
            },

            getWindowWidth(event) {
                this.windowWidth = document.documentElement.clientWidth;
            },

            getWindowHeight(event) {
                this.windowHeight = document.documentElement.clientHeight;
            },

            getAllNotifications(){
                fetch(this.hostname+`/api/notifications?api_token=`+this.user.api_token)
                    .then(res => res.json())
                    .then(res => {
                        this.notifications = res.data;
                        this.notificationExist = this.newNotificationExist();
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
            window.removeEventListener('resize', this.getWindowWidth);
            window.removeEventListener('resize', this.getWindowHeight);
        },

        mounted() {
            
            let globe = this;
            globe.user = JSON.parse(globe.userData);
            
            this.getAllNotifications();

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

            $('.ui.form.setting')
                .form({
                    on: 'blur',
                    fields: {
                        code: {
                            identifier  : 'code',
                            rules: [
                            {
                                type   : 'regExp[/^([A-Z]){3}$/]',
                                prompt : 'Please enter exactly 3 capital letter code (Ex: FAI)'
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
                window.addEventListener('resize', this.getWindowWidth);
                window.addEventListener('resize', this.getWindowHeight);

                //Init
                this.getWindowWidth()
                this.getWindowHeight()
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
