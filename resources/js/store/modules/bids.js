import {
    SET_ORDER_BIDS
} from '../actions/bids'
const state = {
    orderbids: []
}

const getters = {
    GetOrderBids: state => state.orderbids
}

const actions = {}

const mutations = {
    [SET_ORDER_BIDS]: (state, payload) => {
        state.orderbids = payload
    }
}
export default {
    state,
    getters,
    actions,
    mutations,
}