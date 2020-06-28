import {
    SET_ORDER_DETAILS
} from '../actions/order'
const state = {
    orderdetails: []
}

const getters = {
    GetOrderDetails: state => state.orderdetails
}

const actions = {}

const mutations = {
    [SET_ORDER_DETAILS]: (state, payload) => {
        state.orderdetails = payload
    }
}
export default {
    state,
    getters,
    actions,
    mutations,
}