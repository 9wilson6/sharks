<template>
    <div>
        <a @click.prevent="submitExtendDeadline()" class="btn btn-info btn-block">Extend Deadline</a>
        <div class="modal fade" id="extendDeadlineModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Extend order deadline</h4>
                    </div>
                    <div class="modal-body">
                        <p>Extend the deadline for order #{{ orderdetails.id }}</p>
                        <div class="extendDeadline row">
                            <form id="extendDeadlineForm" :action="'/home/extend/deadline/' + orderdetails.id" method="POST" class="form-horizontal" role="form">
                                <input type="hidden" name="_token" :value="csrf">
                                <div class="col-md-6 extentinput form-group">
                                    <label for="days">Days</label>                
                                    <input type="number" v-model="days" name="days" id="days" class="form-control" required="required">
                                </div>
                                <div class="col-md-6 extentinput form-group">
                                    <label for="hours">Hours</label>
                                    <input type="number" v-model="hours" name="hours" id="hours" class="form-control" required="required">
                                </div>
                            </form>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button id="sendExtendDeadline" type="button" class="btn btn-success">Extend</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            days: '0',
            hours: '0',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    computed: {
        ...mapGetters({
            orderdetails: 'GetOrderDetails'
        })
    },
    mounted(){},
    methods: {
        submitExtendDeadline(){
            $('#extendDeadlineModal').modal({ backdrop: 'static', keyboard: false })
            .one('click', '#sendExtendDeadline', function (e) {
                //Disable confirm button
                $('#extendDeadlineForm').submit();
                //console.log('BidPlaced');                    
            });           
        }
    }
}
</script>
<style>

.extendDeadline{
    padding: 15px;
}
.extentinput {
    padding-right: 25px;
}

</style>