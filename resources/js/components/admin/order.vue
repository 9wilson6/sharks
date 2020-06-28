<template>
    <div>
        <order-status></order-status>
        <order-modify></order-modify>
        <disputed-order v-if="orderdetails.status == 3"></disputed-order>      
        <div v-if="orderdetails.status == 1" class="col-lg-12">
            <admin-bids></admin-bids>
        </div>
        <div v-if="orderdetails.status != 1" class="col-lg-12">
            <solution></solution>
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
import DisputedOrders from "./orderdetails/dispute"
import PlaceBid from "./orderdetails/placebid"
import TutorActions from "./Tutoractions"
import Bids from "./Bids"
import Solution from "./Solution"
import OrderDetails from "./Orderdetails"
import AwardedDetails from "./orderdetails/awarded"
import RevisionNote from "./Revisionnote"
import OrderModify from "./modifyorder"
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
        Echo.private(`adminorder.${this.order.id}`)
        .listen('AdminOrdersUpdated', (e) => {
            this.$store.commit(SET_ORDER_DETAILS, e.order);
        });
    },
    components: {
        'order-status': OrderStatuses,
        'place-bid': PlaceBid,
        'admin-bids':Bids,
        'tutor-actions':TutorActions,
        'order-details': OrderDetails,
        'solution': Solution,
        'revision-note': RevisionNote,
        'disputed-order': DisputedOrders,
        'award-details': AwardedDetails,
        'order-modify': OrderModify
    },
    mounted(){
        this.$store.commit(SET_USER, this.user);
        this.$store.commit(SET_ORDER_DETAILS, this.order);
    }
}
</script>

