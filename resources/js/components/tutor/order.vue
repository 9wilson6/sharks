<template>
    <div>
        <order-status></order-status>
        <deadline-status></deadline-status>
        <disputed-order v-if="orderdetails.status == 3"></disputed-order>
        <place-bid v-if="orderdetails.status == 1 && showbidform"></place-bid>        
        <div v-if="orderdetails.status == 1" class="col-lg-12">
            <tutor-bids></tutor-bids>
        </div>
        <div v-if="orderdetails.status != 1" class="col-lg-12">
            <solution></solution>
        </div>
        <div v-if="orderdetails.status !== 2" class="col-lg-12">
            <tutor-actions></tutor-actions>
        </div>
        <div v-if="orderdetails.status == 8" class="col-lg-12">
            <revision-note></revision-note>
        </div>
        <div v-if="orderdetails.status != 1" class="col-lg-12">
            <award-details></award-details>
        </div>
        <div class="col-lg-12">
            <order-details></order-details>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import {
    SET_ORDER_DETAILS
} from '../../store/actions/order'
import {
    SET_USER
} from '../../store/actions/calculator'
import OrderStatuses from "./orderdetails/status"
import deadlineStatus from "./orderdetails/deadlinestatus"
import DisputedOrders from "./orderdetails/dispute"
import PlaceBid from "./orderdetails/placebid"
import TutorActions from "./Tutoractions"
import TutorBids from "./Tutorbids"
import Solution from "./Solution"
import OrderDetails from "./Orderdetails"
import RevisionNote from "./Revisionnote"
import AwardedDetails from "./orderdetails/awarded"
export default {
    props: {
        order: {
            type: Object,
            required: true
        },
        user: {
            type: Object,
            required: true
        }
    },
    computed: {
        ...mapGetters({
            orderdetails: 'GetOrderDetails',
            getuser: 'GetUser'
        }),
        showbidform(){
            let hastutor_bidded = _.find(this.orderdetails.bids, ['tutor_id', this.getuser.id])
            if(_.isObject(hastutor_bidded)){
                return false
            }else{
                return true
            }
        }
    },
    created() {
        Echo.private(`tutororder.${this.order.id}`)
        .listen('TutorOrdersUpdated', (e) => {
            this.$store.commit(SET_ORDER_DETAILS, e.order);
        });
    },
    components: {
        'order-status': OrderStatuses,
        'deadline-status': deadlineStatus,
        'place-bid': PlaceBid,
        'tutor-bids':TutorBids,
        'tutor-actions':TutorActions,
        'order-details': OrderDetails,
        'solution': Solution,
        'revision-note': RevisionNote,
        'disputed-order': DisputedOrders,
        'award-details': AwardedDetails
    },
    mounted(){
        this.$store.commit(SET_USER, this.user);
        this.$store.commit(SET_ORDER_DETAILS, this.order);
    }
}
</script>

