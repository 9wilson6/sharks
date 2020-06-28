import Vue from "vue";
import Vuex from "vuex";
import Bids from "./modules/bids";
import Order from "./modules/order";
import Writers from "./modules/writers";
import Calculator from "./modules/calculator";
Vue.use(Vuex)
const store = () => {
  return new Vuex.Store({
    state: {},
    modules: {
        Calculator,
        Writers,
        Order,
        Bids
    }
  })
}
export default store;