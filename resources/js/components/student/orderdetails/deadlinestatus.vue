<template>
    <div class="col-lg-12">
        <div v-if="deadline.active" class="alert alert-success">
            <span class="largerfont"><span class="glyphicon glyphicon-record"></span> <strong>Deadline: {{ deadline.date }}</strong></span>
            <p>Time remaining: <span>{{ deadline.diff }}</span></p>
        </div>
        <div class="alert alert-danger" v-else>
            <span class="largerfont"><span class="glyphicon glyphicon-record"></span> <strong>Deadline: {{ deadline.date }}</strong></span>
            <p>Delayed by: <span>{{ deadline.diff }}</span></p>
        </div>
    </div>    
</template>
<script>
import { mapGetters } from 'vuex'
import moment from "moment"
export default {
    computed: {
        ...mapGetters({
            orderdetails: 'GetOrderDetails'
        }),
        deadline() {
            let homedate = this.orderdetails.homedate
            if(moment().diff(homedate) > 0){
                var diff = moment.duration(moment().diff(moment(homedate)))
                var days = parseInt(diff.asDays())
                var hours = parseInt(diff.asHours())
                hours = hours - days*24
                var minutes = parseInt(diff.asMinutes())
                minutes = minutes - (days*24*60 + hours*60)
                
                return {
                    message: 'Delayed',
                    active: false,
                    date: moment(homedate).format('dddd, MMMM Do YYYY, h:mm:ss a'),
                    diff: days + ' days ' + hours + ' hours ' + minutes + ' minutes.'
                }
            }else {
                var diff = moment.duration(moment(homedate).diff(moment()))
                var days = parseInt(diff.asDays())
                var hours = parseInt(diff.asHours())
                hours = hours - days*24
                var minutes = parseInt(diff.asMinutes())
                minutes = minutes - (days*24*60 + hours*60)
                return {
                    message: 'Remaining',
                    active: true,
                    date: moment(homedate).format('dddd, MMMM Do YYYY, h:mm:ss a'),
                    diff: days + ' days ' + hours + ' hours ' + minutes + ' minutes.'
                }
            }
        }
    }
}
</script>

<style>
.largerfont {
    font-size: 16px;
    font-weight: bolder;
}
</style>