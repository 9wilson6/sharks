import { SET_COOKIES_WRITERS } from '../actions/writers'

const state = {
    writers: []    
}

const getters = {
    getCookieWriters: state => state.writers
}

const actions = {}

const mutations = {
    [SET_COOKIES_WRITERS]: (state, payload) => {
        state.writers = payload
    }
}
export default {
    state,
    getters,
    actions,
    mutations,
}