<template>
    <div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bell-o fa-fw"></i> Details
    </div>
    <div class="panel-body">
     <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Posted By</th>
                    <th><a :href="'/account/profile/student-profile/'+orderdetails.student_id">View Student Profile</a></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Subject</strong></td>
                    <td>{{ orderdetails.subject }}</td>
                </tr>
                <tr>
                    <td><strong>Level</strong></td>
                    <td>{{ orderdetails.level }}</td>
                </tr>
                <tr>
                    <td><strong>Format</strong></td>
                    <td>{{ orderdetails.format }}</td>
                </tr>
                <tr>
                    <td><strong>Budget</strong></td>
                    <td>{{ orderdetails.budget }}</td>
                </tr>
                <tr>
                    <td><strong>Number of pages</strong></td>
                    <td>{{ orderdetails.numpages }}</td>
                </tr>
                <tr>
                    <td><strong>Due By (Pacific Time)</strong></td>
                    <td>{{ orderdetails.homedate | datFormat }}</td>
                </tr>               
            </tbody>
        </table>
        </div>
        <h4>Order Description</h4>
        <p></p>

        <div v-html="orderdetails.description"></div>
        <h4>Order Attachments</h4>
        <button v-if="orderdetails.attachments == false" class="btn btn-warning"><i>Project does not have any attachments</i></button>
        <a v-for="(attachment, index) in orderdetails.attachments" :key="index" :href="'/account/orderuploads/get/' +attachment.order_id+ '/' +attachment.filename" class="btn btn-danger" v-else> {{ attachment.filename }} </a>
    </div>        
        
</div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    computed: {
        ...mapGetters({
            orderdetails: 'GetOrderDetails'
        })
    },
    filters: {
        datFormat: function(dat){
            return moment(dat).format('LLLL');
        }
    },
    mounted(){}
}
</script>