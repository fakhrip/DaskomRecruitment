<template>
    <div class="box">
        <form class="ui form">
            <div class="field">
                <label>Tahap</label>
                <div class="ui left icon input">
                    <input type="text" name="tahap" placeholder="Tahap">
                    <i class="user secret icon"></i>
                </div>
            </div>
            <div class="field">
                <label>Quota</label>
                <div class="ui left icon input">
                    <input type="text" name="quota" placeholder="Quota">
                    <i class="lock icon"></i>
                </div>
            </div>
            <div class="field">
                <label>Shift</label>
                <div class="ui left icon input">
                    <input type="text" name="shift" placeholder="Shift (seperated by spaces)">
                    <i class="lock icon"></i>
                </div>
            </div>
            <div class="field">
                <label>Ruangan</label>
                <div class="ui left icon input">
                    <input type="text" name="ruangan" placeholder="Ruangan">
                    <i class="lock icon"></i>
                </div>
            </div>
            <div class="field">
                <div class="ui calendar" id="calendarSchedule">
                    <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" name="schedule" placeholder="Schedule's Date">
                    </div>
                </div>
            </div>
            <div class="ui animated primary large fluid submit button" tabindex="0">
                <div class="visible content">Add Schedule</div>
                <div class="hidden content">
                    <i class="right arrow icon"></i>
                </div>
            </div>
        </form>
    </div>
</template>

<style lang="scss">

    .admin.box {
        width: 200px;
        margin: auto;
    }

</style>


<script>
    export default {
        data(){
            return{
                hostname: "http://"+window.location.hostname //change this on production with an htttps
            }
        },

        mounted() {

            let globe = this;

            $('#calendarSchedule').calendar({
                type: 'date',
                formatter: {
                    date: function (date, settings) {
                        if (!date) return '';
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear();
                        return year + '/' + month + '/' + day;
                    }
                }
            });

            $('.ui.form .submit.button')
                .api({
                    url: '/addAvailableSchedule',
                    method : 'POST',
                    serializeForm: true,
                    beforeSend: function (setting) {
                        if (!$(".ui.form").form('is valid')) {
                            return false;
                        } else return true;
                    },
                    onResponse: function(response) {
                        if(response.response == "success"){
                            location.reload();
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

            $('.ui.form')
                .form({
                    fields: {
                        tahap     : 'empty',
                        quota     : 'empty',
                        shift     : 'empty',
                        ruangan   : 'empty',
                        schedule  : 'empty',
                    }
                });
        }
    }
</script>
