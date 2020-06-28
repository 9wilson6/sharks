<template>
    <div>        
        <order-status></order-status>
        <deadline-status></deadline-status>
        <disputed-order v-if="orderdetails.status == 3"></disputed-order>

        <div v-if="orderdetails.status != 6" class="col-lg-12">
            <modify-order></modify-order>
        </div>
        <div v-if="orderdetails.status == 1" class="col-lg-12">
            <student-bids></student-bids>
        </div>
        <div v-if="orderdetails.status != 1" class="col-lg-12">
            <solution></solution>
        </div>

        <div v-if="orderdetails.status != 1" class="col-lg-12">
            <student-actions></student-actions>
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
import Bids from "./Studentbids"
import ModifyOrder from "./modifyorder"
import OrderDetails from "./Orderdetails"
import Solution from "./Solution"
import RevisionNote from "./Revisionnote"
import StudentActions from "./Studentactions"
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
            orderdetails: 'GetOrderDetails'
        })
    },
    created() {
        if (this.orderdetails) {
            Echo.private(`studentorder.${this.order.id}`)
            .listen('StudentOrdersUpdated', (e) => {
                this.$store.commit(SET_ORDER_DETAILS, e.order);
            });            
        }        
    },
    components: {
        'order-status': OrderStatuses,
        'deadline-status': deadlineStatus,
        'modify-order': ModifyOrder,
        'student-bids': Bids,
        'order-details': OrderDetails,
        'student-actions': StudentActions,
        'solution': Solution,
        'disputed-order': DisputedOrders,
        'revision-note': RevisionNote,
        'award-details': AwardedDetails
    },
    mounted(){
        this.$store.commit(SET_USER, this.user);
        this.$store.commit(SET_ORDER_DETAILS, this.order);
    }
}
</script>

